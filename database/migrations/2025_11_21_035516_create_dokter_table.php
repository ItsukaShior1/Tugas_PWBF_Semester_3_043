<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel 'dokter'
     */
    public function up(): void
    {
        Schema::create('dokter', function (Blueprint $table) {
            // Kolom Primary Key (sesuai id_dokter: int di skema)
            $table->id('iddokter'); 
            
            // Kolom data spesifik dokter
            $table->string('alamat', 100)->nullable();
            $table->string('no_hp', 45)->nullable();
            $table->string('bidang_dokter', 100);
            $table->char('jenis_kelamin', 1)->nullable(); // L (Laki-laki) atau P (Perempuan)
            
            // Kolom Foreign Key ke tabel users
            // Menggunakan unsignedBigInteger untuk FK ke tabel users.iduser (asumsi iduser adalah BIGINT)
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
     * Menghapus tabel 'dokter' jika rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};