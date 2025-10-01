<?php

namespace App\Livewire\Vendor\ListVendors;

use App\Models\User;
use Livewire\Component;

class FilterDropdown extends Component
{
 public string $statusFilter = '';

    public function updateStatusFilter(string $value){
        $this->emitUp('statusSelected', $value);
    }

    public function render()
    {
        $vendors = User::query()
            ->where('role', 'vendor')
            ->when($this->statusFilter !== '', fn($q) =>
                $q->where('status', $this->statusFilter)
            )
            ->get();

        return view('livewire.vendor.list-vendors.filter-dropdown', [
            'vendors' => $vendors,
        ]);
    }
}
