<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RespuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lugares = [
            'Patio principal de la institución',
            'Aula de reuniones',
            'Sala de actos',
            'Oficina de administración',
            'Entrada principal',
            'Cancha deportiva',
            'Biblioteca',
        ];

        // Crear 10 respuestas de programación de entregas
        for ($i = 0; $i < 10; $i++) {
            $fechaProgramada = fake()->dateTimeBetween('now', '+2 months');
            $hora = fake()->time('H:i:s');

            \App\Models\Respuesta::create([
                'lugar' => fake()->randomElement($lugares),
                'fecha_programada' => $fechaProgramada->format('Y-m-d'),
                'hora' => $hora,
            ]);
        }
    }
}
