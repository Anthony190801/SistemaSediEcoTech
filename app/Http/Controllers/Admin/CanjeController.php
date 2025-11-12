<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCanjeRequest;
use App\Models\Canje;
use App\Models\Respuesta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CanjeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Canje::with([
            'participante.persona',
            'participante.institucionProyecto.institucion',
            'participante.institucionProyecto.proyecto',
            'premio.articulo',
            'respuesta',
        ]);

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por proyecto
        if ($request->filled('proyecto_id')) {
            $query->whereHas('participante.institucionProyecto', function ($q) use ($request) {
                $q->where('proyecto_id', $request->proyecto_id);
            });
        }

        // Filtro por institución
        if ($request->filled('institucion_id')) {
            $query->whereHas('participante.institucionProyecto', function ($q) use ($request) {
                $q->where('institucion_id', $request->institucion_id);
            });
        }

        // Filtro por fecha
        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_solicitud_canje', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_solicitud_canje', '<=', $request->fecha_hasta);
        }

        $canjes = $query->orderByDesc('fecha_solicitud_canje')->paginate(15);

        // Obtener datos para los filtros
        $instituciones = \App\Models\Institucion::orderBy('nombre')->get();
        $proyectos = \App\Models\Proyecto::orderBy('nombre')->get();

        // Estadísticas para el panel
        $estadisticas = [
            'total' => Canje::count(),
            'pendientes' => Canje::where('estado', 'Pendiente')->count(),
            'programados' => Canje::where('estado', 'Programado')->count(),
            'entregados' => Canje::where('estado', 'Entregado')->count(),
        ];

        return view('admin.canjes.index', [
            'canjes' => $canjes,
            'instituciones' => $instituciones,
            'proyectos' => $proyectos,
            'estadisticas' => $estadisticas,
            'estado' => $request->estado,
            'proyecto_id' => $request->proyecto_id,
            'institucion_id' => $request->institucion_id,
            'fecha_desde' => $request->fecha_desde,
            'fecha_hasta' => $request->fecha_hasta,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Canje $canje): View
    {
        $canje->load([
            'participante.persona',
            'participante.institucionProyecto.institucion',
            'participante.institucionProyecto.proyecto',
            'premio.articulo',
            'premio.institucionProyecto',
            'respuesta',
        ]);

        return view('admin.canjes.show', [
            'canje' => $canje,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCanjeRequest $request, Canje $canje): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            // Si se está programando la entrega
            if ($data['estado'] === 'Programado' && ! $canje->respuesta_id) {
                $respuesta = Respuesta::create([
                    'lugar' => $data['lugar'],
                    'fecha_programada' => $data['fecha_programada'],
                    'hora' => $data['hora'],
                ]);

                $data['respuesta_id'] = $respuesta->id;
            } elseif ($data['estado'] === 'Programado' && $canje->respuesta_id) {
                // Actualizar respuesta existente
                $canje->respuesta->update([
                    'lugar' => $data['lugar'],
                    'fecha_programada' => $data['fecha_programada'],
                    'hora' => $data['hora'],
                ]);
            }

            // Si se marca como entregado
            if ($data['estado'] === 'Entregado') {
                $data['fecha_entrega'] = now();
            }

            $canje->update($data);

            DB::commit();

            return redirect()->route('admin.canjes.show', $canje)
                ->with('success', 'Canje actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Error al actualizar el canje: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Canje $canje): RedirectResponse
    {
        try {
            // Eliminar respuesta asociada si existe
            if ($canje->respuesta_id) {
                $canje->respuesta->delete();
            }

            $canje->delete();

            return redirect()->route('admin.canjes.index')
                ->with('success', 'Canje eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el canje: '.$e->getMessage());
        }
    }
}
