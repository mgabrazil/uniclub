<?php

namespace App\Livewire\Vendor;

use App\Exports\SalesExport;
use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SalesList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public function updatedSearch()
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

    public function export()
    {
        return Excel::download(new SalesExport(), 'vendas-' . now()->format('YmdHis') . '.xlsx');
    }

    public function render()
    {
        $query = Sale::query()
            ->with(['client', 'vendor'])
            ->when($this->search, function ($q) {
                $q->where(function ($subq) {
                    $subq->where('reference_number', 'like', '%' . $this->search . '%')
                        ->orWhereHas('client', fn($clientQuery) => $clientQuery->where('name', 'like', '%' . $this->search . '%')->orWhere('cpf', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('vendor', fn($vendorQuery) => $vendorQuery->where('name', 'like', '%' . $this->search . '%'));
                });
            });
        $sales = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);

        return view('livewire.vendor.sales-list', [
            'sales' => $sales,
        ])->layoutData(['title' => __('Lista de Vendas')]);
    }
}
