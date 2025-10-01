<?php

namespace Database\Seeders;

use App\Models\PointsConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointsConfigurationSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PointsConfiguration::create([
            'points_per_currency' => 0.5,
            'currency_per_point' => 10.0,
            'points_expiration_days' => 60
        ]);
    }
}
