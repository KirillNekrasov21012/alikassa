<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@mail.com'],
            [
                'name' => 'Test User',
                'password' => \Hash::make('password123'),
                'balance' => 100.0,
            ]
        );
    }
}
