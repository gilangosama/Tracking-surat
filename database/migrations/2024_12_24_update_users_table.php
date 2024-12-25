<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengubah kolom role menjadi enum jika belum
            DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'staff') NOT NULL");
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan kolom role ke varchar jika perlu rollback
            $table->string('role')->change();
        });
    }
}; 