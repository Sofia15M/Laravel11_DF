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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 255)->nullable();
            $table->binary('foto_user')->nullable();
            $table->string('email', 255)->nullable()->unique('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            $table->rememberToken();
            $table->integer('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->integer('id_rol')->nullable()->index('id_rol');
            $table->integer('id_unidad')->nullable()->index('id_unidad');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
