<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAnuncioRequest;
use App\Http\Requests\Admin\UpdateAnuncioRequest;
use App\Models\Anuncio;
use App\Models\InstitucionProyecto;
use App\Models\Proyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Anuncio::with(['institucionProyecto.institucion', 'institucionProyecto.proyecto']);

        // Filtro por proyecto
        if ($request->filled('proyecto_id')) {
            $query->whereHas('institucionProyecto', function ($q) use ($request) {
                $q->where('proyecto_id', $request->proyecto_id);
            });
        }

        // Filtro por institución
        if ($request->filled('institucion_id')) {
            $query->whereHas('institucionProyecto', function ($q) use ($request) {
                $q->where('institucion_id', $request->institucion_id);
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $anuncios = $query->latest('fecha_inicial')->paginate(15);

        // Obtener datos para filtros
        $proyectos = Proyecto::where('estado', 'Activo')->orderBy('nombre')->get();
        $instituciones = \App\Models\Institucion::orderBy('nombre')->get();

        // Métricas para el panel estadístico
        $totalActivos = Anuncio::where('estado', 'Activo')
            ->whereDate('fecha_inicial', '<=', now())
            ->where(function ($q) {
                $q->whereNull('fecha_final')
                    ->orWhereDate('fecha_final', '>=', now());
            })
            ->count();

        $totalInactivos = Anuncio::where('estado', 'Inactivo')
            ->orWhereDate('fecha_final', '<', now())
            ->count();

        // Anuncios por proyecto
        $anunciosPorProyecto = Anuncio::join('institucion_proyecto', 'anuncios.institucion_proyecto_id', '=', 'institucion_proyecto.id')
            ->join('proyectos', 'institucion_proyecto.proyecto_id', '=', 'proyectos.id')
            ->select('proyectos.nombre', DB::raw('COUNT(anuncios.id) as total'))
            ->groupBy('proyectos.id', 'proyectos.nombre')
            ->get();

        // Gráfica de anuncios por institución
        $graficaInstituciones = Anuncio::join('institucion_proyecto', 'anuncios.institucion_proyecto_id', '=', 'institucion_proyecto.id')
            ->join('instituciones', 'institucion_proyecto.institucion_id', '=', 'instituciones.id')
            ->select('instituciones.nombre', DB::raw('COUNT(anuncios.id) as total'))
            ->groupBy('instituciones.id', 'instituciones.nombre')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->nombre,
                    'total' => (int) $item->total,
                ];
            });

        // Gráfica de distribución por estado
        $graficaEstados = [
            'Activo' => Anuncio::where('estado', 'Activo')
                ->whereDate('fecha_inicial', '<=', now())
                ->where(function ($q) {
                    $q->whereNull('fecha_final')
                        ->orWhereDate('fecha_final', '>=', now());
                })
                ->count(),
            'Inactivo' => Anuncio::where('estado', 'Inactivo')
                ->orWhereDate('fecha_final', '<', now())
                ->count(),
        ];

        return view('admin.anuncios.index', [
            'anuncios' => $anuncios,
            'proyectos' => $proyectos,
            'instituciones' => $instituciones,
            'proyectoFilter' => $request->proyecto_id,
            'institucionFilter' => $request->institucion_id,
            'estadoFilter' => $request->estado,
            'totalActivos' => $totalActivos,
            'totalInactivos' => $totalInactivos,
            'anunciosPorProyecto' => $anunciosPorProyecto,
            'graficaInstituciones' => $graficaInstituciones,
            'graficaEstados' => $graficaEstados,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Obtener todas las instituciones-proyecto con estado 'Iniciado'
        $institucionesProyectos = InstitucionProyecto::where('estado', 'Iniciado')
            ->with(['institucion', 'proyecto'])
            ->get()
            ->map(function ($ip) {
                return [
                    'id' => $ip->id,
                    'label' => $ip->institucion->nombre.' - '.$ip->proyecto->nombre,
                    'institucion' => $ip->institucion->nombre,
                    'proyecto' => $ip->proyecto->nombre,
                ];
            })
            ->sortBy('label')
            ->values();

        return view('admin.anuncios.create', [
            'institucionesProyectos' => $institucionesProyectos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnuncioRequest $request): RedirectResponse
    {
        Anuncio::create([
            'institucion_proyecto_id' => $request->institucion_proyecto_id,
            'motivo' => $request->motivo,
            'fecha' => $request->fecha,
            'hora' => $request->hora.':00', // Agregar segundos para formato time de MySQL
            'lugar' => $request->lugar,
            'estado' => $request->estado,
            'fecha_inicial' => $request->fecha_inicial,
            'fecha_final' => $request->fecha_final,
        ]);

        return redirect()->route('admin.anuncios.index')
            ->with('success', 'Anuncio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anuncio $anuncio): View
    {
        $anuncio->load(['institucionProyecto.institucion', 'institucionProyecto.proyecto']);

        return view('admin.anuncios.show', [
            'anuncio' => $anuncio,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anuncio $anuncio): View
    {
        // Obtener todas las instituciones-proyecto con estado 'Iniciado'
        $institucionesProyectos = InstitucionProyecto::where('estado', 'Iniciado')
            ->with(['institucion', 'proyecto'])
            ->get()
            ->map(function ($ip) {
                return [
                    'id' => $ip->id,
                    'label' => $ip->institucion->nombre.' - '.$ip->proyecto->nombre,
                    'institucion' => $ip->institucion->nombre,
                    'proyecto' => $ip->proyecto->nombre,
                ];
            })
            ->sortBy('label')
            ->values();

        $anuncio->load(['institucionProyecto.institucion', 'institucionProyecto.proyecto']);

        return view('admin.anuncios.edit', [
            'anuncio' => $anuncio,
            'institucionesProyectos' => $institucionesProyectos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnuncioRequest $request, Anuncio $anuncio): RedirectResponse
    {
        $anuncio->update([
            'institucion_proyecto_id' => $request->institucion_proyecto_id,
            'motivo' => $request->motivo,
            'fecha' => $request->fecha,
            'hora' => $request->hora.':00', // Agregar segundos para formato time de MySQL
            'lugar' => $request->lugar,
            'estado' => $request->estado,
            'fecha_inicial' => $request->fecha_inicial,
            'fecha_final' => $request->fecha_final,
        ]);

        return redirect()->route('admin.anuncios.index')
            ->with('success', 'Anuncio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anuncio $anuncio): RedirectResponse
    {
        $anuncio->delete();

        return redirect()->route('admin.anuncios.index')
            ->with('success', 'Anuncio eliminado exitosamente.');
    }
}
