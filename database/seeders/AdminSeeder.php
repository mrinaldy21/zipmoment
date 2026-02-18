<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create admin if not exists (firstOrCreate ensures no duplicates)
        $admin = User::firstOrCreate(
            ['email' => 'admin@zipmoment.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. If exists, ensure role is 'admin' (do NOT overwrite password)
        if ($admin->role !== 'admin') {
            $admin->update(['role' => 'admin']);
        }
    }
}
