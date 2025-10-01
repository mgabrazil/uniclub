<?php

namespace App\Livewire\Vendor\RegisterNewSale;

use Livewire\Component;
use App\Models\User;

class SelectClient extends Component
{
    public string $search = '';

    public function render()
    {
        $clients = User::where('role', 'client')
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('cpf', 'like', '%' . $this->search . '%');
                });
            })
            ->get();
        return view('livewire.vendor.register-new-sale.select-client', [
            'clients' => $clients
        ]);
    }
}
