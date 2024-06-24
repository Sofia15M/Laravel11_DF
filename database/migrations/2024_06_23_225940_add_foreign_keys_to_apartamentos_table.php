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
        Schema::table('apartamentos', function (Blueprint $table) {
            $table->foreign(['ID_UNIDAD'], 'apartamentos_ibfk_1')->references(['ID_UNIDAD'])->on('unidad')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['ID_Propietario'], 'apartamentos_ibfk_2')->references(['ID_Propietario'])->on('propietarios')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartamentos', function (Blueprint $table) {
            $table->dropForeign('apartamentos_ibfk_1');
            $table->dropForeign('apartamentos_ibfk_2');
        });
    }
};
