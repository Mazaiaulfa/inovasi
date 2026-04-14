<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilAkhir extends Model
{
    use HasFactory;
    protected $table = 'hasil_akhirs';
    protected $guarded = ['id', 'user_id','rata_nilai','jumlah_juri','total_juri','is_complete','is_published','created_at', 'updated_at'];

    public function peserta()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
