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
        // Mapping guru -> kelas -> mapel
        $data = [
            ['guru' => 'Bu Titin',   'kelas' => 'XII DPIB 1', 'mapel' => 'Gambar Teknik'],
            ['guru' => 'Pak Joko',   'kelas' => 'XII DPIB 2', 'mapel' => 'Konstruksi Bangunan'],
            ['guru' => 'Bu Anisa',   'kelas' => 'XII DPIB 3', 'mapel' => 'Perencanaan Struktur Bangunan'],
            ['guru' => 'Pak Fajar',  'kelas' => 'XII DPIB 4', 'mapel' => 'Estimasi Biaya Konstruksi'],

            ['guru' => 'Bu Ratna',   'kelas' => 'XII TEI 1',  'mapel' => 'Elektronika Dasar'],
            ['guru' => 'Pak Budi',   'kelas' => 'XII TEI 2',  'mapel' => 'Sistem Mikroprosessor'],
            ['guru' => 'Bu Wulan',   'kelas' => 'XII TEI 3',  'mapel' => 'Penerapan Sistem Elektronika'],
            ['guru' => 'Pak Rian',   'kelas' => 'XII TOI',    'mapel' => 'Pemrograman Mikrokontroler'],

            ['guru' => 'Bu Sinta',   'kelas' => 'XII TKJ 1',  'mapel' => 'Dasar Jaringan Komputer'],
            ['guru' => 'Pak Andi',   'kelas' => 'XII TKJ 2',  'mapel' => 'Administrasi Sistem Jaringan'],

            ['guru' => 'Bu Dewi',    'kelas' => 'XII RPL 1',  'mapel' => 'Pemrograman Dasar'],
            ['guru' => 'Pak Heru',   'kelas' => 'XII RPL 2',  'mapel' => 'Pemrograman Web dan Perangkat Bergerak'],

            ['guru' => 'Bu Lestari', 'kelas' => 'XII TITL 1', 'mapel' => 'Dasar Instalasi Listrik'],
            ['guru' => 'Pak Eko',    'kelas' => 'XII TITL 2', 'mapel' => 'Sistem Tenaga Listrik'],
            ['guru' => 'Bu Rini',    'kelas' => 'XII TITL 3', 'mapel' => 'Instalasi Penerangan dan Tenaga'],

            ['guru' => 'Pak Doni',   'kelas' => 'XII TPTUP',  'mapel' => 'Dasar Pengelasan'],

            ['guru' => 'Bu Maya',    'kelas' => 'XII TPM 1',  'mapel' => 'Gambar Teknik Mesin'],
            ['guru' => 'Pak Yudi',   'kelas' => 'XII TPM 2',  'mapel' => 'Pemrograman Mesin CNC'],
            ['guru' => 'Bu Lina',    'kelas' => 'XII TPM 3',  'mapel' => 'Teknik Pemesinan Bubut, Frais, dan Gerinda'],

            ['guru' => 'Pak Agus',   'kelas' => 'XII TKR 1',  'mapel' => 'Dasar Otomotif'],
            ['guru' => 'Bu Rani',    'kelas' => 'XII TKR 2',  'mapel' => 'Pemeliharaan Mesin Kendaraan Ringan'],
            ['guru' => 'Pak Arif',   'kelas' => 'XII TKR 3',  'mapel' => 'Sistem Kelistrikan Otomotif'],

            ['guru' => 'Bu Yuni',    'kelas' => 'XII TBKR',   'mapel' => 'Dasar Bodi Kendaraan'],
        ];

        foreach ($data as $d) {
            $guru  = Guru::where('nama', $d['guru'])->first();
            $kelas = Kelas::where('nama_kelas', $d['kelas'])->first();
            $mapel = Mapel::where('nama_mapel', $d['mapel'])->first();

            if ($guru && $kelas && $mapel) {
                Jadwal::firstOrCreate([
                    'guru_id'  => $guru->id,
                    'kelas_id' => $kelas->id,
                    'mapel_id' => $mapel->id,
                ]);
            }
        }
    }
}
