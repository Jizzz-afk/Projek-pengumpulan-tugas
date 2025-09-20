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
        return $this->belongsToMany(Mapel::class, 'jadwal', 'guru_id', 'mapel_id')->distinct();
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
    
}
