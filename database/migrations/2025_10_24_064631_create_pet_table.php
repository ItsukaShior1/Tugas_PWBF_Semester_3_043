<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pet', function (Blueprint $table) {
            $table->id('idpet');
            $table->string('nama', 100);
            $table->date('tanggal_lahir')->nullable();
            $table->string('warna_tanda', 100)->nullable();
            $table->enum('jenis_kelamin', ['Jantan', 'Betina']);
            
            $table->unsignedBigInteger('idpemilik');
            $table->unsignedBigInteger('idras_hewan');

            $table->foreign('idpemilik')->references('idpemilik')->on('pemilik')->onDelete('cascade');
            $table->foreign('idras_hewan')->references('idras_hewan')->on('ras_hewan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet');
    }
};
