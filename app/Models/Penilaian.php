<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
            'id',
            'user_id',
            'juri_id',
            'total_nilai',
            'status',
            'apresiasi',
        ];


    public function detail()
{
    return $this->hasMany(PenilaianDetail::class);
}

public function peserta()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function juri()
{
    return $this->belongsTo(User::class, 'juri_id');
}

}
