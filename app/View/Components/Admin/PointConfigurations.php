<?php

namespace App\View\Components\Admin;

use App\Models\PointsConfiguration;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PointConfigurations extends Component
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
        $pointsConfiguration = PointsConfiguration::first();

        return view('components.admin.point-configurations', [
            'pointsPerCurrency' => $pointsConfiguration->points_per_currency,
            'currencyPerPoint' => $pointsConfiguration->currency_per_point,
            'pointsExpirationDays' => $pointsConfiguration->points_expiration_days,
            'updated_at' => Carbon::parse($pointsConfiguration->updated_at)->translatedFormat('d \d\e F \d\e Y \à\s H:i'),
        ]);
    }
}
