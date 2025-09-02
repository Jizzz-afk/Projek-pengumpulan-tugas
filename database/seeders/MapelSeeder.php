<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\Mapel;
use Carbon\Carbon;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $gurus = Guru::all(); // Ambil semua guru

        // Daftar mapel sesuai kurikulum (bisa disesuaikan)
        $namaMapels = [
            'PAI',
            'Bahasa Indonesia',
            'Matematika',
            'Bahasa Inggris',
            'Bahasa Jepang',
            'PKN',
            'Produktif TKJ',
            'Produktif RPL',
            'Produktif TEI',
            'Produktif TITL',
            'Produktif TPM',
            'Produktif TKR',
            'Produktif TPTUP',
            'Produktif TOI',
            'Produktif DPIB',
            'Seni Budaya',
            'Penjas',
            'Simulasi Digital',
            'Kewirausahaan',
            'Fisika',
            'Kimia',
            'Biologi',
            'Sejarah',
            'Geografi',
        ];

        foreach ($gurus as $index => $guru) {
            // Kalau guru lebih banyak dari daftar mapel, kasih nama otomatis
            $namaMapel = $namaMapels[$index] ?? 'Mapel ' . ($index + 1);

            // Cek dulu, kalau belum ada baru buat
            Mapel::updateOrCreate(
                ['nama_mapel' => $namaMapel], // cek berdasarkan nama_mapel
                [
                    'guru_id' => $guru->id,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
