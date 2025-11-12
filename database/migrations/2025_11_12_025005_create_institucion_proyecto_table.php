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
        Schema::create('institucion_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institucion_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['Iniciado', 'En Pausa', 'Finalizado'])->default('Iniciado');
            $table->timestamps();

            $table->index('proyecto_id');
            $table->index('institucion_id');

            $table->foreign('institucion_id', 'fk_institucion_proyecto_institucion')
                ->references('id')
                ->on('instituciones')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('proyecto_id', 'fk_institucion_proyecto_proyecto')
                ->references('id')
                ->on('proyectos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institucion_proyecto');
    }
};
