<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tracking';

    protected $fillable = [
        'id_surat',
        'lokasi',
        'status_surat',
        'tanggal_tracking',
    ];

    // Relasi ke Surat
    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat', 'id_surat');
    }
}
