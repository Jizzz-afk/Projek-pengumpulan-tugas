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
            [
                'nama_kelas' => 'XII DPIB 1',
                'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 1',
            ],
            [
                'nama_kelas' => 'XII DPIB 2',
               'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 2',
            ],
            [
                'nama_kelas' => 'XII DPIB 3',
               'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 3',
            ],
            [
             'nama_kelas' => 'XII DPIB 4',
            'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 4',
            ],
            [
             'nama_kelas' => 'XII TEI 1',
            'deskripsi' => 'Kelas 12 Teknik Elektronika Inndustri 1',
            ],
            [
             'nama_kelas' => 'XII TEI 2',
            'deskripsi' => 'Kelas 12 Teknik Elektronika Inndustri 2',
            ],
            [
             'nama_kelas' => 'XII TEI 3',
            'deskripsi' => 'Kelas 12 Teknik Elektronika Inndustri 3',
            ],
            [
             'nama_kelas' => 'XII TOI',
            'deskripsi' => 'Kelas 12 Teknik Otomasi Industri',
            ],
            [
             'nama_kelas' => 'XII TKJ 1',
            'deskripsi' => 'Kelas 12 Teknik Komputer dan Jaringan 1',
            ],
            [
             'nama_kelas' => 'XII TKJ 2',
            'deskripsi' => 'Kelas 12 Teknik Komputer dan Jaringan 2',
            ],
            [
             'nama_kelas' => 'XII RPL 1',
            'deskripsi' => 'Kelas 12 Rekayasa Perangkat Lunak 1',
            ],
            [
             'nama_kelas' => 'XII RPL 2',
            'deskripsi' => 'Kelas 12 Rekayasa Perangkat Lunak 2',
            ],
            [
            'nama_kelas' => 'XII TITL 1',
            'deskripsi' => 'Kelas 12 Teknik Instalasi Tenaga Listrik 1',
            ],
            [
            'nama_kelas' => 'XII TITL 2',
            'deskripsi' => 'Kelas 12 Teknik Instalasi Tenaga Listrik 2',
            ],
            [
            'nama_kelas' => 'XII TITL 3',
            'deskripsi' => 'Kelas 12 Teknik Instalasi Tenaga Listrik 3',
            ],
            [
            'nama_kelas' => 'XII TPTUP',
            'deskripsi' => 'Kelas 12 Teknik Pengelasan dan Teknik Usaha Produksi',
            ],
            [
            'nama_kelas' => 'XII TPM 1',
            'deskripsi' => 'Kelas 12 Teknik Pemesinan 1',
            ],
            [
            'nama_kelas' => 'XII TPM 2',
            'deskripsi' => 'Kelas 12 Teknik Pemesinan 2',
            ],
            [
            'nama_kelas' => 'XII TPM 3',
            'deskripsi' => 'Kelas 12 Teknik Pemesinan 3',
            ],
            [
            'nama_kelas' => 'XII TKR 1',
            'deskripsi' => 'Kelas 12 Teknik Kendaraan Ringan 1',
            ],
            [
            'nama_kelas' => 'XII TKR 2',
            'deskripsi' => 'Kelas 12 Teknik Kendaraan Ringan 2',
            ],
            [
            'nama_kelas' => 'XII TKR 3',
            'deskripsi' => 'Kelas 12 Teknik Kendaraan Ringan 3',
            ],
            [
            'nama_kelas' => 'XII TBKR',
            'deskripsi' => 'Kelas 12 Teknik Bodi Kendaraan Ringan',
            ],
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
