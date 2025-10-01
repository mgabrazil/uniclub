<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@teste.com',
            'password' => Hash::make('senha123'),
            'cpf' => '12345678900',
            'phone' => '61999999999',
            'role' => 'admin',
            'status' => 'active',
            'current_points' => 0,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Vendor',
            'email' => 'vendor@teste.com',
            'password' => Hash::make('senha123'),
            'cpf' => '12345678902',
            'phone' => '61999999999',
            'role' => 'vendor',
            'status' => 'active',
            'current_points' => 0,
            'email_verified_at' => now(),
        ]);

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => "Client{$i}",
                'email' => "client{$i}@teste.com",
                'password' => Hash::make('senha123'),
                'cpf' => "1234567891{$i}",
                'phone' => '61999999999',
                'role' => 'client',
                'status' => 'active',
                'current_points' => 0,
                'email_verified_at' => now(),
            ]);
        }
    }
}
