<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateParticipanteRequest;
use App\Models\Institucion;
use App\Models\InstitucionProyecto;
use App\Models\Participante;
use App\Models\Proyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Participante::with([
            'persona',
            'institucionProyecto.institucion',
            'institucionProyecto.proyecto',
        ]);

        // Búsqueda por nombre, apellidos o DNI
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('persona', function ($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('dni', 'like', "%{$search}%");
            });
        }

        // Filtro por institución
        if ($request->filled('institucion_id')) {
            $query->whereHas('institucionProyecto', function ($q) use ($request) {
                $q->where('institucion_id', $request->institucion_id);
            });
        }

        // Filtro por proyecto
        if ($request->filled('proyecto_id')) {
            $query->whereHas('institucionProyecto', function ($q) use ($request) {
                $q->where('proyecto_id', $request->proyecto_id);
            });
        }

        // Filtro por nivel académico
        if ($request->filled('nivel_academico')) {
            $query->where('nivel_academico', $request->nivel_academico);
        }

        $participantes = $query->orderByDesc('puntaje_total')->paginate(15);

        // Obtener datos para los filtros
        $instituciones = Institucion::orderBy('nombre')->get();
        $proyectos = Proyecto::orderBy('nombre')->get();
        $nivelesAcademicos = Participante::distinct()->pluck('nivel_academico')->filter()->sort()->values();

        return view('admin.participantes.index', [
            'participantes' => $participantes,
            'instituciones' => $instituciones,
            'proyectos' => $proyectos,
            'nivelesAcademicos' => $nivelesAcademicos,
            'search' => $request->search,
            'institucion_id' => $request->institucion_id,
            'proyecto_id' => $request->proyecto_id,
            'nivel_academico' => $request->nivel_academico,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Participante $participante): View
    {
        $participante->load([
            'persona',
            'institucionProyecto.institucion',
            'institucionProyecto.proyecto',
            'recolecciones.materialPrecio.material',
            'canjes.premio.articulo',
            'canjes.respuesta',
        ]);

        // Calcular ranking del participante en su institución-proyecto
        $ranking = Participante::where('institucion_proyecto_id', $participante->institucion_proyecto_id)
            ->orderByDesc('puntaje_total')
            ->pluck('id')
            ->search($participante->id) + 1;

        $totalParticipantes = Participante::where('institucion_proyecto_id', $participante->institucion_proyecto_id)->count();

        // Obtener URL de retorno si existe
        $returnTo = $request->get('return_to', route('admin.participantes.index'));

        // Generar URL del QR para recolección
        $qrUrl = route('admin.recolecciones.registrar-por-uuid', ['uuid' => $participante->uuid]);

        return view('admin.participantes.show', [
            'participante' => $participante,
            'ranking' => $ranking,
            'totalParticipantes' => $totalParticipantes,
            'returnTo' => $returnTo,
            'qrUrl' => $qrUrl,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participante $participante): View
    {
        $participante->load([
            'persona',
            'institucionProyecto.institucion',
            'institucionProyecto.proyecto',
        ]);

        // Obtener todas las instituciones-proyectos disponibles
        $institucionesProyectos = InstitucionProyecto::with(['institucion', 'proyecto'])
            ->orderBy('institucion_id')
            ->get()
            ->map(function ($ip) {
                return [
                    'id' => $ip->id,
                    'label' => $ip->institucion->nombre.' - '.$ip->proyecto->nombre,
                ];
            });

        return view('admin.participantes.edit', [
            'participante' => $participante,
            'institucionesProyectos' => $institucionesProyectos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipanteRequest $request, Participante $participante): RedirectResponse
    {
        $participante->update($request->validated());

        return redirect()->route('admin.participantes.show', $participante)
            ->with('success', 'Participante actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participante $participante): RedirectResponse
    {
        try {
            $participante->delete();

            return redirect()->route('admin.participantes.index')
                ->with('success', 'Participante eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el participante: '.$e->getMessage());
        }
    }

    /**
     * Buscar participante por DNI, proyecto e institución.
     */
    public function buscar(Request $request)
    {
        $dni = $request->input('dni');
        $proyectoId = $request->input('proyecto_id');
        $institucionId = $request->input('institucion_id');

        $participante = Participante::whereHas('persona', function ($q) use ($dni) {
            $q->where('dni', $dni);
        })
            ->whereHas('institucionProyecto', function ($q) use ($proyectoId, $institucionId) {
                $q->where('proyecto_id', $proyectoId)
                    ->where('institucion_id', $institucionId);
            })
            ->with('persona')
            ->first();

        if ($participante) {
            return response()->json([
                'success' => true,
                'participante' => [
                    'id' => $participante->id,
                    'nombre' => $participante->persona->nombres.' '.$participante->persona->apellidos,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Participante no encontrado',
        ]);
    }
}
