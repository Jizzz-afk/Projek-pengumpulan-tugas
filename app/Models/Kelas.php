<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'deskripsi', 'wali_kelas'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
