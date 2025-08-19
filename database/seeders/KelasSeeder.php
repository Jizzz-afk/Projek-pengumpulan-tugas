<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('kelas')->insert([
            ['nama_kelas' => 'XII DPIB 1', 'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 1', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII DPIB 2', 'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII DPIB 3', 'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 3', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII DPIB 4', 'deskripsi' => 'Kelas 12 Desain Pemodelan dan Informasi Bangunan 4', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TEI 1',  'deskripsi' => 'Kelas 12 Teknik Elektronika Industri 1', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TEI 2',  'deskripsi' => 'Kelas 12 Teknik Elektronika Industri 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TEI 3',  'deskripsi' => 'Kelas 12 Teknik Elektronika Industri 3', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TOI',    'deskripsi' => 'Kelas 12 Teknik Otomasi Industri', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TKJ 1',  'deskripsi' => 'Kelas 12 Teknik Komputer dan Jaringan 1', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TKJ 2',  'deskripsi' => 'Kelas 12 Teknik Komputer dan Jaringan 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII RPL 1',  'deskripsi' => 'Kelas 12 Rekayasa Perangkat Lunak 1', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII RPL 2',  'deskripsi' => 'Kelas 12 Rekayasa Perangkat Lunak 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TITL 1', 'deskripsi' => 'Kelas 12 Teknik Instalasi Tenaga Listrik 1', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TITL 2', 'deskripsi' => 'Kelas 12 Teknik Instalasi Tenaga Listrik 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TITL 3', 'deskripsi' => 'Kelas 12 Teknik Instalasi Tenaga Listrik 3', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TPTUP',  'deskripsi' => 'Kelas 12 Teknik Pengelasan dan Teknik Usaha Produksi', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TPM 1',  'deskripsi' => 'Kelas 12 Teknik Pemesinan 1', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TPM 2',  'deskripsi' => 'Kelas 12 Teknik Pemesinan 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TPM 3',  'deskripsi' => 'Kelas 12 Teknik Pemesinan 3', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TKR 1',  'deskripsi' => 'Kelas 12 Teknik Kendaraan Ringan 1', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TKR 2',  'deskripsi' => 'Kelas 12 Teknik Kendaraan Ringan 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TKR 3',  'deskripsi' => 'Kelas 12 Teknik Kendaraan Ringan 3', 'created_at' => $now, 'updated_at' => $now],
            ['nama_kelas' => 'XII TBKR',   'deskripsi' => 'Kelas 12 Teknik Bodi Kendaraan Ringan', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
