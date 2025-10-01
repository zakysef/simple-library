<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@library.com'],
            [
                'name' => 'Admin Perpustakaan',
                'email' => 'admin@library.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );
    }
}
