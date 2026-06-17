<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update the admin user in an idempotent way
        User::updateOrCreate(
            ['email' => 'admin@bookly.com'],
            [
                'name' => 'admin',
                'email' => 'admin@bookly.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
    }
}
