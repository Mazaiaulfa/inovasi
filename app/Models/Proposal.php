<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{

    use HasFactory;
    protected $table = 'proposal';

    protected $fillable = [
        'karya_id',
        'file_path',
        'status',
        'catatan',
        'tahap_id'
    ];

    public function karya()
    {
        return $this->belongsTo(KaryaTulis::class, 'karya_id');
    }

    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class, 'tahap_id');
    }
    
}
