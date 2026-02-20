<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalKarya extends Model
{
    use HasFactory;

    protected $table = 'final_karya';

    protected $fillable = [
        'karya_id',
        'file_path',
        'status',
        'notes',
    ];

    public function karya()
    {
        return $this->belongsTo(KaryaTulis::class, 'karya_id');
    }
    public function karyaTulis()
    {
        return $this->belongsTo(KaryaTulis::class, 'karya_id');
    }
}
