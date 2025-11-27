<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel 'perawat'
     */
    public function up(): void
    {
        Schema::create('perawat', function (Blueprint $table) {
            // Kolom Primary Key (sesuai id_perawat: int di skema)
            $table->id('idperawat'); 

            // Kolom data spesifik perawat
            $table->string('alamat', 100)->nullable();
            $table->string('no_hp', 45)->nullable();
            $table->char('jenis_kelamin', 1)->nullable(); // L atau P
            $table->string('pendidikan', 100)->nullable();
            
            // Kolom Foreign Key ke tabel users
            $table->unsignedBigInteger('iduser')->unique(); 

            // Definisi Foreign Key constraint
            $table->foreign('iduser')
                  ->references('iduser')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * Menghapus tabel 'perawat' jika rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('perawat');
    }
};