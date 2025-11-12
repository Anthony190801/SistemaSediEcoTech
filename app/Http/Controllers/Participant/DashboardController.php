<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Participante;
use App\Models\Premio;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the participant dashboard.
     */
    public function index(): View
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();

        // Obtener el participante actual con todas sus relaciones
        $participante = Participante::with([
            'persona',
            'institucionProyecto.institucion',
            'institucionProyecto.proyecto',
        ])
            ->where('persona_id', $user->persona_id)
            ->latest()
            ->first();

        // Si no hay participante, redirigir con error
        if (! $participante) {
            abort(404, 'No se encontró información de participante para tu cuenta.');
        }

        // Obtener ranking institucional
        $ranking = Participante::where('institucion_proyecto_id', $participante->institucion_proyecto_id)
            ->with('persona')
            ->orderByDesc('puntaje_total')
            ->get();

        // Calcular posición del usuario en el ranking
        $posicion = $ranking->search(function ($p) use ($user) {
            return $p->persona_id === $user->persona_id;
        }) + 1;

        $totalParticipantes = $ranking->count();

        // Obtener premios por ranking
        $premiosRanking = Premio::with('articulo')
            ->where('institucion_proyecto_id', $participante->institucion_proyecto_id)
            ->where('tipo', 'Canje por Ranking')
            ->where('estado', 'Disponible')
            ->get();

        // Obtener premios por puntaje ordenados (nota: el tipo en BD es "Canje por puntaje" con minúscula)
        $premiosPuntaje = Premio::with('articulo')
            ->where('institucion_proyecto_id', $participante->institucion_proyecto_id)
            ->where('tipo', 'Canje por puntaje')
            ->where('estado', 'Disponible')
            ->orderBy('puntaje_requerido')
            ->get();

        // Calcular el siguiente premio y puntos faltantes
        $siguientePremio = $premiosPuntaje->first(function ($premio) use ($participante) {
            return $premio->puntaje_requerido > $participante->puntaje_total;
        });

        $faltanPuntos = $siguientePremio
            ? $siguientePremio->puntaje_requerido - $participante->puntaje_total
            : 0;

        // Calcular progreso hacia el siguiente premio (porcentaje)
        $progresoPorcentaje = 0;
        if ($siguientePremio && $siguientePremio->puntaje_requerido > 0) {
            $progresoPorcentaje = min(
                100,
                ($participante->puntaje_total / $siguientePremio->puntaje_requerido) * 100
            );
        }

        // Marcar premios alcanzados en la línea de tiempo
        $premiosPuntaje = $premiosPuntaje->map(function ($premio) use ($participante, $siguientePremio) {
            $premio->alcanzado = $participante->puntaje_total >= $premio->puntaje_requerido;
            $premio->esSiguiente = $siguientePremio && $premio->id === $siguientePremio->id;

            return $premio;
        });

        return view('participant.dashboard', [
            'participante' => $participante,
            'user' => $user,
            'ranking' => $ranking,
            'posicion' => $posicion,
            'totalParticipantes' => $totalParticipantes,
            'premiosRanking' => $premiosRanking,
            'premiosPuntaje' => $premiosPuntaje,
            'siguientePremio' => $siguientePremio,
            'faltanPuntos' => $faltanPuntos,
            'progresoPorcentaje' => $progresoPorcentaje,
        ]);
    }
}
