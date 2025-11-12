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
        Schema::create('material_precio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('precio_id');
            $table->unsignedInteger('puntaje');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->timestamps();

            $table->index('precio_id');
            $table->index('material_id');
            $table->unique(['material_id', 'precio_id'], 'material_precio_material_id_precio_id_unique');

            $table->foreign('material_id', 'fk_material_precio_material')
                ->references('id')
                ->on('materiales')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('precio_id', 'fk_material_precio_precio')
                ->references('id')
                ->on('precios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_precio');
    }
};
