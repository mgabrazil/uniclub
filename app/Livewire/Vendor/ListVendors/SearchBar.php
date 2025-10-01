<?php

namespace App\Livewire\Vendor\ListVendors;

use Livewire\Component;
use Livewire\Attributes\Prop;

class SearchBar extends Component
{
    #[Prop]
    public string $searchTerm = '';

    public string $localSearch = '';

    public function mount()
    {
        $this->localSearch = $this->searchTerm;
    }

    public function updatedLocalSearch()
    {
        $this->dispatch('searchUpdated', $this->searchTerm)->to('vendor.list-vendors');
    }

    public function updatedSearchTerm($value)
    {
        $this->localSearch = $value;
    }

    public function render()
    {
        return view('livewire.vendor.list-vendors.search-bar');
    }
}
