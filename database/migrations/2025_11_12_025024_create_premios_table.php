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
        Schema::create('premios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('articulo_id');
            $table->unsignedBigInteger('institucion_proyecto_id');
            $table->enum('tipo', ['Canje por puntaje', 'Canje por Ranking']);
            $table->unsignedInteger('puntaje_requerido');
            $table->enum('estado', ['Disponible', 'No Disponible'])->default('Disponible');
            $table->timestamps();

            $table->index('articulo_id');
            $table->index('institucion_proyecto_id');

            $table->foreign('articulo_id', 'fk_premios_articulo')
                ->references('id')
                ->on('articulos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('institucion_proyecto_id', 'fk_premios_institucion_proyecto')
                ->references('id')
                ->on('institucion_proyecto')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premios');
    }
};
