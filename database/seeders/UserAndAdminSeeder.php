<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin di tabel admins
        DB::table('admins')->insert([
            'nama_lengkap' => 'Administrator',
            'name'         => 'admin',
            'password'     => Hash::make('admin123'),
            'email'        => 'admin@gmail.com',
            'no_telp'      => '081234567890',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // Buat user admin di tabel users
        DB::table('users')->insert([
            'id_admin' => 1,
            'name' => 'Administrator',
            'password' => Hash::make('admin123'),
            'email' => 'admin@gmail.com',
            'no_telp' => '081234567890',
            'jabatan' => 'Manager',
            'role' => 'admin', // Pastikan nilai sesuai dengan enum
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat user staff
        DB::table('users')->insert([
            'name' => 'Staff User',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staff123'),
            'no_telp' => '081234567891',
            'jabatan' => 'Staff',
            'role' => 'staff', // Pastikan nilai sesuai dengan enum
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}