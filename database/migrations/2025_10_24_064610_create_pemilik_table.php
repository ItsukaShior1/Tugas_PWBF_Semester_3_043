<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pemilik', function (Blueprint $table) {
            $table->id('idpemilik');
            $table->unsignedBigInteger('iduser')->unique(); // One-to-One ke user
            $table->string('no_wa', 20)->nullable();
            $table->text('alamat')->nullable();

            // Relasi ke tabel user
            $table->foreign('iduser')->references('iduser')->on('user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemilik');
    }
};
