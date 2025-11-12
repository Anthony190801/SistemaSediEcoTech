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
        Schema::create('canjes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('premio_id');
            $table->unsignedBigInteger('participante_id');
            $table->date('fecha_solicitud_canje');
            $table->enum('estado', ['Pendiente', 'Programado', 'Entregado'])->default('Pendiente');
            $table->unsignedBigInteger('respuesta_id')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->timestamps();

            $table->index('premio_id');
            $table->index('participante_id');
            $table->index('respuesta_id');

            $table->foreign('premio_id', 'fk_canjes_premio')
                ->references('id')
                ->on('premios')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('participante_id', 'fk_canjes_participante')
                ->references('id')
                ->on('participantes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('respuesta_id', 'fk_canjes_respuesta')
                ->references('id')
                ->on('respuestas')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canjes');
    }
};
