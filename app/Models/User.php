<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'direktorat',
        'kompartemen',
        'unit_kerja',
        'email',
        'password',
        'role',
        'jenis_peserta',
    ];

    public function karyaTulis()
    {
        return $this->hasMany(KaryaTulis::class, 'user_id');
    }
    public function finalKarya()
{
    return $this->hasOneThrough(
        \App\Models\FinalKarya::class,
        \App\Models\KaryaTulis::class,
        'user_id',   // FK di karya_tulis
        'karya_id',  // FK di final_karya
        'id',        // PK di users
        'id'         // PK di karya_tulis
    );
}
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'user_id');
    }


    public function pesertaYangDinilai()
    {
        return $this->belongsToMany(User::class, 'juri_peserta', 'juri_id', 'peserta_id');
    }

    public function juriPenilai()
    {
        return $this->belongsToMany(User::class, 'juri_peserta', 'peserta_id', 'juri_id');
    }

    public function hasilAkhir()
{
    return $this->hasOne(HasilAkhir::class, 'user_id');
}

   public function penilaian()
{
    return $this->hasOne(Penilaian::class, 'user_id');
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
