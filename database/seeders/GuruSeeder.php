<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        // Data guru-guru (wali kelas dari KelasSeeder)
        $gurus = [
            ['nama' => 'Bu Titin',  'email' => 'titin@gmail.com'],
            ['nama' => 'Pak Joko',  'email' => 'joko@gmail.com'],
            ['nama' => 'Bu Anisa',  'email' => 'anisa@gmail.com'],
            ['nama' => 'Pak Fajar', 'email' => 'fajar@gmail.com'],
            ['nama' => 'Bu Ratna',  'email' => 'ratna@gmail.com'],
            ['nama' => 'Pak Budi',  'email' => 'budi@gmail.com'],
            ['nama' => 'Bu Wulan',  'email' => 'wulan@gmail.com'],
            ['nama' => 'Pak Rian',  'email' => 'rian@gmail.com'],
            ['nama' => 'Bu Sinta',  'email' => 'sinta@gmail.com'],
            ['nama' => 'Pak Andi',  'email' => 'andi@gmail.com'],
            ['nama' => 'Bu Dewi',   'email' => 'dewi@gmail.com'],
            ['nama' => 'Pak Heru',  'email' => 'heru@gmail.com'],
            ['nama' => 'Bu Lestari','email' => 'lestari@gmail.com'],
            ['nama' => 'Pak Eko',   'email' => 'eko@gmail.com'],
            ['nama' => 'Bu Rini',   'email' => 'rini@gmail.com'],
            ['nama' => 'Pak Doni',  'email' => 'doni@gmail.com'],
            ['nama' => 'Bu Maya',   'email' => 'maya@gmail.com'],
            ['nama' => 'Pak Yudi',  'email' => 'yudi@gmail.com'],
            ['nama' => 'Bu Lina',   'email' => 'lina@gmail.com'],
            ['nama' => 'Pak Agus',  'email' => 'agus@gmail.com'],
            ['nama' => 'Bu Rani',   'email' => 'rani@gmail.com'],
            ['nama' => 'Pak Arif',  'email' => 'arif@gmail.com'],
            ['nama' => 'Bu Yuni',   'email' => 'yuni@gmail.com'],
        ];

        foreach ($gurus as $guruData) {
            // Buat atau ambil User
            $user = User::firstOrCreate(
                ['email' => $guruData['email']],
                [
                    'name' => $guruData['nama'],
                    'password' => Hash::make('guru123'),
                    'role' => 'guru',
                ]
            );

            // Buat atau ambil Guru
            Guru::firstOrCreate(
                ['email' => $guruData['email']],
                [
                    'user_id' => $user->id,
                    'nama' => $guruData['nama'],
                    'nip' => fake()->numerify('########'),
                    'foto' => 'foto/guru-default.png',
                ]
            );
        }
    }
}
