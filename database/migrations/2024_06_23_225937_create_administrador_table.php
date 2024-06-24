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
        Schema::create('administrador', function (Blueprint $table) {
            $table->integer('ID_Administrador')->primary();
            $table->binary('Foto_Administrador');
            $table->string('Nombre_Administrador', 100);
            $table->string('Edad_Administrador', 100);
            $table->string('Cargo_Administrador', 100);
            $table->string('Direccion_Administrador', 255);
            $table->string('Tel_Cel_Administrador', 255);
            $table->string('Tiempo_trabajo', 100);
            $table->timestamp('Fecha_Registro')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('ID_UNIDAD')->nullable()->index('id_unidad');
            $table->enum('Estado', ['activo', 'inactivo'])->nullable()->default('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrador');
    }
};
