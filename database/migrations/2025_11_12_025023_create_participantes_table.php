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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institucion_proyecto_id');
            $table->unsignedBigInteger('persona_id');
            $table->string('uuid', 36)->unique();
            $table->year('anio');
            $table->enum('nivel_academico', ['Inicial', 'Primaria', 'Secundaria', 'Universitario']);
            $table->unsignedInteger('ciclo_o_grado');
            $table->string('aula', 10);
            $table->unsignedInteger('puntaje_total')->default(0);
            $table->timestamps();

            $table->index('persona_id');
            $table->index('institucion_proyecto_id');

            $table->foreign('persona_id', 'fk_participantes_persona')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('institucion_proyecto_id', 'fk_participantes_institucion_proyecto')
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
        Schema::dropIfExists('participantes');
    }
};
