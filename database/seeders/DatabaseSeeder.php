<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Use create() instead of factory() to avoid the "fake()" function error
        User::firstOrCreate(
            ['email' => 'aldmic'], // Search condition
            [
                'name' => 'Aldmic User',
                'password' => Hash::make('123abc123'),
            ]
        );
    }
}