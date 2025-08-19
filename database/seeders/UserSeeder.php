<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Guru
        User::create([
            'name' => 'Pak Barkah',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
        ]);

        // Siswa
        User::create([
            'name' => 'Budi',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);
    }
}
