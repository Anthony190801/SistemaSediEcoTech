<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParticipanteRequest;
use App\Models\InstitucionProyecto;
use App\Models\Participante;
use App\Models\Persona;
use App\Models\Proyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InstitucionParticipanteController extends Controller
{
    /**
     * Display a listing of participants for a specific institution-project.
     */
    public function index(Request $request, Proyecto $proyecto, InstitucionProyecto $institucionProyecto): View
    {
        // Verificar que la institución-proyecto pertenezca al proyecto
        if ($institucionProyecto->proyecto_id !== $proyecto->id) {
            abort(404, 'La institución no pertenece a este proyecto.');
        }

        $institucionProyecto->load(['institucion', 'proyecto']);

        $query = Participante::with(['persona'])
            ->where('institucion_proyecto_id', $institucionProyecto->id);

        // Búsqueda por nombre, apellidos o DNI
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('persona', function ($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('dni', 'like', "%{$search}%");
            });
        }

        // Filtro por nivel académico
        if ($request->filled('nivel_academico')) {
            $query->where('nivel_academico', $request->nivel_academico);
        }

        $participantes = $query->orderByDesc('puntaje_total')->paginate(15);

        // Obtener personas disponibles (que no sean participantes de esta institución-proyecto)
        $personasParticipantes = Participante::where('institucion_proyecto_id', $institucionProyecto->id)
            ->pluck('persona_id')
            ->toArray();

        $personasDisponibles = Persona::whereNotIn('id', $personasParticipantes)
            ->orderBy('nombres')
            ->orderBy('apellidos')
            ->get();

        $nivelesAcademicos = ['Inicial', 'Primaria', 'Secundaria', 'Universitario'];

        return view('admin.proyectos.instituciones.participantes', [
            'proyecto' => $proyecto,
            'institucionProyecto' => $institucionProyecto,
            'participantes' => $participantes,
            'personasDisponibles' => $personasDisponibles,
            'nivelesAcademicos' => $nivelesAcademicos,
            'search' => $request->search,
            'nivel_academico' => $request->nivel_academico,
        ]);
    }

    /**
     * Store a newly created participant.
     */
    public function store(StoreParticipanteRequest $request, Proyecto $proyecto, InstitucionProyecto $institucionProyecto): RedirectResponse
    {
        // Verificar que la institución-proyecto pertenezca al proyecto
        if ($institucionProyecto->proyecto_id !== $proyecto->id) {
            abort(404, 'La institución no pertenece a este proyecto.');
        }

        // Verificar que no exista ya un participante con la misma persona e institución-proyecto
        $existe = Participante::where('persona_id', $request->persona_id)
            ->where('institucion_proyecto_id', $institucionProyecto->id)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Esta persona ya es participante de esta institución en este proyecto.');
        }

        DB::beginTransaction();

        try {
            Participante::create([
                'institucion_proyecto_id' => $institucionProyecto->id,
                'persona_id' => $request->persona_id,
                'uuid' => Str::uuid()->toString(),
                'anio' => $request->anio,
                'nivel_academico' => $request->nivel_academico,
                'ciclo_o_grado' => $request->ciclo_o_grado,
                'aula' => $request->aula,
                'puntaje_total' => 0,
            ]);

            DB::commit();

            return back()->with('success', 'Participante agregado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error al agregar el participante: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified participant.
     */
    public function destroy(Proyecto $proyecto, InstitucionProyecto $institucionProyecto, Participante $participante): RedirectResponse
    {
        // Verificar que el participante pertenezca a la institución-proyecto
        if ($participante->institucion_proyecto_id !== $institucionProyecto->id) {
            abort(404, 'El participante no pertenece a esta institución.');
        }

        try {
            $participante->delete();

            return back()->with('success', 'Participante eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el participante: '.$e->getMessage());
        }
    }
}
