<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsConfiguration extends Model
{

    protected $fillable = [
        'points_per_currency',
        'currency_per_point',
        'points_expiration_days',
        'bonus_rules',
    ];

    protected $casts = [
        'points_per_currency' => 'decimal:2',
        'currency_per_point' => 'decimal:2',
        'bonus_rules' => 'array',
    ];
}
