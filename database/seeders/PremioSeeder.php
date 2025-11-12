<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articulos = \App\Models\Articulo::all();
        $institucionProyectos = \App\Models\InstitucionProyecto::all();
        $tipos = ['Canje por puntaje', 'Canje por Ranking'];

        // Crear premios asociando artículos con instituciones/proyectos
        foreach ($articulos as $articulo) {
            $numInstituciones = fake()->numberBetween(2, 4);
            $institucionesAsignadas = $institucionProyectos->random($numInstituciones);

            foreach ($institucionesAsignadas as $institucionProyecto) {
                $tipo = fake()->randomElement($tipos);
                $puntajeRequerido = fake()->numberBetween(100, 1000);

                \App\Models\Premio::create([
                    'articulo_id' => $articulo->id,
                    'institucion_proyecto_id' => $institucionProyecto->id,
                    'tipo' => $tipo,
                    'puntaje_requerido' => $puntajeRequerido,
                    'estado' => 'Disponible',
                ]);
            }
        }
    }
}
