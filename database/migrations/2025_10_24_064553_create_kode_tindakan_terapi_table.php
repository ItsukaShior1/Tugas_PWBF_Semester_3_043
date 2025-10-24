<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kode_tindakan_terapi', function (Blueprint $table) {
            $table->id('idkode_tindakan_terapi');
            $table->string('kode', 50)->unique();
            $table->string('deskripsi_tindakan_terapi', 255);
            
            // Relasi ke kategori & kategori klinis
            $table->unsignedBigInteger('idkategori')->nullable();
            $table->unsignedBigInteger('idkategori_klinis')->nullable();

            $table->foreign('idkategori')->references('idkategori')->on('kategori')->onDelete('set null');
            $table->foreign('idkategori_klinis')->references('idkategori_klinis')->on('kategori_klinis')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kode_tindakan_terapi');
    }
};
