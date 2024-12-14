<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = ['user_id', 'nama_file', 'path', 'jenis'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 