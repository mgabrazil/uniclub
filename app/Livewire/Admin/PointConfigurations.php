<?php

namespace App\Livewire\Admin;

use App\Models\PointsConfiguration;
use Livewire\Component;
use Livewire\WithPagination;

class PointConfigurations extends Component
{
    use WithPagination;

    public $pointsPerCurrency;
    public $currencyPerPoint;
    public $pointsExpirationDays;
    public $updatedAt;
    public bool $showHistory = false;

    public function mount()
    {
        $config = PointsConfiguration::latest()->first();
        $this->pointsPerCurrency    = $config->points_per_currency ?? 0;
        $this->currencyPerPoint     = $config->currency_per_point ?? 0;
        $this->pointsExpirationDays = $config->points_expiration_days ?? 0;
        $this->updatedAt            = optional($config?->updated_at)
            ->format('d/m/Y H:i');
    }

    public function newPointConfigurations()
    {
        PointsConfiguration::create([
            'points_per_currency'    => $this->pointsPerCurrency,
            'currency_per_point'     => $this->currencyPerPoint,
            'points_expiration_days' => $this->pointsExpirationDays,
        ]);

        $this->updatedAt  = now()->format('d/m/Y H:i');
        session()->flash('success', __('Configuração salva com sucesso.'));
        $this->resetPage();
        $this->showHistory = true;
    }

    public function toggleHistory()
    {
        $this->showHistory = ! $this->showHistory;
    }

    public function render()
    {
        $history = PointsConfiguration::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.point-configurations', compact('history'))
            ->layoutData(['title' => __('Pontos')]);
    }
}
