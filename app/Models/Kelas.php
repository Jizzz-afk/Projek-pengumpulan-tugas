<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'guru_id'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
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
