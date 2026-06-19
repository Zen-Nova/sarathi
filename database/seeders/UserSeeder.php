<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Safely update or insert the primary Super Administrator account
        User::updateOrCreate(
            ['email' => 'admin@sarathi.test'], // Unique lookup key
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Safely update or insert the secondary staff/operator account
        User::updateOrCreate(
            ['email' => 'operator@sarathi.test'], // Unique lookup key
            [
                'name' => 'Operator User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}