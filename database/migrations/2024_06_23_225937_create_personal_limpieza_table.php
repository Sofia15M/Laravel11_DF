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
        Schema::create('personal_limpieza', function (Blueprint $table) {
            $table->integer('ID_PersonalL')->primary();
            $table->binary('Foto_PersonalL');
            $table->string('Nombre_PersonalL', 100);
            $table->string('Edad_PersonalL', 100);
            $table->string('Cargo_PersonalL', 100);
            $table->string('Direccion_PersonalL', 255);
            $table->string('Tel_Cel_PersonalL', 255);
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
        Schema::dropIfExists('personal_limpieza');
    }
};
