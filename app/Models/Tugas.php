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
        'file',
        'deadline'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pengumpulan()
    {
        return $this->hasMany(Pengumpulan::class);
    }
}
