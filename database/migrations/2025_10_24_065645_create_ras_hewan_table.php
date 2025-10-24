<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ras_hewan', function (Blueprint $table) {
            $table->id('idras_hewan');
            $table->string('nama_ras', 100);
            
            // Foreign key ke jenis_hewan
            $table->unsignedBigInteger('idjenis_hewan');

            $table->foreign('idjenis_hewan')
                  ->references('idjenis_hewan')
                  ->on('jenis_hewan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ras_hewan');
    }
};
