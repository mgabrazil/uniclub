<?php

namespace App\Livewire\Vendor;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CreateVendor extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $cpf;
    public $phone;
    public $birthday;

    public function mount()
    {
        $vendor = User::where('role', 'vendor')->first();

        $this->name = $vendor->name ?? "";
        $this->email = $vendor->email ?? "";
        $this->cpf = $vendor->cpf ?? "";
        $this->phone = $vendor->phone ?? "";
        $this->birthday = optional($vendor?->birthday ?? null)
            ->format('d/m/Y');
    }

    public function create()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'role' => 'vendor',
            'status' => 'active'
        ]);

        session()->flash('success', __('Novo vendedor cadastrado com sucesso.'));
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.vendor.create-vendor')->layoutData([
            'title' => __('Novo Vendedor'),
        ]);
    }
}
