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
        Schema::create('domiciliarios', function (Blueprint $table) {
            $table->integer('Id_Domiciliario')->primary();
            $table->string('Nombre_Recidente', 200)->nullable();
            $table->string('Foto_Domiciliario');
            $table->string('Nombre_Domiciliario', 200)->nullable();
            $table->integer('id_Apartamento')->nullable()->index('id_apartamento');
            $table->enum('estado', ['activo', 'inactivo'])->nullable()->default('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domiciliarios');
    }
};
