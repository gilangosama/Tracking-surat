<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $primaryKey = 'id_surat';

    protected $fillable = [
        'id_user',
        'jenis_surat',
        'no_surat',
        'perihal',
        'lampiran',
        'tanggal_surat',
        'pengirim',
        'no_pengirim',
        'penerima',
        'no_penerima',
        'alamat_penerima',
        'path'
    ];

    // Relasi ke Admin
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke Lampiran
    public function lampirans()
    {
        return $this->hasMany(Lampiran::class, 'id_surat', 'id_surat');
    }

    // Relasi ke Tracking
    public function trackings()
    {
        return $this->hasMany(Tracking::class, 'id_surat', 'id_surat');
    }
    public function lastTracking()
    {
        return $this->hasOne(Tracking::class, 'id_surat', 'id_surat')
                    ->latest('created_at');
    }

    public function trackingStatus()
    {
        return $this->hasMany(Tracking::class, 'id_surat', 'id_surat')
                    ->where('status_surat', 'sudah diterima');
    }

    // Relasi ke Distribution
    public function distributions()
    {
        return $this->hasMany(Distribution::class, 'id_surat', 'id_surat');
    }
} 