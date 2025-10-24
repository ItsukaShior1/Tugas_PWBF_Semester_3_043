<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id('idrole_user');
            $table->foreignId('iduser')->constrained('users', 'iduser');
            $table->foreignId('idrole')->constrained('roles', 'idrole');
            $table->boolean('status')->default(true);  // role aktif atau tidak
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
