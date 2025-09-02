<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = Kelas::all();
        $nisStart = 12329000; // Awal NIS

        // Daftar siswa khusus XII RPL 2
        $siswaRPL2 = [
            ['nama' => 'Adang Nugroho', 'email' => 'adang@gmail.com'],
            ['nama' => 'Ajeng Nurlestari', 'email' => 'ajeng@gmail.com'],
            ['nama' => 'Aji Pangestu', 'email' => 'aji@gmail.com'],
            ['nama' => 'Akbar Maulana', 'email' => 'akbar@gmail.com'],
            ['nama' => 'Alicia Bintoro', 'email' => 'alicia@gmail.com'],
            ['nama' => 'Annisa Dwi Handayani', 'email' => 'annisa@gmail.com'],
            ['nama' => 'Barkah Muhammad Budhiana', 'email' => 'barkah@gmail.com'],
            ['nama' => 'Bintang Fairuz Arli Rahman', 'email' => 'bintang@gmail.com'],
            ['nama' => 'Dea', 'email' => 'dea@gmail.com'],
            ['nama' => 'Dela Ayu Setiawan', 'email' => 'dela@gmail.com'],
            ['nama' => 'Elangga Raka Handaru', 'email' => 'elangga@gmail.com'],
            ['nama' => 'Fadhil Jibransyah', 'email' => 'fadhil@gmail.com'],
            ['nama' => 'Fahri Dwi Santoso', 'email' => 'fahri@gmail.com'],
            ['nama' => 'Geo Ananda Russamsi', 'email' => 'geo@gmail.com'],
            ['nama' => 'Kaysa Shubhi El Hanif', 'email' => 'kaysa@gmail.com'],
            ['nama' => 'Keisha Shireen Imansyah', 'email' => 'keisha@gmail.com'],
            ['nama' => 'Khalila Puspita', 'email' => 'khalila@gmail.com'],
            ['nama' => 'Levi Ahmad Yasa', 'email' => 'levi@gmail.com'],
            ['nama' => 'Muhamad Erlangga Harimurti Bachtiar', 'email' => 'erlangga@gmail.com'],
            ['nama' => 'Muhamad Rizky Ramadhan', 'email' => 'rizky@gmail.com'],
            ['nama' => 'Maulana Akbar Maldiv', 'email' => 'maldiv@gmail.com'],
            ['nama' => 'Melindah Permatasari', 'email' => 'melindah@gmail.com'],
            ['nama' => 'Muhamad Abdul Aziz', 'email' => 'aziz@gmail.com'],
            ['nama' => 'Muhamad Syahrul', 'email' => 'syahrul@gmail.com'],
            ['nama' => 'Muhammad Davin Fairuz', 'email' => 'davin@gmail.com'],
            ['nama' => 'Muhummad Qowwamulhakim', 'email' => 'qowwam@gmail.com'],
            ['nama' => 'Muhammad Rizky Syahada', 'email' => 'syahada@gmail.com'],
            ['nama' => 'Naufal Al Aziz', 'email' => 'naufal@gmail.com'],
            ['nama' => 'Noval Maulana Farhanulloh', 'email' => 'noval@gmail.com'],
            ['nama' => 'Rahmat Ali Putra', 'email' => 'rahmat@gmail.com'],
            ['nama' => 'Riza Afri Dinata', 'email' => 'riza@gmail.com'],
            ['nama' => 'Siti Chaerunnisa Dwijayanti', 'email' => 'siti@gmail.com'],
            ['nama' => 'Susanti', 'email' => 'susanti@gmail.com'],
            ['nama' => 'Yeni Faturohmah', 'email' => 'yeni@gmail.com'],
        ];

        $dummyCounter = 1; // Untuk email dummy

        foreach ($kelasList as $kelas) {
            // Kalau kelas XII RPL 2 pakai daftar asli
            if ($kelas->nama_kelas === 'XII RPL 2') {
                foreach ($siswaRPL2 as $data) {
                    $nis = $nisStart++;

                    $user = User::firstOrCreate(
                        ['email' => $data['email']],
                        [
                            'name' => $data['nama'],
                            'password' => Hash::make('siswa123'),
                            'role' => 'siswa',
                        ]
                    );

                    Siswa::firstOrCreate(
                        ['nis' => $nis],
                        [
                            'user_id' => $user->id,
                            'nama' => $data['nama'],
                            'kelas_id' => $kelas->id,
                            'email' => $data['email'],
                            'foto' => 'foto/siswa-default.png',
                        ]
                    );
                }
            } else {
                // Kelas lain pakai dummy
                for ($i = 1; $i <= 5; $i++) {
                    $nama = "Siswa {$dummyCounter}";
                    $email = "siswa{$dummyCounter}@gmail.com";
                    $nis = $nisStart++;
                    $dummyCounter++;

                    $user = User::firstOrCreate(
                        ['email' => $email],
                        [
                            'name' => $nama,
                            'password' => Hash::make('siswa123'),
                            'role' => 'siswa',
                        ]
                    );

                    Siswa::firstOrCreate(
                        ['nis' => $nis],
                        [
                            'user_id' => $user->id,
                            'nama' => $nama,
                            'kelas_id' => $kelas->id,
                            'email' => $email,
                            'foto' => 'foto/siswa-default.png',
                        ]
                    );
                }
            }
        }
    }
}
