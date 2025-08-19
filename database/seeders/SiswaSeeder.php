<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'siswa@gmail.com')->first();
        $kelas = Kelas::where('nama_kelas', 'XII RPL 1')->first();

        if ($user && $kelas) {
            Siswa::create([
                'user_id'  => $user->id,
                'kelas_id' => $kelas->id,
                'nama'     => 'Budi',
                'nis'      => '11223344',
                'email'    => 'siswa@gmail.com',
                'foto'     => 'foto/siswa-default.png',
            ]);
        }
    }
}
