<?php

// database/migrations/..._create_temu_dokter_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temu_dokter', function (Blueprint $table) {
            $table->id('idreservasi_dokter'); // idreservasi_dokter INT (Primary Key)
            $table->integer('no_urut')->nullable();
            $table->timestamp('waktu_daftar')->nullable();
            $table->string('status', 50)->nullable();
            
            // Kolom dari ERD: idpet INT (Foreign Key ke tabel pets)
            $table->integer('idpet'); 
            
            // Kolom pengganti: idrole_user DIGANTI iddokter INT (Foreign Key ke dokters)
            $table->unsignedBigInteger('iddokter'); 

            // Foreign Key Constraints
            // ASUMSI: Tabel 'pets' sudah ada
            // $table->foreign('idpet')->references('idpet')->on('pets'); 
            $table->foreign('iddokter')
                  ->references('iddokter') // Merujuk ke Primary Key di tabel dokters
                  ->on('dokter')
                  ->onDelete('restrict');

            // Kita tidak perlu kolom created_at dan updated_at karena rekam_medis punya created_at sendiri
            // $table->timestamps(); // Hapus atau biarkan jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temu_dokter');
    }
};