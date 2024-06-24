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
        Schema::create('apartamentos', function (Blueprint $table) {
            $table->integer('ID_Apartamento')->primary();
            $table->string('Descripcion_Apartamento', 255);
            $table->integer('ID_UNIDAD')->nullable()->index('id_unidad');
            $table->string('status', 10)->nullable()->default('active');
            $table->integer('ID_Propietario')->nullable()->index('id_propietario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartamentos');
    }
};
