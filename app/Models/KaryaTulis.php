<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaTulis extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'judul', 'status_judul', 'catatan_judul','file_ajukan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->hasOne(Proposal::class, 'karya_id');
    }
    public function karyaTulis()
    {
        return $this->belongsTo(KaryaTulis::class, 'karya_id');
    }
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'user_id', 'user_id');
    }
}
