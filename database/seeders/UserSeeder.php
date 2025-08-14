<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin123'),
        //     'role' => 'admin',
        // ]);
        // // Guru
        // $guruUser = User::create([
        //     'name' => 'Pak Barkah',
        //     'email' => 'guru@gmail.com',
        //     'password' => Hash::make('guru123'),
        //     'role' => 'guru',
        // ]);

        // Guru::create([
        //     'user_id' => $guruUser->id,
        //     'nama' => 'Pak Barkah',
        //     'nip' => '12345678',
        //     'email' => 'guru@gmail.com',
        //     'foto' => 'foto/guru-default.png'
        // ]);

        // Kelas
        $kelas = Kelas::create([
            'nama_kelas' => 'XII DPIB 1',
            'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 1',
             'nama_kelas' => 'XII DPIB 2',
            'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 2',
        ]);

        // // Siswa
        // $siswaUser = User::create([
        //     'name' => 'Budi',
        //     'email' => 'siswa@gmail.com',
        //     'password' => Hash::make('siswa123'),
        //     'role' => 'siswa',
        // ]);

        // Siswa::create([
        //     'user_id' => $siswaUser->id,
        //     'kelas_id' => $kelas->id,
        //     'nama' => 'Budi',
        //     'nis' => '11223344',
        //     'email' => 'siswa@gmail.com',
        //     'foto' => 'foto/siswa-default.png'
        // ]);
    }
}
