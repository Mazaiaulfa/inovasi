<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilAkhir extends Model
{
    use HasFactory;
    protected $table = 'hasil_akhirs';
    protected $fillable = ['id','karya_id','rata_nilai','jumlah_juri','total_juri','apresiasi','is_complete','is_published','created_at', 'updated_at'];

    public function peserta()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'karya_id');
    }
    public function karya()
    {
        return $this->belongsTo(KaryaTulis::class, 'karya_id');
    }
}
