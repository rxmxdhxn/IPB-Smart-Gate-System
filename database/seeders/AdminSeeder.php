<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Smart Gate',
            'email' => 'admin@smartgate.com',
            'password' => bcrypt('admin123'),
            'nim_nip' => 'ADMIN001',
            'role' => 'admin',
            'is_verified' => true,
        ]);
    }
}