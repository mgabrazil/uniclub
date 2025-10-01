<?php

namespace App\Livewire\Vendor;

use App\Models\User;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Livewire\Component;
use Livewire\WithPagination;

class ListVendors extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $sortField = 'name';
    public string $sortDirection = 'asc';

    public array $selectedVendors = [];
    public bool $selectAllVendors = false;
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedSelectAllVendors($value)
    {
        if ($value) {
            $this->selectedVendors = $this->paginatedVendors->pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selectedVendors = [];
        }
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

    public function toggleSelectedVendorsStatus()
    {
        if (empty($this->selectedVendors)) return;

        $vendorsToUpdate = User::whereIn('id', $this->selectedVendors)->where('role', UserRole::Vendor)->get();
        foreach ($vendorsToUpdate as $vendor) {
            $vendor->status = ($vendor->status === UserStatus::Active) ? UserStatus::Inactive : UserStatus::Active;
            $vendor->save();
        }
        $this->selectedVendors = [];
        $this->selectAllVendors = false;
        session()->flash('message', 'Status dos vendedores selecionados alterado.');
    }

    public function deleteSelectedVendors()
    {
        if (empty($this->selectedVendors)) return;

        User::whereIn('id', $this->selectedVendors)->where('role', UserRole::Vendor)->delete();
        $this->selectedVendors = [];
        $this->selectAllVendors = false;
        session()->flash('message', 'Vendedores selecionados deletados.');
    }
    public function getPaginatedVendorsProperty()
    {
        return User::query()
            ->where('role', UserRole::Vendor)
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
            ->paginate(15);
    }

    public function render()
    {
        $allVendorsQuery = User::where('role', UserRole::Vendor)
            ->when(!empty($this->search), function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('cpf', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            });

        $totalCount = (clone $allVendorsQuery)->count();
        $activeCount = (clone $allVendorsQuery)->where('status', UserStatus::Active)->count();
        $inactiveCount = (clone $allVendorsQuery)->where('status', UserStatus::Inactive)->count();

        return view('livewire.vendor.list-vendors', [
            'vendors' => $this->paginatedVendors,
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
            'inactiveCount' => $inactiveCount,
        ])
            ->layoutData([
                'title' => __('Lista de Vendedores')
            ]);
    }
}
