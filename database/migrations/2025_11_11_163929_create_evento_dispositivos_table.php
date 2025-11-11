<?php

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
        Schema::create('evento_dispositivos', function (Blueprint $table) {
            $table->id();
            $table->string('evento');          // opened, enroll_ok, boot, etc.
            $table->string('topico')->nullable();
            $table->json('carga')->nullable(); // JSON completo recibido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento_dispositivos');
    }
};
