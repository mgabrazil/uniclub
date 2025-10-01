<?php

namespace App\Livewire\Vendor\ListVendors;

use Livewire\Component;

class TableRow extends Component
{
    public $vendor;
    public function render()
    {
        return view('livewire.vendor.list-vendors.table-row');
    }
}
