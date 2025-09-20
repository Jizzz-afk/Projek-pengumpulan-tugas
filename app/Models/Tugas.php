<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $fillable = [
        'jadwal_id',
        'judul',
        'deskripsi',
        'foto_tugas',
        'deadline'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function mapel()
    {
        return $this->hasOneThrough(Mapel::class, Jadwal::class, 'id', 'id', 'jadwal_id', 'mapel_id');
    }

    public function pengumpulan()
    {
        return $this->hasMany(Pengumpulan::class);
    }
}
