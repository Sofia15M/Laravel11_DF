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
        Schema::create('residentes', function (Blueprint $table) {
            $table->id('ID_Residente');
            $table->string('Foto_Residente')->nullable(); // Permite nulos
            $table->string('Nombre_Residente', 100);
            $table->string('Tel_Cel_Residente', 255);
            $table->timestamp('Fecha_Registro')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('ID_Apartamento')->nullable()->index('id_apartamento');
            $table->string('status', 10)->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residentes');
    }
};
