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
        Schema::create('vigilantes', function (Blueprint $table) {
            $table->integer('ID_Vigilante')->primary();
            $table->binary('Foto_Vigilante');
            $table->string('Nombre_Vigilante', 100);
            $table->string('Edad_Vigilante', 100);
            $table->string('Cargo_Vigilante', 100);
            $table->string('Direccion_Vigilante', 255);
            $table->string('Tel_Cel_Vigilante', 255);
            $table->string('Tiempo_trabajo', 100);
            $table->timestamp('Fecha_Registro')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('ID_UNIDAD')->nullable()->index('id_unidad');
            $table->string('status', 10)->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vigilante');
    }
};
