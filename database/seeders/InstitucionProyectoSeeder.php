<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InstitucionProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instituciones = \App\Models\Institucion::all();
        $proyectos = \App\Models\Proyecto::all();

        // Asociar cada institución a 1 o 2 proyectos
        foreach ($instituciones as $institucion) {
            $numProyectos = fake()->numberBetween(1, 2);
            $proyectosAsignados = $proyectos->random($numProyectos);

            foreach ($proyectosAsignados as $proyecto) {
                // Verificar que no exista ya la relación
                $existe = \App\Models\InstitucionProyecto::where('institucion_id', $institucion->id)
                    ->where('proyecto_id', $proyecto->id)
                    ->exists();

                if (! $existe) {
                    $fechaInicio = fake()->dateTimeBetween('-1 year', 'now');
                    $fechaFin = fake()->optional(0.3)->dateTimeBetween($fechaInicio, '+6 months');
                    $estado = $fechaFin ? 'Finalizado' : fake()->randomElement(['Iniciado', 'En Pausa']);

                    \App\Models\InstitucionProyecto::create([
                        'institucion_id' => $institucion->id,
                        'proyecto_id' => $proyecto->id,
                        'fecha_inicio' => $fechaInicio,
                        'fecha_fin' => $fechaFin,
                        'estado' => $estado,
                    ]);
                }
            }
        }
    }
}
