<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'user_id',
        'path',
        'jenis',
        'nomor_surat',
        'tanggal_surat',
        'pengirim',
        'nomor_pengirim',
        'penerima',
        'nomor_penerima',
        'alamat_penerima',
        'perihal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 