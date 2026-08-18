<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@rt.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Buat Akun Device / Bilik Suara
        User::create([
            'name' => 'Bilik Suara 1',
            'email' => 'bilik1@rt.com',
            'password' => Hash::make('bilik123'),
            'role' => 'device',
        ]);
    }
}
