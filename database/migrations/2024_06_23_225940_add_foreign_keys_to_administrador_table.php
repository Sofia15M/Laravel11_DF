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
        Schema::table('administrador', function (Blueprint $table) {
            $table->foreign(['ID_UNIDAD'], 'administrador_ibfk_1')->references(['ID_UNIDAD'])->on('unidad')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('administrador', function (Blueprint $table) {
            $table->dropForeign('administrador_ibfk_1');
        });
    }
};
