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

        // Siswa
        User::create([
            'name' => 'Budi',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        // Guru
        $gurus = [
            ['name' => 'Bu Titin',  'email' => 'titin@gmail.com'],
            ['name' => 'Pak Joko',  'email' => 'joko@gmail.com'],
            ['name' => 'Bu Anisa',  'email' => 'anisa@gmail.com'],
            ['name' => 'Pak Fajar', 'email' => 'fajar@gmail.com'],
            ['name' => 'Bu Ratna',  'email' => 'ratna@gmail.com'],
            ['name' => 'Pak Budi',  'email' => 'budi@gmail.com'],
            ['name' => 'Bu Wulan',  'email' => 'wulan@gmail.com'],
            ['name' => 'Pak Rian',  'email' => 'rian@gmail.com'],
            ['name' => 'Bu Sinta',  'email' => 'sinta@gmail.com'],
            ['name' => 'Pak Andi',  'email' => 'andi@gmail.com'],
            ['name' => 'Bu Dewi',   'email' => 'dewi@gmail.com'],
            ['name' => 'Pak Heru',  'email' => 'heru@gmail.com'],
            ['name' => 'Bu Lestari','email' => 'lestari@gmail.com'],
            ['name' => 'Pak Eko',   'email' => 'eko@gmail.com'],
            ['name' => 'Bu Rini',   'email' => 'rini@gmail.com'],
            ['name' => 'Pak Doni',  'email' => 'doni@gmail.com'],
            ['name' => 'Bu Maya',   'email' => 'maya@gmail.com'],
            ['name' => 'Pak Yudi',  'email' => 'yudi@gmail.com'],
            ['name' => 'Bu Lina',   'email' => 'lina@gmail.com'],
            ['name' => 'Pak Agus',  'email' => 'agus@gmail.com'],
            ['name' => 'Bu Rani',   'email' => 'rani@gmail.com'],
            ['name' => 'Pak Arif',  'email' => 'arif@gmail.com'],
            ['name' => 'Bu Yuni',   'email' => 'yuni@gmail.com'],
        ];

        foreach ($gurus as $guru) {
            User::firstOrCreate(
                ['email' => $guru['email']],
                [
                    'name' => $guru['name'],
                    'password' => Hash::make('guru123'), // Password default
                    'role' => 'guru',
                ]
            );
        }
    }
}
