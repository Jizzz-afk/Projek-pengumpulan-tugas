<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = ['user_id', 'nama', 'nip', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }

    public function kelasYangDibina()
    {
        return $this->hasMany(Kelas::class);
    }

}