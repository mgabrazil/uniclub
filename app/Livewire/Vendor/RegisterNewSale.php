<?php

namespace App\Livewire\Vendor;

use App\Enums\PointMovementType;
use App\Enums\UserRole;
use Livewire\Component;
use App\Models\PointsConfiguration;
use App\Models\PointMovement;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegisterNewSale extends Component
{
    public ?int $selectedClientId = null;
    public ?string $selectedClientName = null;
    public ?int $selectedVendorId = null;
    public ?string $selectedVendorName = null;

    public string $clientEmail = '';
    public string $clientCpf = '';
    public string $clientPhone = '';

    public $amount = '';
    public $pointsToRedeem = 0;
    public $discountValue = 0;
    public $finalAmount = 0;

    protected $listeners = ['clientSelected', 'vendorSelected', 'clearUserSelections'];
    protected function rules(): array
    {
        return [
            'selectedClientId' => 'required|integer|exists:users,id',
            'selectedVendorId' => 'required|integer|exists:users,id',
            'amount'           => 'required|numeric|min:0.01',
            'pointsToRedeem'   => 'nullable|integer|min:0',
        ];
    }

    protected $messages = [
        'selectedClientId.required' => 'É obrigatório selecionar o cliente.',
        'selectedVendorId.required' => 'É obrigatório selecionar o vendedor que realizou a venda.',
        'amount.required'           => 'O valor da venda é obrigatório.',
        'amount.numeric'            => 'O valor da venda deve ser um número.',
        'amount.min'                => 'O valor da venda deve ser positivo.',
        'pointsToRedeem.integer'    => 'Os pontos a resgatar devem ser um número inteiro.',
        'pointsToRedeem.min'        => 'Os pontos a resgatar não podem ser negativos.',
    ];

    public function mount(): void
    {
        $this->referenceNumberDisplay = __('Será gerado ao salvar');
        $this->calculateFinalAmount();
    }

    public function clientSelected(int $userId, string $userName): void
    {
        $client = User::withCasts(['role' => UserRole::class])->find($userId);
        if ($client && $client->role === UserRole::Client) {
            $this->selectedClientId = $client->id;
            $this->selectedClientName = $client->name;
            $this->clientEmail = $client->email;
            $this->clientCpf = $client->cpf;
            $this->clientPhone = $client->phone ?? '';
            $this->resetValidation('selectedClientId');
            $this->calculateFinalAmount();
        } else {
            $this->resetClientData();
        }
    }

    public function vendorSelected(int $userId, string $userName): void
    {
        $vendor = User::withCasts(['role' => UserRole::class])->find($userId);
        if ($vendor && $vendor->role === UserRole::Vendor) {
            $this->selectedVendorId = $vendor->id;
            $this->selectedVendorName = $vendor->name;
            $this->resetValidation('selectedVendorId');
        } else {
            $this->reset(['selectedVendorId', 'selectedVendorName']);
        }
    }
    public function updatedAmount($value): void
    {
        $this->calculateFinalAmount();
    }
    public function updatedPointsToRedeem($value): void
    {
        $this->calculateFinalAmount();
    }

    private function calculateFinalAmount(): void
    {
        $config = PointsConfiguration::first();
        $clientPoints = 0;
        if ($this->selectedClientId) {
            $client = User::find($this->selectedClientId);
            $clientPoints = $client?->current_points ?? 0;
        }

        $pointsToUse = max(0, (int) $this->pointsToRedeem);
        $pointsToUse = min($pointsToUse, $clientPoints);

        $this->discountValue = 0;
        if ($config && $config->currency_per_point > 0 && $pointsToUse > 0) {
            $this->discountValue = $pointsToUse * $config->currency_per_point;
        }

        $saleAmount = (float) $this->amount > 0 ? (float) $this->amount : 0;
        $this->discountValue = min($this->discountValue, $saleAmount);

        if ($config && $config->currency_per_point > 0) {
            $this->pointsToRedeem = floor($this->discountValue / $config->currency_per_point);
        } else {
            $this->pointsToRedeem = 0;
        }
        $this->pointsToRedeem = max(0, (int) $this->pointsToRedeem);

        $this->finalAmount = max(0, $saleAmount - $this->discountValue);
    }



    public function createSale(): void
    {
        $this->calculateFinalAmount();
        $this->validate();

        $client = User::find($this->selectedClientId);
        if (!$client || $client->current_points < $this->pointsToRedeem) {
            $this->addError('pointsToRedeem', 'Pontos insuficientes para este resgate.');
            return;
        }

        $config = PointsConfiguration::first();
        if (!$config || $config->points_per_currency < 0 || $config->currency_per_point < 0) {
            $this->addError('generic_error', 'Erro na configuração de pontos.');
            return;
        }

        DB::beginTransaction();
        try {
            $pointsEarned = floor($this->finalAmount * $config->points_per_currency);
            $pointsEarned = max(0, $pointsEarned);

            $sale = Sale::create([
                'client_id'        => $this->selectedClientId,
                'vendor_id'        => $this->selectedVendorId,
                'amount'           => (float) $this->amount,
                'points_earned'    => $pointsEarned,
                'points_redeemed'  => $this->pointsToRedeem,
                'final_amount'     => $this->finalAmount,
                'status'           => 'completed',
                'description'      => null,
            ]);

            if ($pointsEarned > 0) {
                PointMovement::create([
                    'client_id'   => $sale->client_id,
                    'sale_id'     => $sale->id,
                    'transaction_type'        => PointMovementType::EarnedFromSale,
                    'points'      => $pointsEarned,
                    'description' => "Pontos pela venda {$sale->reference_number}",
                ]);
            }
            if ($sale->points_redeemed > 0) {
                PointMovement::create([
                    'client_id'   => $sale->client_id,
                    'sale_id'     => $sale->id,
                    'transaction_type'        => PointMovementType::RedeemedForDiscount,
                    'points'      => $sale->points_redeemed,
                    'description' => "Resgate na venda {$sale->reference_number}",
                ]);
            }

            $newBalance = ($client->current_points + $pointsEarned) - $sale->points_redeemed;
            $client->current_points = max(0, $newBalance);
            $client->save();

            DB::commit();
            session()->flash('success', 'Venda registrada com sucesso!');
            $this->resetForm();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erro ao salvar venda: " . $e->getMessage(), ['exception' => $e]);
            $this->addError('generic_error', 'Erro inesperado ao registrar venda.');
        }
    }

    public function resetForm(): void
    {
        $this->reset([
            'selectedClientId', 'selectedClientName', 'clientEmail', 'clientCpf', 'clientPhone',
            'selectedVendorId', 'selectedVendorName',
            'amount', 'pointsToRedeem', 'discountValue', 'finalAmount'
        ]);
        $this->dispatch('clearUserSelections');
        $this->generateReferenceNumber();
        $this->resetValidation();
    }

    private function resetClientData(): void
    {
        $this->reset(['selectedClientId', 'selectedClientName', 'clientEmail', 'clientCpf', 'clientPhone', 'pointsToRedeem', 'discountValue', 'finalAmount']);
        $this->calculateFinalAmount();
    }

    public function render()
    {
        return view('livewire.vendor.register-new-sale')
            ->layoutData(['title' => __('Registrar Venda')]);
    }
}
