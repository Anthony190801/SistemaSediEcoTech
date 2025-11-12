<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Anuncio;
use App\Models\Participante;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AnuncioController extends Controller
{
    /**
     * Display a listing of active announcements for the participant.
     */
    public function index(): View
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();

        // Obtener el participante actual
        $participante = Participante::with(['institucionProyecto.institucion', 'institucionProyecto.proyecto'])
            ->where('persona_id', $user->persona_id)
            ->latest()
            ->first();

        // Si no hay participante, redirigir con error
        if (! $participante) {
            abort(404, 'No se encontró información de participante para tu cuenta.');
        }

        // Obtener anuncios activos para la institución-proyecto del participante
        $anuncios = Anuncio::with(['institucionProyecto.institucion', 'institucionProyecto.proyecto'])
            ->where('institucion_proyecto_id', $participante->institucion_proyecto_id)
            ->where('estado', 'Activo')
            ->whereDate('fecha_inicial', '<=', now())
            ->where(function ($q) {
                $q->whereNull('fecha_final')
                    ->orWhereDate('fecha_final', '>=', now());
            })
            ->orderByDesc('fecha_inicial')
            ->get();

        return view('participant.anuncios.index', [
            'participante' => $participante,
            'anuncios' => $anuncios,
        ]);
    }
}
