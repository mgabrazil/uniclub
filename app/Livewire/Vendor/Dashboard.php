<?php

namespace App\Livewire\Vendor;

use Livewire\Component;

class Dashboard extends Component
{
    public $salesTodayCount;
    public $salesTodayValue;
    public $salesThisWeekCount;
    public $salesThisWeekValue;
    public $salesThisMonthCount;
    public $salesThisMonthValue;
    public $pointsGeneratedThisMonth;
    public $pointsGeneratedTotal;

    public function mount(): void
    {
        $this->salesTodayCount = 0;
        $this->salesTodayValue = 0;
        $this->salesThisWeekCount = 0;
        $this->salesThisWeekValue = 0;
        $this->salesThisMonthCount = 0;
        $this->salesThisMonthValue = 0;
        $this->pointsGeneratedThisMonth = 0;
        $this->pointsGeneratedTotal = 0;
    }

    public function render()
    {
        return view('livewire.vendor.dashboard', [
            'salesTodayCount' => $this->salesTodayCount,
            'salesTodayValue' => $this->salesTodayValue,
            'salesThisWeekCount' => $this->salesThisWeekCount,
            'salesThisWeekValue' => $this->salesThisMonthValue,
            'salesThisMonthCount' => $this->salesThisMonthCount,
            'salesThisMonthValue' => $this->salesThisMonthValue,
            'pointsGeneratedThisMonth' => $this->pointsGeneratedThisMonth,
            'pointsGeneratedTotal' => $this->pointsGeneratedTotal,
        ])
            ->layoutData([
                'title' => __('Dashboard | Vendedor')
            ]);
    }
}
