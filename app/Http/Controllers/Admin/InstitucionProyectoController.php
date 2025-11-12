<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuickCreateInstitucionRequest;
use App\Http\Requests\Admin\StoreInstitucionProyectoRequest;
use App\Models\Institucion;
use App\Models\InstitucionProyecto;
use App\Models\Proyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class InstitucionProyectoController extends Controller
{
    /**
     * Store a newly created institution-project association.
     */
    public function store(StoreInstitucionProyectoRequest $request, Proyecto $proyecto): RedirectResponse
    {
        // Verificar que no exista ya la asociación
        $existe = InstitucionProyecto::where('proyecto_id', $proyecto->id)
            ->where('institucion_id', $request->institucion_id)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Esta institución ya está asociada al proyecto.');
        }

        InstitucionProyecto::create([
            'proyecto_id' => $proyecto->id,
            'institucion_id' => $request->institucion_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => $request->estado,
        ]);

        return back()->with('success', 'Institución asociada exitosamente al proyecto.');
    }

    /**
     * Quick create a new institution and associate it to the project.
     */
    public function quickCreate(QuickCreateInstitucionRequest $request): RedirectResponse
    {
        $proyecto = Proyecto::findOrFail($request->proyecto_id);

        DB::beginTransaction();

        try {
            // Crear la institución
            $institucion = Institucion::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'nivel' => $request->nivel,
            ]);

            // Verificar que no exista ya la asociación
            $existe = InstitucionProyecto::where('proyecto_id', $proyecto->id)
                ->where('institucion_id', $institucion->id)
                ->exists();

            if ($existe) {
                DB::rollBack();

                return back()->with('error', 'Esta institución ya está asociada al proyecto.');
            }

            // Asociar la institución al proyecto
            InstitucionProyecto::create([
                'proyecto_id' => $proyecto->id,
                'institucion_id' => $institucion->id,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'estado' => $request->estado,
            ]);

            DB::commit();

            return redirect()->route('admin.proyectos.show', $proyecto)
                ->with('success', 'Institución creada y asociada exitosamente al proyecto.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error al crear la institución: '.$e->getMessage());
        }
    }

    /**
     * Remove the institution-project association.
     */
    public function destroy(Proyecto $proyecto, InstitucionProyecto $institucionProyecto): RedirectResponse
    {
        // Verificar que la asociación pertenezca al proyecto
        if ($institucionProyecto->proyecto_id !== $proyecto->id) {
            return back()->with('error', 'La asociación no pertenece a este proyecto.');
        }

        $institucionProyecto->delete();

        return back()->with('success', 'Institución desvinculada exitosamente del proyecto.');
    }
}
