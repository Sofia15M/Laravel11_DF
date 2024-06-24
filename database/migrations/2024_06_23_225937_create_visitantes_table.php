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
        Schema::create('visitantes', function (Blueprint $table) {
            $table->integer('ID_Visitante')->primary();
            $table->binary('Foto_Visitante');
            $table->string('Nombre_Visitante', 100);
            $table->string('Tel_Cel_Visitante', 255);
            $table->timestamp('Fecha_Registro')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->dateTime('Hora_Ingreso')->nullable();
            $table->dateTime('Hora_Salida')->nullable();
            $table->integer('ID_Apartamento')->nullable()->index('id_apartamento');
            $table->string('status', 10)->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitantes');
    }
};
