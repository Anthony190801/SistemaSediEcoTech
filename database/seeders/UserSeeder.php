<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        // Obtener todas las personas disponibles (que no tengan usuarios asociados)
        $personasDisponibles = \App\Models\Persona::whereDoesntHave('users')->get();

        // Si no hay suficientes personas disponibles, crear nuevas
        $personasNecesarias = 23; // 3 administradores + 20 participantes
        if ($personasDisponibles->count() < $personasNecesarias) {
            $personasFaltantes = $personasNecesarias - $personasDisponibles->count();
            $nuevasPersonas = \App\Models\Persona::factory($personasFaltantes)->create();
            $personasDisponibles = $personasDisponibles->merge($nuevasPersonas);
        }

        // Crear 3 administradores
        for ($i = 0; $i < 3; $i++) {
            if ($personasDisponibles->isEmpty()) {
                // Si no hay más personas disponibles, crear una nueva
                $persona = \App\Models\Persona::factory()->create();
            } else {
                $persona = $personasDisponibles->random();
                $personasDisponibles = $personasDisponibles->reject(function ($p) use ($persona) {
                    return $p->id === $persona->id;
                });
            }

            $nombreCompleto = $persona->nombres.' '.$persona->apellidos;
            $emailBase = $normalizeEmail($nombreCompleto);
            $email = $emailBase.'@sediecotech.com';

            // Si el email ya existe, agregar un número
            $emailFinal = $email;
            $contador = 1;
            while (\App\Models\User::where('email', $emailFinal)->exists()) {
                $emailFinal = $emailBase.$contador.'@sediecotech.com';
                $contador++;
            }

            \App\Models\User::firstOrCreate(
                ['email' => $emailFinal],
                [
                    'persona_id' => $persona->id,
                    'name' => $nombreCompleto,
                    'password' => Hash::make('password'),
                    'profile_picture' => null,
                    'status_user' => 'Activo',
                    'rol' => 'Administrador',
                ]
            );
        }

        // Crear 20 usuarios participantes
        for ($i = 0; $i < 20; $i++) {
            if ($personasDisponibles->isEmpty()) {
                // Si no hay más personas disponibles, crear una nueva
                $persona = \App\Models\Persona::factory()->create();
            } else {
                $persona = $personasDisponibles->random();
                $personasDisponibles = $personasDisponibles->reject(function ($p) use ($persona) {
                    return $p->id === $persona->id;
                });
            }

            $nombreCompleto = $persona->nombres.' '.$persona->apellidos;
            $emailBase = $normalizeEmail($nombreCompleto);
            $email = $emailBase.'@participante.com';

            // Si el email ya existe, agregar un número
            $emailFinal = $email;
            $contador = 1;
            while (\App\Models\User::where('email', $emailFinal)->exists()) {
                $emailFinal = $emailBase.$contador.'@participante.com';
                $contador++;
            }

            \App\Models\User::firstOrCreate(
                ['email' => $emailFinal],
                [
                    'persona_id' => $persona->id,
                    'name' => $nombreCompleto,
                    'password' => Hash::make('password'),
                    'profile_picture' => null,
                    'status_user' => 'Activo',
                    'rol' => 'Usuario',
                ]
            );
        }

        // Verificación final: asegurar que no haya usuarios huérfanos
        $usuariosHuerfanos = \App\Models\User::whereNull('persona_id')
            ->orWhereDoesntHave('persona')
            ->get();

        if ($usuariosHuerfanos->isNotEmpty()) {
            foreach ($usuariosHuerfanos as $usuario) {
                // Crear una persona para el usuario huérfano
                $persona = \App\Models\Persona::factory()->create([
                    'nombres' => explode(' ', $usuario->name)[0] ?? 'Usuario',
                    'apellidos' => implode(' ', array_slice(explode(' ', $usuario->name), 1)) ?: 'Sin Apellido',
                ]);

                $usuario->update(['persona_id' => $persona->id]);
            }
        }

        // Verificación adicional: asegurar que cada usuario tenga una persona válida
        $usuariosSinPersona = \App\Models\User::whereNull('persona_id')->count();
        if ($usuariosSinPersona > 0) {
            $this->command->warn("⚠️  Se encontraron {$usuariosSinPersona} usuarios sin persona asociada. Se han corregido automáticamente.");
        }

        $totalUsuarios = \App\Models\User::count();
        $totalPersonas = \App\Models\Persona::count();
        $usuariosConPersona = \App\Models\User::whereNotNull('persona_id')->count();

        $this->command->info("✅ Usuarios creados: {$totalUsuarios}");
        $this->command->info("✅ Personas disponibles: {$totalPersonas}");
        $this->command->info("✅ Usuarios con persona asociada: {$usuariosConPersona}/{$totalUsuarios}");
    }
}
