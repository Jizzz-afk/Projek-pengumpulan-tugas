<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Guru;
use Carbon\Carbon;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        $guru = Guru::first(); // ambil guru pertama
        $now = Carbon::now();

        DB::table('mapel')->insert([
            ['nama_mapel' => 'Matematika', 'guru_id' => $guru?->id, 'created_at' => $now, 'updated_at' => $now],
            ['nama_mapel' => 'Bahasa Indonesia', 'guru_id' => $guru?->id, 'created_at' => $now, 'updated_at' => $now],
            ['nama_mapel' => 'Bahasa Inggris', 'guru_id' => $guru?->id, 'created_at' => $now, 'updated_at' => $now],
            ['nama_mapel' => 'Produktif RPL', 'guru_id' => $guru?->id, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
