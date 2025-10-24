<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kategori_klinis', function (Blueprint $table) {
            $table->id('idkategori_klinis');
            $table->string('nama_kategori_klinis', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_klinis');
    }
};
