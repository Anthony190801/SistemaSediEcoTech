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
        Schema::create('recolecciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participante_id');
            $table->unsignedBigInteger('material_precio_id');
            $table->double('cantidad_kilogramos');
            $table->date('fecha');
            $table->enum('estado', ['Pendiente', 'Validado', 'Rechazado'])->default('Validado');
            $table->timestamps();

            $table->index('participante_id');
            $table->index('material_precio_id');

            $table->foreign('participante_id', 'fk_recolecciones_participante')
                ->references('id')
                ->on('participantes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('material_precio_id', 'fk_recolecciones_material_precio')
                ->references('id')
                ->on('material_precio')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recolecciones');
    }
};
