<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';

    protected $fillable = [
        'nama_mapel',
        'guru_id',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
    public function guru()
    {
        return $this->belongsToMany(Guru::class, 'jadwal', 'mapel_id', 'guru_id');
    }
}
