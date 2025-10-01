<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Livewire\WithPagination;

class ListClients extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $sortField = 'name';
    public string $sortDirection = 'asc';

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }


    public function getPaginatedClientsProperty()
    {
        return User::query()
            ->where('role', UserRole::Client)
            ->when(!empty($this->search), function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('cpf', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when(!empty($this->statusFilter), function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5);
    }

    public function render()
    {
        $allClientsQuery = User::where('role', UserRole::Client)
            ->when(!empty($this->search), function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('cpf', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            });

        $totalCount = (clone $allClientsQuery)->count();
        $activeCount = (clone $allClientsQuery)->where('status', UserStatus::Active)->count();
        $inactiveCount = (clone $allClientsQuery)->where('status', UserStatus::Inactive)->count();

        return view('livewire.vendor.list-clients', [
            'clients' => $this->paginatedClients,
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
            'inactiveCount' => $inactiveCount,
        ])
            ->layoutData([
                'title' => __('Lista de Clientes')
            ]);
    }
}
