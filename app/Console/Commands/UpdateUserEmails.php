<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:normalize-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Normaliza los emails de los usuarios eliminando acentos y caracteres especiales';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Normalizando emails de usuarios...');

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

        $users = User::all();
        $updated = 0;

        foreach ($users as $user) {
            $nombreCompleto = $user->name;
            $emailBase = $normalizeEmail($nombreCompleto);
            $dominio = strpos($user->email, 'sediecotech.com') !== false ? 'sediecotech.com' : 'participante.com';
            $nuevoEmail = $emailBase.'@'.$dominio;

            if ($user->email !== $nuevoEmail) {
                $this->line("Actualizando: {$user->email} -> {$nuevoEmail}");
                $user->email = $nuevoEmail;
                $user->save();
                $updated++;
            }
        }

        $this->info("✓ Se actualizaron {$updated} emails correctamente.");

        return Command::SUCCESS;
    }
}
