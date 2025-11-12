<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear al menos 50 personas para asegurar que haya suficientes
        // para usuarios (23) y participantes (40-60), con un margen de seguridad
        $cantidadPersonasActual = \App\Models\Persona::count();
        $cantidadPersonasNecesarias = 50;

        if ($cantidadPersonasActual < $cantidadPersonasNecesarias) {
            $personasFaltantes = $cantidadPersonasNecesarias - $cantidadPersonasActual;
            \App\Models\Persona::factory($personasFaltantes)->create();
        }
    }
}
