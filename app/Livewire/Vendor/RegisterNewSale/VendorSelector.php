<?php

namespace App\Livewire\Vendor\RegisterNewSale;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Collection;

class VendorSelector extends Component
{
    public Collection $vendors;
    public bool $showDropdown = false;
    public ?string $selectedVendorName = null;
    public string $eventName = 'vendorSelected';
    protected $listeners = ['clearUserSelection'];

    public function mount(string $eventName = 'vendorSelected'): void
    {
        $this->eventName = $eventName;
        $this->loadVendors();
    }

    public function loadVendors(): void
    {
        $this->vendors = User::where('role', UserRole::Vendor)
            ->where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function toggleDropdown(): void
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function selectVendor(int $vendorId): void
    {
        $vendor = $this->vendors->firstWhere('id', $vendorId);
        if ($vendor) {
            $this->selectedVendorName = $vendor->name;
            $this->dispatch($this->eventName, userId: $vendor->id, userName: $vendor->name);
            $this->showDropdown = false;
        }
    }

    public function clearUserSelection(): void
    {
        $this->selectedVendorName = null;
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.vendor.register-new-sale.vendor-selector');
    }
}
