<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Account
        User::updateOrCreate(
            ['email' => 'admin@zipmoment.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // Sample Client Account
        User::updateOrCreate(
            ['email' => 'client@example.com'],
            [
                'name' => 'Sample Client',
                'password' => Hash::make('client123'),
                'role' => 'client'
            ]
        );
    }
}
