<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePremioRequest;
use App\Http\Requests\Admin\UpdatePremioRequest;
use App\Models\Articulo;
use App\Models\InstitucionProyecto;
use App\Models\Premio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Premio::with([
            'articulo',
            'institucionProyecto.institucion',
            'institucionProyecto.proyecto',
        ]);

        // Filtro por tipo
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Filtro por proyecto
        if ($request->filled('proyecto_id')) {
            $query->whereHas('institucionProyecto', function ($q) use ($request) {
                $q->where('proyecto_id', $request->proyecto_id);
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $premios = $query->latest()->paginate(15);

        // Obtener datos para los filtros
        $institucionesProyectos = InstitucionProyecto::with(['institucion', 'proyecto'])->get();
        $proyectos = $institucionesProyectos->pluck('proyecto')->unique('id')->values();

        return view('admin.premios.index', [
            'premios' => $premios,
            'proyectos' => $proyectos,
            'tipo' => $request->tipo,
            'proyecto_id' => $request->proyecto_id,
            'estado' => $request->estado,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $articulos = Articulo::orderBy('nombre')->get();
        $institucionesProyectos = InstitucionProyecto::with(['institucion', 'proyecto'])
            ->orderBy('institucion_id')
            ->get();

        return view('admin.premios.create', [
            'articulos' => $articulos,
            'institucionesProyectos' => $institucionesProyectos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePremioRequest $request): RedirectResponse
    {
        // Validar que no exista el mismo artículo para el mismo proyecto con el mismo tipo
        $premioExistente = Premio::where('articulo_id', $request->articulo_id)
            ->where('institucion_proyecto_id', $request->institucion_proyecto_id)
            ->where('tipo', $request->tipo)
            ->with(['articulo', 'institucionProyecto.institucion', 'institucionProyecto.proyecto'])
            ->first();

        if ($premioExistente) {
            $articuloNombre = $premioExistente->articulo->nombre;
            $institucionNombre = $premioExistente->institucionProyecto->institucion->nombre;
            $proyectoNombre = $premioExistente->institucionProyecto->proyecto->nombre;
            $tipoPremio = $premioExistente->tipo;

            return back()->withInput()
                ->with('error', 'Ya existe un premio con estas características.')
                ->with('error_details', [
                    'message' => "El artículo '{$articuloNombre}' ya está registrado como premio de tipo '{$tipoPremio}' para {$institucionNombre} - {$proyectoNombre}.",
                    'suggestion' => 'Si deseas modificarlo, puedes editarlo desde el listado de premios.',
                    'premio_id' => $premioExistente->id,
                ]);
        }

        Premio::create($request->validated());

        return redirect()->route('admin.premios.index')
            ->with('success', 'Premio creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Premio $premio): View
    {
        $premio->load(['articulo', 'institucionProyecto.institucion', 'institucionProyecto.proyecto']);
        $articulos = Articulo::orderBy('nombre')->get();
        $institucionesProyectos = InstitucionProyecto::with(['institucion', 'proyecto'])
            ->orderBy('institucion_id')
            ->get();

        return view('admin.premios.edit', [
            'premio' => $premio,
            'articulos' => $articulos,
            'institucionesProyectos' => $institucionesProyectos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePremioRequest $request, Premio $premio): RedirectResponse
    {
        // Validar que no exista el mismo artículo para el mismo proyecto con el mismo tipo (excepto el actual)
        // Solo validar si cambió el artículo, institución-proyecto o tipo
        if ($request->articulo_id != $premio->articulo_id
            || $request->institucion_proyecto_id != $premio->institucion_proyecto_id
            || $request->tipo != $premio->tipo) {

            $premioExistente = Premio::where('articulo_id', $request->articulo_id)
                ->where('institucion_proyecto_id', $request->institucion_proyecto_id)
                ->where('tipo', $request->tipo)
                ->where('id', '!=', $premio->id)
                ->with(['articulo', 'institucionProyecto.institucion', 'institucionProyecto.proyecto'])
                ->first();

            if ($premioExistente) {
                $articuloNombre = $premioExistente->articulo->nombre;
                $institucionNombre = $premioExistente->institucionProyecto->institucion->nombre;
                $proyectoNombre = $premioExistente->institucionProyecto->proyecto->nombre;
                $tipoPremio = $premioExistente->tipo;

                return back()->withInput()
                    ->with('error', 'Ya existe un premio con estas características.')
                    ->with('error_details', [
                        'message' => "El artículo '{$articuloNombre}' ya está registrado como premio de tipo '{$tipoPremio}' para {$institucionNombre} - {$proyectoNombre}.",
                        'suggestion' => 'Si deseas modificarlo, puedes editarlo desde el listado de premios.',
                        'premio_id' => $premioExistente->id,
                    ]);
            }
        }

        $premio->update($request->validated());

        return redirect()->route('admin.premios.index')
            ->with('success', 'Premio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Premio $premio): RedirectResponse
    {
        try {
            $premio->delete();

            return redirect()->route('admin.premios.index')
                ->with('success', 'Premio eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el premio: '.$e->getMessage());
        }
    }
}
