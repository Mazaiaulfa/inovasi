<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahapan extends Model
{
    use HasFactory;

    protected $table = 'tahapan';

    protected $fillable = ['nama', 'deskripsi', 'urutan'];

    public function proposals()
    {
        return $this->hasMany(\App\Models\Proposal::class, 'tahap_id');
    }
}
