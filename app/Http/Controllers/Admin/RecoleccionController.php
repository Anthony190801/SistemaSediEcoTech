<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRecoleccionRequest;
use App\Models\Institucion;
use App\Models\MaterialPrecio;
use App\Models\Participante;
use App\Models\Proyecto;
use App\Models\Recoleccion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RecoleccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Recoleccion::with([
            'participante.persona',
            'participante.institucionProyecto.institucion',
            'participante.institucionProyecto.proyecto',
            'materialPrecio.material',
            'materialPrecio.precio',
        ]);

        // Filtros
        if ($request->filled('proyecto_id')) {
            $query->whereHas('participante.institucionProyecto', function ($q) use ($request) {
                $q->where('proyecto_id', $request->proyecto_id);
            });
        }

        if ($request->filled('institucion_id')) {
            $query->whereHas('participante.institucionProyecto', function ($q) use ($request) {
                $q->where('institucion_id', $request->institucion_id);
            });
        }

        if ($request->filled('participante_search')) {
            $search = $request->participante_search;
            $query->whereHas('participante.persona', function ($q) use ($search) {
                $q->where('dni', 'like', "%{$search}%")
                    ->orWhere('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%");
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha', '<=', $request->fecha_fin);
        }

        $recolecciones = $query->latest('fecha')->paginate(15);

        $proyectos = Proyecto::orderBy('nombre')->get();
        $instituciones = Institucion::orderBy('nombre')->get();

        return view('admin.recolecciones.index', [
            'recolecciones' => $recolecciones,
            'proyectos' => $proyectos,
            'instituciones' => $instituciones,
            'proyectoFilter' => $request->proyecto_id,
            'institucionFilter' => $request->institucion_id,
            'participanteSearch' => $request->participante_search,
            'estadoFilter' => $request->estado,
            'fechaInicioFilter' => $request->fecha_inicio,
            'fechaFinFilter' => $request->fecha_fin,
        ]);
    }

    /**
     * Show the form for creating a new resource (Paso 1: Seleccionar Proyecto).
     */
    public function create(Request $request): View
    {
        $proyectos = Proyecto::where('estado', 'Activo')->orderBy('nombre')->get();
        $search = $request->get('search', '');

        // Si hay búsqueda, filtrar proyectos
        if ($search) {
            $proyectos = $proyectos->filter(function ($proyecto) use ($search) {
                return stripos($proyecto->nombre, $search) !== false;
            });
        }

        return view('admin.recolecciones.paso1-proyecto', [
            'proyectos' => $proyectos,
            'search' => $search,
        ]);
    }

    /**
     * Paso 2: Seleccionar Institución (vinculada al proyecto con estado 'Iniciado').
     */
    public function paso2Institucion(Request $request): View
    {
        $request->validate([
            'proyecto_id' => ['required', 'exists:proyectos,id'],
        ]);

        $proyecto = Proyecto::findOrFail($request->proyecto_id);

        // Obtener instituciones vinculadas al proyecto con estado 'Iniciado'
        $instituciones = \App\Models\InstitucionProyecto::where('proyecto_id', $proyecto->id)
            ->where('estado', 'Iniciado')
            ->with('institucion')
            ->get()
            ->map(function ($ip) {
                return $ip->institucion;
            })
            ->unique('id')
            ->sortBy('nombre')
            ->values();

        $search = $request->get('search', '');

        // Si hay búsqueda, filtrar instituciones
        if ($search) {
            $instituciones = $instituciones->filter(function ($institucion) use ($search) {
                return stripos($institucion->nombre, $search) !== false;
            });
        }

        return view('admin.recolecciones.paso2-institucion', [
            'proyecto' => $proyecto,
            'instituciones' => $instituciones,
            'search' => $search,
        ]);
    }

    /**
     * Paso 3: Listar Participantes (de la institución-proyecto seleccionada).
     */
    public function paso3Participantes(Request $request): View
    {
        $request->validate([
            'proyecto_id' => ['required', 'exists:proyectos,id'],
            'institucion_id' => ['required', 'exists:instituciones,id'],
        ]);

        $proyecto = Proyecto::findOrFail($request->proyecto_id);
        $institucion = Institucion::findOrFail($request->institucion_id);

        // Obtener el institucion_proyecto con estado 'Iniciado'
        $institucionProyecto = \App\Models\InstitucionProyecto::where('proyecto_id', $proyecto->id)
            ->where('institucion_id', $institucion->id)
            ->where('estado', 'Iniciado')
            ->firstOrFail();

        // Obtener participantes de esta institución-proyecto
        $query = Participante::where('institucion_proyecto_id', $institucionProyecto->id)
            ->with(['persona', 'institucionProyecto.institucion', 'institucionProyecto.proyecto']);

        // Búsqueda por DNI, nombres o apellidos
        $search = $request->get('search', '');
        if ($search) {
            $query->whereHas('persona', function ($q) use ($search) {
                $q->where('dni', 'like', "%{$search}%")
                    ->orWhere('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%");
            });
        }

        $participantes = $query->orderBy('puntaje_total', 'desc')
            ->paginate(15);

        return view('admin.recolecciones.paso3-participantes', [
            'proyecto' => $proyecto,
            'institucion' => $institucion,
            'institucionProyecto' => $institucionProyecto,
            'participantes' => $participantes,
            'search' => $search,
        ]);
    }

    /**
     * Paso 4: Registrar Recolección (para el participante seleccionado).
     */
    public function paso4Registrar(Request $request): View
    {
        $request->validate([
            'proyecto_id' => ['required', 'exists:proyectos,id'],
            'institucion_id' => ['required', 'exists:instituciones,id'],
            'participante_id' => ['required', 'exists:participantes,id'],
        ]);

        $proyecto = Proyecto::findOrFail($request->proyecto_id);
        $institucion = Institucion::findOrFail($request->institucion_id);
        $participante = Participante::with(['persona', 'institucionProyecto.institucion', 'institucionProyecto.proyecto'])
            ->findOrFail($request->participante_id);

        // Verificar que el participante pertenece a la institución-proyecto correcta
        if ($participante->institucionProyecto->proyecto_id != $request->proyecto_id ||
            $participante->institucionProyecto->institucion_id != $request->institucion_id) {
            return redirect()->route('admin.recolecciones.paso3-participantes', [
                'proyecto_id' => $request->proyecto_id,
                'institucion_id' => $request->institucion_id,
            ])->with('error', 'El participante no pertenece a la institución y proyecto seleccionados.');
        }

        // Obtener materiales disponibles para este proyecto
        // Agrupar por material_id para asegurar que solo haya un precio por material
        $materialesDisponibles = MaterialPrecio::whereHas('proyectos', function ($q) use ($proyecto) {
            $q->where('proyectos.id', $proyecto->id);
        })
            ->where('fecha_inicio', '<=', now())
            ->where(function ($q) {
                $q->whereNull('fecha_fin')
                    ->orWhere('fecha_fin', '>=', now());
            })
            ->with(['material', 'precio'])
            ->get()
            ->groupBy('material_id')
            ->map(function ($group) {
                // Si hay múltiples precios activos para el mismo material (no debería pasar),
                // tomar el más reciente por fecha_inicio
                return $group->sortByDesc('fecha_inicio')->first();
            })
            ->values();

        return view('admin.recolecciones.paso4-registrar', [
            'proyecto' => $proyecto,
            'institucion' => $institucion,
            'participante' => $participante,
            'materialesDisponibles' => $materialesDisponibles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecoleccionRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            // Obtener el material_precio para calcular el puntaje
            $materialPrecio = MaterialPrecio::with('precio')->findOrFail($request->material_precio_id);
            $puntajeObtenido = $request->cantidad_kilogramos * $materialPrecio->puntaje;

            // Crear la recolección
            $recoleccion = Recoleccion::create([
                'participante_id' => $request->participante_id,
                'material_precio_id' => $request->material_precio_id,
                'cantidad_kilogramos' => $request->cantidad_kilogramos,
                'fecha' => $request->fecha,
                'estado' => $request->estado,
            ]);

            // Si el estado es "Validado", actualizar el puntaje del participante
            if ($request->estado === 'Validado') {
                $participante = Participante::findOrFail($request->participante_id);
                $participante->puntaje_total += $puntajeObtenido;
                $participante->save();
            }
        });

        // Redirigir según el origen (si viene de wizard o no)
        if ($request->filled('proyecto_id') && $request->filled('institucion_id')) {
            return redirect()->route('admin.recolecciones.paso3-participantes', [
                'proyecto_id' => $request->proyecto_id,
                'institucion_id' => $request->institucion_id,
            ])->with('success', 'Recolección registrada exitosamente. Puedes registrar otra recolección para este participante o seleccionar otro participante.');
        }

        return redirect()->route('admin.recolecciones.index')
            ->with('success', 'Recolección registrada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recoleccion $recoleccion): RedirectResponse
    {
        try {
            DB::transaction(function () use ($recoleccion) {

                // Si la recolección estaba validada, restar el puntaje del participante
                if ($recoleccion->estado === 'Validado') {
                    $materialPrecio = $recoleccion->materialPrecio;
                    $puntajeARestar = $recoleccion->cantidad_kilogramos * $materialPrecio->puntaje;

                    $participante = $recoleccion->participante;
                    $participante->puntaje_total = max(0, $participante->puntaje_total - $puntajeARestar);
                    $participante->save();
                }

                // Eliminar la recolección
                $recoleccion->delete();
            });

            return redirect()->route('admin.recolecciones.index')
                ->with('success', 'Recolección eliminada exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la recolección: '.$e->getMessage());
        }
    }
}
