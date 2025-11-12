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
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institucion_proyecto_id');
            $table->text('motivo');
            $table->date('fecha');
            $table->time('hora');
            $table->string('lugar', 255);
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->date('fecha_inicial');
            $table->date('fecha_final')->nullable();
            $table->timestamps();

            $table->index('institucion_proyecto_id');

            $table->foreign('institucion_proyecto_id', 'fk_anuncios_institucion_proyecto')
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
        Schema::dropIfExists('anuncios');
    }
};
