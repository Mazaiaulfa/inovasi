<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'item',
        'no',
        'nama',
        'keterangan',
        'rujukan',
        'skala_1_4',
        'skala_5_6',
        'skala_7_8',
        'skala_9_10',
    ];
}
