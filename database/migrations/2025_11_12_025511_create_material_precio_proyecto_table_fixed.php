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
        Schema::create('material_precio_proyecto', function (Blueprint $table) {
            $table->unsignedBigInteger('material_precio_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->primary(['material_precio_id', 'proyecto_id']);

            $table->index('material_precio_id');
            $table->index('proyecto_id');

            $table->foreign('material_precio_id', 'fk_material_precio_proyecto_material_precio')
                ->references('id')
                ->on('material_precio')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('proyecto_id', 'fk_material_precio_proyecto_proyecto')
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
        Schema::dropIfExists('material_precio_proyecto');
    }
};
