<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Backup data yang ada
        $users = DB::table('users')->get();
        
        // Ubah tipe kolom role
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom role yang lama
            $table->dropColumn('role');
        });
        
        Schema::table('users', function (Blueprint $table) {
            // Buat kolom role baru dengan tipe enum
            $table->enum('role', ['admin', 'staff'])->after('jabatan');
        });
        
        // Kembalikan data yang sudah di-backup
        foreach ($users as $user) {
            DB::table('users')
                ->where('id_user', $user->id_user)
                ->update(['role' => $user->role]);
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->change();
        });
    }
}; 