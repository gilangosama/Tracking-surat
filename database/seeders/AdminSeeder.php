<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
                'nama_lengkap' => 'Viky Rodiatul Ulum',
                'name'         => 'admin',
                'password'     => Hash::make('password123'),
                'email'        => 'admin@gmail.com',
                'no_telp'      => '081234567890',
                'created_at'   => now(),
                'updated_at'   => now(),
        ]);

        DB::table('users')->insert([
                'id_admin' => 1,
                'name' => 'admin',
                'password' => Hash::make('password123'),
                'email' => 'admin@gmail.com',
                'no_telp' => '081234567890',
                'jabatan' => 'Manager',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
    }
}
