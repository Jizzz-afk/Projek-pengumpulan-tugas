<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // === ADMIN ===
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // === SISWA RPL 2 ===
        $siswas = [
            ['name' => 'Adang Nugroho', 'email' => 'adang@gmail.com'],
            ['name' => 'Ajeng Nurlestari', 'email' => 'ajeng@gmail.com'],
            ['name' => 'Aji Pangestu', 'email' => 'aji@gmail.com'],
            ['name' => 'Akbar Maulana', 'email' => 'akbar@gmail.com'],
            ['name' => 'Alicia Bintoro', 'email' => 'alicia@gmail.com'],
            ['name' => 'Annisa Dwi Handayani', 'email' => 'annisa@gmail.com'],
            ['name' => 'Barkah Muhammad Budhiana', 'email' => 'barkah@gmail.com'],
            ['name' => 'Bintang Fairuz Arli Rahman', 'email' => 'bintang@gmail.com'],
            ['name' => 'Dea', 'email' => 'dea@gmail.com'],
            ['name' => 'Dela Ayu Setiawan', 'email' => 'dela@gmail.com'],
            ['name' => 'Elangga Raka Handaru', 'email' => 'elangga@gmail.com'],
            ['name' => 'Fadhil Jibransyah', 'email' => 'fadhil@gmail.com'],
            ['name' => 'Fahri Dwi Santoso', 'email' => 'fahri@gmail.com'],
            ['name' => 'Geo Ananda Russamsi', 'email' => 'geo@gmail.com'],
            ['name' => 'Kaysa Shubhi El Hanif', 'email' => 'kaysa@gmail.com'],
            ['name' => 'Keisha Shireen Imansyah', 'email' => 'keisha@gmail.com'],
            ['name' => 'Khalila Puspita', 'email' => 'khalila@gmail.com'],
            ['name' => 'Levi Ahmad Yasa', 'email' => 'levi@gmail.com'],
            ['name' => 'Muhamad Erlangga Harimurti Bachtiar', 'email' => 'erlangga@gmail.com'],
            ['name' => 'Muhamad Rizky Ramadhan', 'email' => 'rizky@gmail.com'],
            ['name' => 'Maulana Akbar Maldiv', 'email' => 'maldiv@gmail.com'],
            ['name' => 'Melindah Permatasari', 'email' => 'melindah@gmail.com'],
            ['name' => 'Muhamad Abdul Aziz', 'email' => 'aziz@gmail.com'],
            ['name' => 'Muhamad Syahrul', 'email' => 'syahrul@gmail.com'],
            ['name' => 'Muhammad Davin Fairuz', 'email' => 'davin@gmail.com'],
            ['name' => 'Muhummad Qowwamulhakim', 'email' => 'qowwam@gmail.com'],
            ['name' => 'Muhammad Rizky Syahada', 'email' => 'syahada@gmail.com'],
            ['name' => 'Naufal Al Aziz', 'email' => 'naufal@gmail.com'],
            ['name' => 'Noval Maulana Farhanulloh', 'email' => 'noval@gmail.com'],
            ['name' => 'Rahmat Ali Putra', 'email' => 'rahmat@gmail.com'],
            ['name' => 'Riza Afri Dinata', 'email' => 'riza@gmail.com'],
            ['name' => 'Siti Chaerunnisa Dwijayanti', 'email' => 'chaerunnisa@gmail.com'],
            ['name' => 'Susanti', 'email' => 'susanti@gmail.com'],
            ['name' => 'Yeni Faturohmah', 'email' => 'yeni@gmail.com'],
        ];

        foreach ($siswas as $siswa) {
            User::firstOrCreate(
                ['email' => $siswa['email']],
                [
                    'name' => $siswa['name'],
                    'password' => Hash::make('siswa123'),
                    'role' => 'siswa',
                ]
            );
        }

        // === GURU ===
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
                    'password' => Hash::make('guru123'),
                    'role' => 'guru',
                ]
            );
        }
    }
}
