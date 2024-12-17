<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('path');
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->string('pengirim');
            $table->string('nomor_pengirim');
            $table->string('penerima');
            $table->string('nomor_penerima');
            $table->string('alamat_penerima');
            $table->string('perihal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surats');
    }
}; 