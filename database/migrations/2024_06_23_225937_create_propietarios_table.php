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
        Schema::create('propietarios', function (Blueprint $table) {
            $table->integer('ID_Propietario')->primary();
            $table->binary('Foto_Propietario');
            $table->string('Nombre_Propietario', 100);
            $table->string('Tel_Cel_Propietario', 255);
            $table->timestamp('Fecha_Registro')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->string('status', 10)->nullable()->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propietarios');
    }
};
