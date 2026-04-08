<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianDetail extends Model
{
    use HasFactory;

    protected $fillable = [
            'id',
            'penilaian_id',
            'kriteria_id',
            'nilai'
        ];

    public function penilaian()
{
    return $this->belongsTo(Penilaian::class);
}

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
