<?php

namespace App\View\Components\Admin;

use App\Models\Sale;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TotalOrders extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $totalSales = Sale::all()->count();
        return view('components.admin.total-orders', [
            'totalSales' => $totalSales,
        ]);
    }
}
