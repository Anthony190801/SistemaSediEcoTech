<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMaterialRequest;
use App\Http\Requests\Admin\UpdateMaterialRequest;
use App\Models\Material;
use App\Models\MaterialPrecio;
use App\Models\Precio;
use App\Models\Proyecto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Material::with(['materialPrecios.precio', 'materialPrecios.proyectos']);

        // Búsqueda por nombre
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%'.$request->search.'%');
        }

        // Filtro por proyecto
        if ($request->filled('proyecto_id')) {
            $query->whereExists(function ($subquery) use ($request) {
                $subquery->select(\Illuminate\Support\Facades\DB::raw(1))
                    ->from('material_precio')
                    ->join('material_precio_proyecto', 'material_precio.id', '=', 'material_precio_proyecto.material_precio_id')
                    ->whereColumn('material_precio.material_id', 'materiales.id')
                    ->where('material_precio_proyecto.proyecto_id', $request->proyecto_id)
                    ->where('material_precio.fecha_inicio', '<=', now())
                    ->where(function ($q) {
                        $q->whereNull('material_precio.fecha_fin')
                            ->orWhere('material_precio.fecha_fin', '>=', now());
                    });
            });
        }

        $materiales = $query->orderBy('nombre')->paginate(15);

        // Obtener todos los proyectos con precio activo para cada material
        $materiales->getCollection()->transform(function ($material) {
            // Obtener todas las configuraciones de precio activas
            $preciosActivos = $material->materialPrecios()
                ->where('fecha_inicio', '<=', now())
                ->where(function ($q) {
                    $q->whereNull('fecha_fin')
                        ->orWhere('fecha_fin', '>=', now());
                })
                ->with('proyectos')
                ->get();

            // Obtener todos los proyectos únicos que tienen precio activo
            $proyectosActivos = $preciosActivos
                ->pluck('proyectos')
                ->flatten()
                ->unique('id')
                ->pluck('nombre')
                ->toArray();

            $material->proyectos_activos = $proyectosActivos;

            return $material;
        });

        $proyectos = Proyecto::orderBy('nombre')->get();

        return view('admin.materiales.index', [
            'materiales' => $materiales,
            'proyectos' => $proyectos,
            'search' => $request->search,
            'proyecto_id' => $request->proyecto_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $proyectos = Proyecto::where('estado', 'Activo')->orderBy('nombre')->get();

        return view('admin.materiales.create', [
            'proyectos' => $proyectos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request): RedirectResponse
    {
        $material = DB::transaction(function () use ($request) {
            // Crear el material (solo nombre e imagen)
            $material = Material::create([
                'nombre' => $request->nombre,
                'url_foto' => null,
            ]);

            // Subir imagen si existe
            if ($request->hasFile('url_foto')) {
                $path = $request->file('url_foto')->store('materiales', 'public');
                $material->url_foto = $path;
                $material->save();
            }

            return $material;
        });

        return redirect()->route('admin.materiales.edit', $material)
            ->with('success', 'Material creado exitosamente. Ahora puedes agregar configuraciones de precio por proyecto.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material): View
    {
        $material->load(['materialPrecios.precio', 'materialPrecios.proyectos']);

        return view('admin.materiales.show', [
            'material' => $material,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material): View
    {
        $material->load(['materialPrecios.precio', 'materialPrecios.proyectos']);

        // Obtener todas las configuraciones de precio del material
        $configuracionesPrecio = $material->materialPrecios()
            ->with(['precio', 'proyectos'])
            ->orderByDesc('fecha_inicio')
            ->get()
            ->map(function ($mp) {
                return [
                    'id' => $mp->id,
                    'precio' => $mp->precio->cantidad_soles,
                    'puntaje' => $mp->puntaje,
                    'fecha_inicio' => $mp->fecha_inicio?->format('Y-m-d'),
                    'fecha_fin' => $mp->fecha_fin?->format('Y-m-d'),
                    'proyectos' => $mp->proyectos->pluck('id')->toArray(),
                    'proyectos_nombres' => $mp->proyectos->pluck('nombre')->toArray(),
                    'activo' => ($mp->fecha_inicio <= now()) && ($mp->fecha_fin === null || $mp->fecha_fin >= now()),
                ];
            });

        $proyectos = Proyecto::where('estado', 'Activo')->orderBy('nombre')->get();

        // Obtener proyectos que ya tienen una configuración activa
        $proyectosConPrecio = $material->materialPrecios()
            ->where('fecha_inicio', '<=', now())
            ->where(function ($q) {
                $q->whereNull('fecha_fin')
                    ->orWhere('fecha_fin', '>=', now());
            })
            ->with('proyectos')
            ->get()
            ->pluck('proyectos')
            ->flatten()
            ->pluck('id')
            ->unique()
            ->toArray();

        // Verificar si hay proyectos disponibles sin precio asignado
        $proyectosDisponibles = $proyectos->whereNotIn('id', $proyectosConPrecio);
        $todosProyectosTienenPrecio = $proyectosDisponibles->isEmpty();

        return view('admin.materiales.edit', [
            'material' => $material,
            'proyectos' => $proyectos,
            'configuracionesPrecio' => $configuracionesPrecio,
            'proyectosConPrecio' => $proyectosConPrecio,
            'proyectosDisponibles' => $proyectosDisponibles,
            'todosProyectosTienenPrecio' => $todosProyectosTienenPrecio,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, Material $material): RedirectResponse
    {
        DB::transaction(function () use ($request, $material) {
            // Actualizar nombre
            $material->nombre = $request->nombre;

            // Actualizar imagen si se subió una nueva
            if ($request->hasFile('url_foto')) {
                // Eliminar imagen anterior si existe
                if ($material->url_foto) {
                    Storage::disk('public')->delete($material->url_foto);
                }

                $path = $request->file('url_foto')->store('materiales', 'public');
                $material->url_foto = $path;
            }

            $material->save();
        });

        return redirect()->route('admin.materiales.edit', $material)
            ->with('success', 'Material actualizado exitosamente.');
    }

    /**
     * Agregar una nueva configuración de precio al material.
     */
    public function agregarPrecio(Request $request, Material $material): RedirectResponse
    {
        $request->validate([
            'cantidad_soles' => ['required', 'numeric', 'min:0.01'],
            'puntaje' => ['required', 'numeric', 'min:0.01'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after:fecha_inicio'],
            'proyectos' => ['required', 'array', 'min:1'],
            'proyectos.*' => ['exists:proyectos,id'],
        ], [
            'cantidad_soles.required' => 'El precio en soles es obligatorio.',
            'puntaje.required' => 'El puntaje es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'proyectos.required' => 'Debe seleccionar al menos un proyecto.',
        ]);

        // Verificar que no existan configuraciones activas para los proyectos seleccionados
        $proyectosConPrecio = [];
        foreach ($request->proyectos as $proyectoId) {
            $tienePrecioActivo = $material->materialPrecios()
                ->whereHas('proyectos', function ($q) use ($proyectoId) {
                    $q->where('proyectos.id', $proyectoId);
                })
                ->where('fecha_inicio', '<=', now())
                ->where(function ($q) {
                    $q->whereNull('fecha_fin')
                        ->orWhere('fecha_fin', '>=', now());
                })
                ->exists();

            if ($tienePrecioActivo) {
                $proyecto = Proyecto::find($proyectoId);
                $proyectosConPrecio[] = $proyecto->nombre;
            }
        }

        if (! empty($proyectosConPrecio)) {
            return redirect()->route('admin.materiales.edit', $material)
                ->with('error', 'Los siguientes proyectos ya tienen una configuración de precio activa: '.implode(', ', $proyectosConPrecio).'. Por favor, edita la configuración existente o elimínala primero.')
                ->withInput();
        }

        DB::transaction(function () use ($request, $material) {
            // Crear el precio
            $precio = Precio::create([
                'cantidad_soles' => $request->cantidad_soles,
            ]);

            // Crear la relación material_precio
            $materialPrecio = MaterialPrecio::create([
                'material_id' => $material->id,
                'precio_id' => $precio->id,
                'puntaje' => $request->puntaje,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
            ]);

            // Asociar con proyectos
            $materialPrecio->proyectos()->attach($request->proyectos);
        });

        return redirect()->route('admin.materiales.edit', $material)
            ->with('success', 'Configuración de precio agregada exitosamente.');
    }

    /**
     * Mostrar formulario para editar una configuración de precio.
     */
    public function editarPrecio(Material $material, MaterialPrecio $materialPrecio): View
    {
        $materialPrecio->load(['precio', 'proyectos']);
        $proyectos = Proyecto::where('estado', 'Activo')->orderBy('nombre')->get();

        return view('admin.materiales.editar-precio', [
            'material' => $material,
            'materialPrecio' => $materialPrecio,
            'proyectos' => $proyectos,
        ]);
    }

    /**
     * Actualizar una configuración de precio del material.
     */
    public function actualizarPrecio(Request $request, Material $material, MaterialPrecio $materialPrecio): RedirectResponse
    {
        $request->validate([
            'cantidad_soles' => ['required', 'numeric', 'min:0.01'],
            'puntaje' => ['required', 'numeric', 'min:0.01'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after:fecha_inicio'],
            'proyectos' => ['required', 'array', 'min:1'],
            'proyectos.*' => ['exists:proyectos,id'],
        ], [
            'cantidad_soles.required' => 'El precio en soles es obligatorio.',
            'puntaje.required' => 'El puntaje es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'proyectos.required' => 'Debe seleccionar al menos un proyecto.',
        ]);

        // Verificar que no existan otras configuraciones activas para los proyectos seleccionados
        // (excluyendo la configuración actual que estamos editando)
        $proyectosConPrecio = [];
        foreach ($request->proyectos as $proyectoId) {
            $tienePrecioActivo = $material->materialPrecios()
                ->where('id', '!=', $materialPrecio->id)
                ->whereHas('proyectos', function ($q) use ($proyectoId) {
                    $q->where('proyectos.id', $proyectoId);
                })
                ->where('fecha_inicio', '<=', now())
                ->where(function ($q) {
                    $q->whereNull('fecha_fin')
                        ->orWhere('fecha_fin', '>=', now());
                })
                ->exists();

            if ($tienePrecioActivo) {
                $proyecto = Proyecto::find($proyectoId);
                $proyectosConPrecio[] = $proyecto->nombre;
            }
        }

        if (! empty($proyectosConPrecio)) {
            return redirect()->route('admin.materiales.editar-precio', ['material' => $material->id, 'materialPrecio' => $materialPrecio->id])
                ->with('error', 'Los siguientes proyectos ya tienen otra configuración de precio activa: '.implode(', ', $proyectosConPrecio).'. Por favor, elimina la configuración existente primero.')
                ->withInput();
        }

        DB::transaction(function () use ($request, $materialPrecio) {
            // Actualizar el precio
            $materialPrecio->precio->cantidad_soles = $request->cantidad_soles;
            $materialPrecio->precio->save();

            // Actualizar material_precio
            $materialPrecio->puntaje = $request->puntaje;
            $materialPrecio->fecha_inicio = $request->fecha_inicio;
            $materialPrecio->fecha_fin = $request->fecha_fin;
            $materialPrecio->save();

            // Actualizar proyectos asociados
            $materialPrecio->proyectos()->sync($request->proyectos);
        });

        return redirect()->route('admin.materiales.edit', $material)
            ->with('success', 'Configuración de precio actualizada exitosamente.');
    }

    /**
     * Eliminar una configuración de precio del material.
     */
    public function eliminarPrecio(Material $material, MaterialPrecio $materialPrecio): RedirectResponse
    {
        try {
            DB::transaction(function () use ($materialPrecio) {
                // Eliminar relaciones con proyectos
                $materialPrecio->proyectos()->detach();
                // Eliminar el material_precio (el precio se elimina por cascada si es necesario)
                $materialPrecio->delete();
            });

            return redirect()->route('admin.materiales.edit', $material)
                ->with('success', 'Configuración de precio eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.materiales.edit', $material)
                ->with('error', 'Error al eliminar la configuración de precio: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material): RedirectResponse
    {
        try {
            DB::transaction(function () use ($material) {

                // Eliminar imagen si existe
                if ($material->url_foto) {
                    Storage::disk('public')->delete($material->url_foto);
                }

                // Eliminar relaciones material_precio_proyecto
                foreach ($material->materialPrecios as $materialPrecio) {
                    $materialPrecio->proyectos()->detach();
                }

                // Eliminar el material (las relaciones se eliminan por cascada)
                $material->delete();
            });

            return redirect()->route('admin.materiales.index')
                ->with('success', 'Material eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el material: '.$e->getMessage());
        }
    }

    /**
     * Obtener materiales disponibles por proyecto.
     */
    public function porProyecto(Request $request)
    {
        $proyectoId = $request->input('proyecto_id');

        $materiales = MaterialPrecio::whereHas('proyectos', function ($q) use ($proyectoId) {
            $q->where('proyectos.id', $proyectoId);
        })
            ->where('fecha_inicio', '<=', now())
            ->where(function ($q) {
                $q->whereNull('fecha_fin')
                    ->orWhere('fecha_fin', '>=', now());
            })
            ->with(['material', 'precio'])
            ->get()
            ->map(function ($mp) {
                return [
                    'id' => $mp->id,
                    'nombre' => $mp->material->nombre,
                    'precio' => number_format($mp->precio->cantidad_soles, 2),
                    'puntaje' => number_format($mp->puntaje, 2),
                ];
            });

        return response()->json(['materiales' => $materiales]);
    }
}
