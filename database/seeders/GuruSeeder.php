<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\User;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'guru@gmail.com')->first();

        if ($user) {
            Guru::create([
                'user_id' => $user->id,
                'nama'    => 'Pak Barkah',
                'nip'     => '12345678',
                'email'   => 'guru@gmail.com',
                'foto'    => 'foto/guru-default.png',
            ]);
        }
    }
}
