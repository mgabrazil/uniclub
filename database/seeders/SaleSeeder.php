<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Sale::create([
            'user_id' => 1,
            'vendor_id' => 1,
            'total_amount' => 100.00,
            'purchase_number' => 1,
            'status' => 'completed',
            'order_date' => now(),
        ]);
    }
}
