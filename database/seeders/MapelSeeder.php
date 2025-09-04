<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mapel;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        $mapel = [
            // ==================== MUATAN NASIONAL / UMUM ====================
            ['nama_mapel' => 'Pendidikan Agama'],
            ['nama_mapel' => 'PPKN'],
            ['nama_mapel' => 'Bahasa Indonesia'],
            ['nama_mapel' => 'Bahasa Inggris'],
            ['nama_mapel' => 'Matematika'],
            ['nama_mapel' => 'Sejarah Indonesia'],
            ['nama_mapel' => 'Seni Budaya'],
            ['nama_mapel' => 'PJOK'],
            ['nama_mapel' => 'Simulasi dan Komunikasi Digital'],

            // ==================== DPIB ====================
            ['nama_mapel' => 'Gambar Teknik'],
            ['nama_mapel' => 'Konstruksi Bangunan'],
            ['nama_mapel' => 'Perencanaan Struktur Bangunan'],
            ['nama_mapel' => 'Estimasi Biaya Konstruksi'],

            // ==================== TEI ====================
            ['nama_mapel' => 'Elektronika Dasar'],
            ['nama_mapel' => 'Sistem Mikroprosessor'],
            ['nama_mapel' => 'Penerapan Sistem Elektronika'],
            ['nama_mapel' => 'Pemrograman Mikrokontroler'],

            // ==================== TOI ====================
            ['nama_mapel' => 'Sistem Kendali'],
            ['nama_mapel' => 'Pengendalian Otomasi'],
            ['nama_mapel' => 'PLC (Programmable Logic Control)'],
            ['nama_mapel' => 'Instalasi Sistem Otomasi'],

            // ==================== TKJ ====================
            ['nama_mapel' => 'Dasar Jaringan Komputer'],
            ['nama_mapel' => 'Administrasi Sistem Jaringan'],
            ['nama_mapel' => 'Jaringan Nirkabel'],
            ['nama_mapel' => 'Cloud Computing'],

            // ==================== RPL ====================
            ['nama_mapel' => 'Pemrograman Dasar'],
            ['nama_mapel' => 'Basis Data'],
            ['nama_mapel' => 'Pemrograman Web dan Perangkat Bergerak'],
            ['nama_mapel' => 'Rekayasa Perangkat Lunak'],

            // ==================== TITL ====================
            ['nama_mapel' => 'Dasar Instalasi Listrik'],
            ['nama_mapel' => 'Sistem Tenaga Listrik'],
            ['nama_mapel' => 'Perawatan Peralatan Listrik'],
            ['nama_mapel' => 'Instalasi Penerangan dan Tenaga'],

            // ==================== TPTUP ====================
            ['nama_mapel' => 'Dasar Pengelasan'],
            ['nama_mapel' => 'Teknik Fabrikasi Logam'],
            ['nama_mapel' => 'Produksi Komponen Mesin Las'],
            ['nama_mapel' => 'Konstruksi Las'],

            // ==================== TPM ====================
            ['nama_mapel' => 'Gambar Teknik Mesin'],
            ['nama_mapel' => 'Pemrograman Mesin CNC'],
            ['nama_mapel' => 'Pengukuran dan Instrumentasi'],
            ['nama_mapel' => 'Teknik Pemesinan Bubut, Frais, dan Gerinda'],

            // ==================== TKR ====================
            ['nama_mapel' => 'Dasar Otomotif'],
            ['nama_mapel' => 'Pemeliharaan Mesin Kendaraan Ringan'],
            ['nama_mapel' => 'Pemeliharaan Chasis dan Suspensi'],
            ['nama_mapel' => 'Sistem Kelistrikan Otomotif'],

            // ==================== TBKR ====================
            ['nama_mapel' => 'Dasar Bodi Kendaraan'],
            ['nama_mapel' => 'Perbaikan Rangka Kendaraan'],
            ['nama_mapel' => 'Finishing Bodi Kendaraan'],
            ['nama_mapel' => 'Teknik Pengecatan Kendaraan'],
        ];

        foreach ($mapel as $m) {
            Mapel::create($m);
        }
    }
}
