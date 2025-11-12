<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Canje;
use App\Models\Participante;
use App\Models\Premio;
use App\Models\Recoleccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Get the current participant for the authenticated user.
     */
    private function getParticipante(): Participante
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();

        $participante = Participante::with([
            'persona',
            'institucionProyecto.institucion',
            'institucionProyecto.proyecto',
        ])
            ->where('persona_id', $user->persona_id)
            ->latest()
            ->first();

        if (! $participante) {
            abort(404, 'No se encontró información de participante para tu cuenta.');
        }

        return $participante;
    }

    /**
     * Display the participant dashboard.
     */
    public function index(): View
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();
        $participante = $this->getParticipante();

        // Obtener recolecciones con materiales para gráfico
        $recolecciones = Recoleccion::with(['materialPrecio.material'])
            ->where('participante_id', $participante->id)
            ->where('estado', 'Validado')
            ->get();

        // Calcular total de materiales reciclados (kg)
        $totalKg = $recolecciones->sum('cantidad_kilogramos');

        // Agrupar por material para el gráfico circular
        $materialesData = $recolecciones->groupBy(function ($recoleccion) {
            return $recoleccion->materialPrecio->material->nombre ?? 'Desconocido';
        })->map(function ($group) {
            return $group->sum('cantidad_kilogramos');
        })->sortDesc();

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

        return view('participant.dashboard.index', [
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
            'totalKg' => $totalKg,
            'materialesData' => $materialesData,
        ]);
    }

    /**
     * Display the ranking page.
     */
    public function ranking(Request $request): View
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();
        $participante = $this->getParticipante();

        // Obtener todos los proyectos donde ha participado
        $proyectosParticipados = Participante::with('institucionProyecto.proyecto')
            ->where('persona_id', $user->persona_id)
            ->get()
            ->pluck('institucionProyecto.proyecto')
            ->unique('id')
            ->values();

        // Filtrar por proyecto si se especifica
        $proyectoId = $request->get('proyecto_id', $participante->institucionProyecto->proyecto_id);

        // Obtener ranking del proyecto seleccionado
        $ranking = Participante::with(['persona', 'institucionProyecto.institucion', 'institucionProyecto.proyecto'])
            ->whereHas('institucionProyecto', function ($q) use ($proyectoId) {
                $q->where('proyecto_id', $proyectoId);
            })
            ->where('institucion_proyecto_id', $participante->institucion_proyecto_id)
            ->orderByDesc('puntaje_total')
            ->get();

        // Calcular posición del usuario
        $posicion = $ranking->search(function ($p) use ($user) {
            return $p->persona_id === $user->persona_id;
        }) + 1;

        return view('participant.ranking', [
            'participante' => $participante,
            'user' => $user,
            'ranking' => $ranking,
            'posicion' => $posicion,
            'proyectosParticipados' => $proyectosParticipados,
            'proyectoSeleccionado' => $proyectoId,
        ]);
    }

    /**
     * Display the prizes page.
     */
    public function premios(): View
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();
        $participante = $this->getParticipante();

        // Obtener premios por ranking
        $premiosRanking = Premio::with('articulo')
            ->where('institucion_proyecto_id', $participante->institucion_proyecto_id)
            ->where('tipo', 'Canje por Ranking')
            ->where('estado', 'Disponible')
            ->orderBy('posicion_requerida')
            ->get();

        // Obtener premios por puntaje ordenados
        $premiosPuntaje = Premio::with('articulo')
            ->where('institucion_proyecto_id', $participante->institucion_proyecto_id)
            ->where('tipo', 'Canje por puntaje')
            ->where('estado', 'Disponible')
            ->orderBy('puntaje_requerido')
            ->get();

        // Calcular el siguiente premio
        $siguientePremio = $premiosPuntaje->first(function ($premio) use ($participante) {
            return $premio->puntaje_requerido > $participante->puntaje_total;
        });

        $faltanPuntos = $siguientePremio
            ? $siguientePremio->puntaje_requerido - $participante->puntaje_total
            : 0;

        // Marcar premios alcanzados
        $premiosPuntaje = $premiosPuntaje->map(function ($premio) use ($participante, $siguientePremio) {
            $premio->alcanzado = $participante->puntaje_total >= $premio->puntaje_requerido;
            $premio->esSiguiente = $siguientePremio && $premio->id === $siguientePremio->id;
            $premio->faltanPuntos = max(0, $premio->puntaje_requerido - $participante->puntaje_total);

            return $premio;
        });

        return view('participant.premios', [
            'participante' => $participante,
            'user' => $user,
            'premiosRanking' => $premiosRanking,
            'premiosPuntaje' => $premiosPuntaje,
            'siguientePremio' => $siguientePremio,
            'faltanPuntos' => $faltanPuntos,
        ]);
    }

    /**
     * Display the exchange history page.
     */
    public function canjes(Request $request): View
    {
        $user = Auth::guard('participant')->user() ?? Auth::user();
        $participante = $this->getParticipante();

        $query = Canje::with([
            'premio.articulo',
            'premio.institucionProyecto.institucion',
            'premio.institucionProyecto.proyecto',
            'respuesta',
        ])
            ->where('participante_id', $participante->id);

        // Filtro por nombre del premio
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('premio.articulo', function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%");
            });
        }

        // Ordenamiento
        $orden = $request->get('orden', 'desc'); // 'asc' o 'desc'
        $query->orderBy('fecha_solicitud_canje', $orden);

        $canjes = $query->paginate(15);

        return view('participant.canjes', [
            'participante' => $participante,
            'user' => $user,
            'canjes' => $canjes,
            'search' => $request->search,
            'orden' => $orden,
        ]);
    }
}
