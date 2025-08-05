<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{
    protected $table = 'pengumpulan_tugas';
    protected $fillable = ['siswa_id', 'tugas_id', 'file', 'catatan', 'nilai'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function tugas() {
        return $this->belongsTo(Tugas::class);
    }
}
