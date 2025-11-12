<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProyectoRequest;
use App\Http\Requests\Admin\UpdateProyectoRequest;
use App\Models\Institucion;
use App\Models\InstitucionProyecto;
use App\Models\Proyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Proyecto::withCount('institucionProyectos')
            ->with(['institucionProyectos' => function ($q) {
                $q->orderBy('fecha_inicio', 'asc');
            }]);

        // Búsqueda por nombre
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%'.$request->search.'%');
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $proyectos = $query->latest()->paginate(10);

        // Calcular fechas para cada proyecto
        $proyectos->getCollection()->transform(function ($proyecto) {
            $fechas = $proyecto->institucionProyectos;
            $proyecto->fecha_inicio_min = $fechas->min('fecha_inicio');
            $proyecto->fecha_fin_max = $fechas->whereNotNull('fecha_fin')->max('fecha_fin');

            return $proyecto;
        });

        return view('admin.proyectos.index', [
            'proyectos' => $proyectos,
            'search' => $request->search,
            'estado' => $request->estado,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $instituciones = Institucion::orderBy('nombre')->get();

        return view('admin.proyectos.create', [
            'instituciones' => $instituciones,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProyectoRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Guardar logo si se proporcionó
            $urlLogo = null;
            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->store('proyectos', 'public');
                $urlLogo = $path;
            }

            // Crear proyecto
            $proyecto = Proyecto::create([
                'nombre' => $request->nombre,
                'url_logo' => $urlLogo,
                'estado' => $request->estado ?? 'Activo',
            ]);

            // Asociar instituciones
            if ($request->filled('instituciones')) {
                foreach ($request->instituciones as $institucionData) {
                    InstitucionProyecto::create([
                        'proyecto_id' => $proyecto->id,
                        'institucion_id' => $institucionData['id'],
                        'fecha_inicio' => $institucionData['fecha_inicio'],
                        'fecha_fin' => $institucionData['fecha_fin'] ?? null,
                        'estado' => $institucionData['estado'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.proyectos.index')
                ->with('success', 'Proyecto creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Error al crear el proyecto: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Proyecto $proyecto): View
    {
        $proyecto->load([
            'institucionProyectos.institucion',
            'institucionProyectos.participantes',
        ]);

        // Obtener todas las instituciones para el select
        $todasInstituciones = Institucion::orderBy('nombre')->get();

        // Obtener instituciones ya asociadas al proyecto
        $institucionesAsociadas = $proyecto->institucionProyectos->pluck('institucion_id')->toArray();

        // Filtrar instituciones disponibles (no asociadas)
        $institucionesDisponibles = $todasInstituciones->reject(function ($institucion) use ($institucionesAsociadas) {
            return in_array($institucion->id, $institucionesAsociadas);
        });

        // Filtros para el listado de instituciones
        $queryInstituciones = $proyecto->institucionProyectos()->with(['institucion', 'participantes']);

        if ($request->filled('search_institucion')) {
            $queryInstituciones->whereHas('institucion', function ($q) use ($request) {
                $q->where('nombre', 'like', '%'.$request->search_institucion.'%');
            });
        }

        if ($request->filled('estado_vinculo')) {
            $queryInstituciones->where('estado', $request->estado_vinculo);
        }

        $institucionesProyecto = $queryInstituciones->orderBy('fecha_inicio', 'desc')->get();

        // Métricas del proyecto
        $totalInstituciones = $proyecto->institucionProyectos->count();
        $totalParticipantes = $proyecto->institucionProyectos->sum(function ($ip) {
            return $ip->participantes->count();
        });

        // Total de recolecciones del proyecto (a través de participantes)
        $totalRecolecciones = \App\Models\Recoleccion::whereHas('participante.institucionProyecto', function ($q) use ($proyecto) {
            $q->where('proyecto_id', $proyecto->id);
        })->count();

        return view('admin.proyectos.show', [
            'proyecto' => $proyecto,
            'institucionesDisponibles' => $institucionesDisponibles,
            'institucionesProyecto' => $institucionesProyecto,
            'searchInstitucion' => $request->search_institucion,
            'estadoVinculoFilter' => $request->estado_vinculo,
            'totalInstituciones' => $totalInstituciones,
            'totalParticipantes' => $totalParticipantes,
            'totalRecolecciones' => $totalRecolecciones,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto): View
    {
        $instituciones = Institucion::orderBy('nombre')->get();
        $proyecto->load('institucionProyectos.institucion');

        // Preparar datos de instituciones existentes para JavaScript
        $institucionesExistentes = $proyecto->institucionProyectos->map(function ($ip) {
            return [
                'id' => $ip->institucion_id,
                'estado' => $ip->estado,
                'fecha_inicio' => $ip->fecha_inicio ? $ip->fecha_inicio->format('Y-m-d') : '',
                'fecha_fin' => $ip->fecha_fin ? $ip->fecha_fin->format('Y-m-d') : '',
            ];
        })->values();

        return view('admin.proyectos.edit', [
            'proyecto' => $proyecto,
            'instituciones' => $instituciones,
            'institucionesExistentes' => $institucionesExistentes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoRequest $request, Proyecto $proyecto): RedirectResponse
    {
        DB::beginTransaction();

        try {
            // Actualizar logo si se proporcionó uno nuevo
            $urlLogo = $proyecto->url_logo;
            if ($request->hasFile('logo')) {
                // Eliminar logo anterior si existe
                if ($proyecto->url_logo && Storage::disk('public')->exists($proyecto->url_logo)) {
                    Storage::disk('public')->delete($proyecto->url_logo);
                }
                $path = $request->file('logo')->store('proyectos', 'public');
                $urlLogo = $path;
            }

            // Actualizar proyecto
            $proyecto->update([
                'nombre' => $request->nombre,
                'url_logo' => $urlLogo,
                'estado' => $request->estado,
            ]);

            // Sincronizar instituciones
            if ($request->filled('instituciones')) {
                // Eliminar relaciones existentes
                $proyecto->institucionProyectos()->delete();

                // Crear nuevas relaciones
                foreach ($request->instituciones as $institucionData) {
                    InstitucionProyecto::create([
                        'proyecto_id' => $proyecto->id,
                        'institucion_id' => $institucionData['id'],
                        'fecha_inicio' => $institucionData['fecha_inicio'],
                        'fecha_fin' => $institucionData['fecha_fin'] ?? null,
                        'estado' => $institucionData['estado'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.proyectos.index')
                ->with('success', 'Proyecto actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Error al actualizar el proyecto: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto): RedirectResponse
    {
        try {
            // Eliminar logo si existe
            if ($proyecto->url_logo && Storage::disk('public')->exists($proyecto->url_logo)) {
                Storage::disk('public')->delete($proyecto->url_logo);
            }

            // Eliminar proyecto (las relaciones se eliminan por cascada)
            $proyecto->delete();

            return redirect()->route('admin.proyectos.index')
                ->with('success', 'Proyecto eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el proyecto: '.$e->getMessage());
        }
    }

    /**
     * Toggle project status (Activo/Inactivo).
     */
    public function toggleStatus(Request $request, Proyecto $proyecto): \Illuminate\Http\JsonResponse
    {
        $nuevoEstado = $proyecto->estado === 'Activo' ? 'Inactivo' : 'Activo';
        $proyecto->update(['estado' => $nuevoEstado]);

        return response()->json([
            'success' => true,
            'estado' => $nuevoEstado,
            'message' => "Estado cambiado a {$nuevoEstado}",
        ]);
    }
}
