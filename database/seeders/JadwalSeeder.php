<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        // Mapping guru -> mapel
        $guruMapel = [
            'Bu Titin'   => 'Gambar Teknik',
            'Pak Joko'   => 'Konstruksi Bangunan',
            'Bu Anisa'   => 'Perencanaan Struktur Bangunan',
            'Pak Fajar'  => 'Estimasi Biaya Konstruksi',

            'Bu Ratna'   => 'Elektronika Dasar',
            'Pak Budi'   => 'Sistem Mikroprosessor',
            'Bu Wulan'   => 'Penerapan Sistem Elektronika',
            'Pak Rian'   => 'Pemrograman Mikrokontroler',

            'Bu Sinta'   => 'Dasar Jaringan Komputer',
            'Pak Andi'   => 'Administrasi Sistem Jaringan',

            'Bu Dewi'    => 'Pemrograman Dasar',
            'Pak Heru'   => 'Pemrograman Web dan Perangkat Bergerak',

            'Bu Lestari' => 'Dasar Instalasi Listrik',
            'Pak Eko'    => 'Sistem Tenaga Listrik',
            'Bu Rini'    => 'Instalasi Penerangan dan Tenaga',

            'Pak Doni'   => 'Dasar Pengelasan',

            'Bu Maya'    => 'Gambar Teknik Mesin',
            'Pak Yudi'   => 'Pemrograman Mesin CNC',
            'Bu Lina'    => 'Teknik Pemesinan Bubut, Frais, dan Gerinda',

            'Pak Agus'   => 'Dasar Otomotif',
            'Bu Rani'    => 'Pemeliharaan Mesin Kendaraan Ringan',
            'Pak Arif'   => 'Sistem Kelistrikan Otomotif',

            'Bu Yuni'    => 'Dasar Bodi Kendaraan',
        ];

        foreach ($guruMapel as $guruNama => $mapelNama) {
            $guru  = Guru::where('nama', $guruNama)->first();
            $mapel = Mapel::where('nama_mapel', $mapelNama)->first();

            if ($guru && $mapel) {
                $jurusanKeyword = explode(' ', $mapelNama)[0]; 
                $kelasList = Kelas::where('wali_kelas', $guruNama)->get();
                if ($kelasList->isEmpty()) {
                    if (str_contains($mapelNama, 'Bangunan') || str_contains($mapelNama, 'Gambar')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%DPIB%')->get();
                    } elseif (str_contains($mapelNama, 'Elektronika') || str_contains($mapelNama, 'Mikro')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%TEI%')->get();
                    } elseif (str_contains($mapelNama, 'Jaringan')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%TKJ%')->get();
                    } elseif (str_contains($mapelNama, 'Pemrograman') || str_contains($mapelNama, 'Rekayasa')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%RPL%')->get();
                    } elseif (str_contains($mapelNama, 'Instalasi') || str_contains($mapelNama, 'Listrik')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%TITL%')->get();
                    } elseif (str_contains($mapelNama, 'Pengelasan')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%TPTUP%')->get();
                    } elseif (str_contains($mapelNama, 'Mesin')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%TPM%')->get();
                    } elseif (str_contains($mapelNama, 'Otomotif')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%TKR%')->get();
                    } elseif (str_contains($mapelNama, 'Bodi')) {
                        $kelasList = Kelas::where('nama_kelas', 'like', '%TBKR%')->get();
                    }
                }

                foreach ($kelasList as $kelas) {
                    Jadwal::firstOrCreate([
                        'guru_id'  => $guru->id,
                        'kelas_id' => $kelas->id,
                        'mapel_id' => $mapel->id,
                    ]);
                }
            }
        }
    }
}
