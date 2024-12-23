<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'email',
        'no_telp',
    ];

    // Relasi ke User
    public function users()
    {
        return $this->hasMany(User::class, 'id_admin', 'id_admin');
    }

}
