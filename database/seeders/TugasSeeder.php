<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tugas;
use App\Models\Jadwal;
use Carbon\Carbon;

class TugasSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = Jadwal::with('mapel')->get();

        if ($jadwals->isEmpty()) {
            $this->command->warn("⚠️ Tidak ada data jadwal. Jalankan dulu GuruSeeder & JadwalSeeder sebelum TugasSeeder.");
            return;
        }

        $tugasList = [
            'Pendidikan Agama' => 'Buat rangkuman materi akhlak mulia',
            'PPKN' => 'Analisis kasus tentang hak dan kewajiban warga negara',
            'Bahasa Indonesia' => 'Tulis esai 500 kata tentang budaya lokal',
            'Bahasa Inggris' => 'Buat dialog sederhana menggunakan grammar yang benar',
            'Matematika' => 'Kerjakan soal persamaan kuadrat',
            'Sejarah Indonesia' => 'Buat timeline peristiwa proklamasi',
            'Seni Budaya' => 'Buat sketsa karya seni sesuai tema kebudayaan',
            'PJOK' => 'Catat hasil olahraga lari 12 menit',
            'Simulasi dan Komunikasi Digital' => 'Desain poster digital menggunakan Canva',

            'Gambar Teknik' => 'Gambar denah rumah sederhana dengan standar ISO',
            'Konstruksi Bangunan' => 'Hitung kebutuhan material untuk dinding',
            'Perencanaan Struktur Bangunan' => 'Analisis kekuatan balok beton',
            'Estimasi Biaya Konstruksi' => 'Buat RAB sederhana untuk proyek kecil',

            'Elektronika Dasar' => 'Rangkai dan analisis resistor seri dan paralel',
            'Sistem Mikroprosessor' => 'Jelaskan fungsi dasar mikroprosesor',
            'Penerapan Sistem Elektronika' => 'Buat laporan praktik power supply',
            'Pemrograman Mikrokontroler' => 'Program LED blinking dengan Arduino',

            'Sistem Kendali' => 'Simulasikan sistem kendali motor listrik',
            'Pengendalian Otomasi' => 'Laporan penggunaan sensor otomatis',
            'PLC (Programmable Logic Control)' => 'Buat ladder diagram sederhana',
            'Instalasi Sistem Otomasi' => 'Praktek instalasi rangkaian relay',

            'Dasar Jaringan Komputer' => 'Topologi jaringan LAN dengan Cisco Packet Tracer',
            'Administrasi Sistem Jaringan' => 'Konfigurasi IP address di Linux',
            'Jaringan Nirkabel' => 'Buat laporan setting access point',
            'Cloud Computing' => 'Buat akun dan deploy aplikasi sederhana di cloud',

            'Pemrograman Dasar' => 'Buat program perhitungan luas segitiga',
            'Basis Data' => 'Desain ERD sistem kasir sederhana',
            'Pemrograman Web dan Perangkat Bergerak' => 'Buat halaman HTML dengan Bootstrap',
            'Rekayasa Perangkat Lunak' => 'Analisis kebutuhan sistem e-learning',

            'Dasar Instalasi Listrik' => 'Buat rangkaian instalasi lampu rumah',
            'Sistem Tenaga Listrik' => 'Analisis distribusi listrik sederhana',
            'Perawatan Peralatan Listrik' => 'Laporan hasil perawatan kipas angin',
            'Instalasi Penerangan dan Tenaga' => 'Hitung kebutuhan daya ruangan',

            'Dasar Pengelasan' => 'Praktik pengelasan sudut',
            'Teknik Fabrikasi Logam' => 'Laporan pembuatan sambungan baja',
            'Produksi Komponen Mesin Las' => 'Desain komponen mesin sederhana',
            'Konstruksi Las' => 'Buat model konstruksi sederhana dari besi',

            'Gambar Teknik Mesin' => 'Buat gambar 2D komponen mekanik',
            'Pemrograman Mesin CNC' => 'Tulis kode G untuk mesin bubut',
            'Pengukuran dan Instrumentasi' => 'Laporan penggunaan jangka sorong',
            'Teknik Pemesinan Bubut, Frais, dan Gerinda' => 'Praktik pemotongan besi dengan bubut',

            'Dasar Otomotif' => 'Identifikasi komponen utama mesin bensin',
            'Pemeliharaan Mesin Kendaraan Ringan' => 'Praktik tune-up motor bensin',
            'Pemeliharaan Chasis dan Suspensi' => 'Cek kondisi shockbreaker',
            'Sistem Kelistrikan Otomotif' => 'Praktik pemasangan lampu kendaraan',

            'Dasar Bodi Kendaraan' => 'Identifikasi kerusakan bodi mobil',
            'Perbaikan Rangka Kendaraan' => 'Laporan perbaikan rangka sederhana',
            'Finishing Bodi Kendaraan' => 'Praktik amplas permukaan bodi',
            'Teknik Pengecatan Kendaraan' => 'Praktik pengecatan panel kecil',
        ];

        foreach ($jadwals as $jadwal) {
            $mapelName = $jadwal->mapel->nama_mapel ?? null;

            if ($mapelName && isset($tugasList[$mapelName])) {
                Tugas::create([
                    'jadwal_id' => $jadwal->id,
                    'judul'     => "Tugas {$mapelName}",
                    'deskripsi' => $tugasList[$mapelName],
                    'deadline'  => Carbon::now()->addDays(rand(5, 14)),
                    'foto_tugas'=> null,
                ]);
            }
        }

        $this->command->info("✅ TugasSeeder berhasil dibuat untuk setiap mapel yang punya jadwal.");
    }
}
