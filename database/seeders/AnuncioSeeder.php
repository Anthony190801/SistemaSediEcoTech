<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AnuncioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institucionProyectos = \App\Models\InstitucionProyecto::all();
        $motivos = [
            'Jornada de reciclaje masivo',
            'Evento de concientización ambiental',
            'Campaña de recolección de materiales',
            'Taller sobre sostenibilidad',
            'Celebración del Día del Medio Ambiente',
            'Concurso de reciclaje creativo',
            'Charla sobre impacto ambiental',
        ];
        $lugares = [
            'Patio principal',
            'Aula magna',
            'Sala de conferencias',
            'Cancha deportiva',
            'Auditorio',
        ];

        // Crear 5 anuncios
        for ($i = 0; $i < 5; $i++) {
            $institucionProyecto = $institucionProyectos->random();
            $fecha = fake()->dateTimeBetween('+1 day', '+3 months');
            $hora = fake()->time('H:i:s');
            
            // Asegurar que fecha_inicial sea anterior a fecha (al menos 1 día antes)
            $fechaInicial = fake()->dateTimeBetween('-1 week', (clone $fecha)->modify('-1 day'));
            
            // Asegurar que fecha_final sea posterior a fecha (puede ser null)
            $fechaFinal = fake()->optional(0.7)->dateTimeBetween((clone $fecha)->modify('+1 day'), (clone $fecha)->modify('+1 week'));

            \App\Models\Anuncio::create([
                'institucion_proyecto_id' => $institucionProyecto->id,
                'motivo' => fake()->randomElement($motivos),
                'fecha' => $fecha->format('Y-m-d'),
                'hora' => $hora,
                'lugar' => fake()->randomElement($lugares),
                'estado' => fake()->randomElement(['Activo', 'Inactivo']),
                'fecha_inicial' => $fechaInicial->format('Y-m-d'),
                'fecha_final' => $fechaFinal ? $fechaFinal->format('Y-m-d') : null,
            ]);
        }
    }
}
