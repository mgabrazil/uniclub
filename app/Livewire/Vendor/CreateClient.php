<?php

namespace App\Livewire\Vendor;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class CreateClient extends Component
{
use WithPagination;

    public $name;
    public $email;
    public $cpf;
    public $phone;
    public $password;
    public $birthday;

    public function mount()
    {
        $client= User::where('role', 'client')->first();

        $this->name = $client->name ?? "";
        $this->email = $client->email ?? "";
        $this->cpf = $client->cpf ?? "";
        $this->phone = $client->phone ?? "";
        $this->password = Hash::make($client->password);
        $this->birthday = optional($client?->birthday ?? null)
            ->format('d/m/Y');
    }

    public function create()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'cpf' => $this->cpf,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'role' => 'client',
            'status' => 'active'
        ]);

        session()->flash('success', __('Novo cliente cadastrado com sucesso.'));
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.vendor.create-client')->layoutData([
            'title' => __('Novo Vendedor'),
        ]);
    }
}
