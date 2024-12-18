<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $primaryKey = 'id_surat';

    protected $fillable = [
        'id_admin',
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
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
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

    // Relasi ke Distribution
    public function distributions()
    {
        return $this->hasMany(Distribution::class, 'id_surat', 'id_surat');
    }
} 