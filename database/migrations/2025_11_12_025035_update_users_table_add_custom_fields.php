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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('persona_id')->after('id');
            $table->string('profile_picture', 300)->nullable()->after('email');
            $table->enum('status_user', ['Activo', 'Inactivo', 'Eliminado'])->default('Activo')->after('profile_picture');
            $table->enum('rol', ['Administrador', 'Usuario'])->default('Usuario')->after('updated_at');

            $table->index('persona_id');

            $table->foreign('persona_id', 'fk_users_persona')
                ->references('id')
                ->on('personas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('fk_users_persona');
            $table->dropIndex(['persona_id']);
            $table->dropColumn(['persona_id', 'profile_picture', 'status_user', 'rol']);
        });
    }
};
