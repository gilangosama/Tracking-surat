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
        Schema::create('lampirans', function (Blueprint $table) {
            $table->id('id_lampiran');
            $table->unsignedBigInteger('id_surat');
            $table->string('nama_file', 200);
            $table->timestamps();

            $table->foreign('id_surat')->references('id_surat')->on('surats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampirans');
    }
};
