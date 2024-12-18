<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id('id_tracking');
            $table->unsignedBigInteger('id_surat');
            $table->string('lokasi', 150);
            $table->enum('status_surat', ['diproses', 'sedang dikirim', 'sudah diterima']);
            $table->timestamp('tanggal_tracking');
            $table->timestamps();

            $table->foreign('id_surat')->references('id_surat')->on('surats')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
