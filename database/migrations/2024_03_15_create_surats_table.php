<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id('id_surat');
            $table->string('no_surat', 50);
            $table->unsignedBigInteger('id_admin');
            $table->enum('jenis_surat', ['masuk', 'keluar']);
            $table->date('tanggal_surat');
            $table->string('pengirim', 100);
            $table->string('no_pengirim', 100);
            $table->string('penerima', 100);
            $table->string('no_penerima', 100);
            $table->string('alamat_penerima', 100);
            $table->string('perihal', 100);
            $table->string('lampiran', 100)->nullable();
            $table->string('path');
            $table->timestamps();

            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('surats');
    }
}; 