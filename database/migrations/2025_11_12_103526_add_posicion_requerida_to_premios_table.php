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
        Schema::table('premios', function (Blueprint $table) {
            // Hacer puntaje_requerido nullable
            $table->unsignedInteger('puntaje_requerido')->nullable()->change();

            // Agregar posicion_requerida
            $table->unsignedInteger('posicion_requerida')->nullable()->after('puntaje_requerido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('premios', function (Blueprint $table) {
            // Eliminar posicion_requerida
            $table->dropColumn('posicion_requerida');

            // Restaurar puntaje_requerido como no nullable
            $table->unsignedInteger('puntaje_requerido')->nullable(false)->change();
        });
    }
};
