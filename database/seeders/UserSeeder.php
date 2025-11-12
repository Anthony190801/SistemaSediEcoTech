<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personas = \App\Models\Persona::all();
        $personasUsadas = [];

        // Función para normalizar emails (eliminar acentos y caracteres especiales)
        $normalizeEmail = function ($text) {
            $text = mb_strtolower($text, 'UTF-8');
            // Reemplazar caracteres especiales
            $replacements = [
                'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
                'ñ' => 'n', 'ü' => 'u',
                'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
                'Ñ' => 'n', 'Ü' => 'u',
            ];
            $text = strtr($text, $replacements);
            // Eliminar cualquier otro carácter especial y espacios múltiples
            $text = preg_replace('/[^a-z0-9\s]/', '', $text);
            $text = preg_replace('/\s+/', '.', trim($text));

            return $text;
        };

        // Crear 3 administradores
        for ($i = 0; $i < 3; $i++) {
            $persona = $personas->whereNotIn('id', $personasUsadas)->random();
            $personasUsadas[] = $persona->id;
            $nombreCompleto = $persona->nombres.' '.$persona->apellidos;
            $emailBase = $normalizeEmail($nombreCompleto);
            $email = $emailBase.'@sediecotech.com';

            \App\Models\User::firstOrCreate(
                ['email' => $email],
                [
                    'persona_id' => $persona->id,
                    'name' => $nombreCompleto,
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'profile_picture' => null,
                    'status_user' => 'Activo',
                    'rol' => 'Administrador',
                ]
            );
        }

        // Crear 20 usuarios participantes
        for ($i = 0; $i < 20; $i++) {
            $persona = $personas->whereNotIn('id', $personasUsadas)->random();
            $personasUsadas[] = $persona->id;
            $nombreCompleto = $persona->nombres.' '.$persona->apellidos;
            $emailBase = $normalizeEmail($nombreCompleto);
            $email = $emailBase.'@participante.com';

            \App\Models\User::firstOrCreate(
                ['email' => $email],
                [
                    'persona_id' => $persona->id,
                    'name' => $nombreCompleto,
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'profile_picture' => null,
                    'status_user' => 'Activo',
                    'rol' => 'Usuario',
                ]
            );
        }
    }
}
