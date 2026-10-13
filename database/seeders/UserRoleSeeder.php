<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin Toko', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'editor@example.com'],
            ['name' => 'Editor Produk', 'password' => Hash::make('password'), 'role' => 'editor']
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'Pembeli Biasa', 'password' => Hash::make('password'), 'role' => 'user']
        );
    }
}