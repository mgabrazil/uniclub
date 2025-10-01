<?php

namespace App\View\Components\Admin;

use App\Models\PointMovement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PointsRedeemed extends Component
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

        $totalPointsRedeemed = PointMovement::where('transaction_type', 'addition')->count();
        return view('components.admin.points-redeemed', [
            'totalPointsRedeemed' => $totalPointsRedeemed,
        ]);
    }
}
