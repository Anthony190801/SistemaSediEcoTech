<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personas = \App\Models\Persona::all();
        $institucionProyectos = \App\Models\InstitucionProyecto::all();
        $nivelesAcademicos = ['Inicial', 'Primaria', 'Secundaria', 'Universitario'];
        $aulas = ['A', 'B', 'C', 'D', 'E'];

        // Crear entre 40 y 60 participantes, pero no más de las personas disponibles
        $numParticipantes = min(fake()->numberBetween(40, 60), $personas->count());
        $personasUsadas = [];

        for ($i = 0; $i < $numParticipantes; $i++) {
            $personasDisponibles = $personas->whereNotIn('id', $personasUsadas);

            // Si no hay personas disponibles, reiniciar la lista
            if ($personasDisponibles->isEmpty()) {
                $personasUsadas = [];
                $personasDisponibles = $personas;
            }

            $persona = $personasDisponibles->random();
            $personasUsadas[] = $persona->id;

            $institucionProyecto = $institucionProyectos->random();
            $nivelAcademico = fake()->randomElement($nivelesAcademicos);
            $cicloOGrado = $nivelAcademico === 'Universitario' ? fake()->numberBetween(1, 10) : fake()->numberBetween(1, 6);
            $aula = fake()->randomElement($aulas);
            $anio = fake()->numberBetween(2023, 2025);
            $puntajeTotal = fake()->numberBetween(0, 500);

            \App\Models\Participante::create([
                'institucion_proyecto_id' => $institucionProyecto->id,
                'persona_id' => $persona->id,
                'uuid' => \Illuminate\Support\Str::uuid()->toString(),
                'anio' => $anio,
                'nivel_academico' => $nivelAcademico,
                'ciclo_o_grado' => $cicloOGrado,
                'aula' => $aula,
                'puntaje_total' => $puntajeTotal,
            ]);
        }
    }
}
