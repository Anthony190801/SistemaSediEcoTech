<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institucion;
use App\Models\Participante;
use App\Models\Premio;
use App\Models\Proyecto;
use App\Models\Recoleccion;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        // Métricas principales
        $totalProyectos = Proyecto::where('estado', 'Activo')->count();
        $totalInstituciones = Institucion::count();
        $totalParticipantes = Participante::count();
        $totalKgReciclados = Recoleccion::where('recolecciones.estado', 'Validado')->sum('cantidad_kilogramos') ?? 0;
        $totalPremios = Premio::where('estado', 'Disponible')->count();

        // Estadísticas de recolecciones
        $totalMateriales = \App\Models\Material::count();
        $totalPuntosGenerados = Recoleccion::where('recolecciones.estado', 'Validado')
            ->join('material_precio', 'recolecciones.material_precio_id', '=', 'material_precio.id')
            ->selectRaw('SUM(recolecciones.cantidad_kilogramos * material_precio.puntaje) as total')
            ->value('total') ?? 0;

        // Material más reciclado
        $materialMasReciclado = Recoleccion::where('recolecciones.estado', 'Validado')
            ->join('material_precio', 'recolecciones.material_precio_id', '=', 'material_precio.id')
            ->join('materiales', 'material_precio.material_id', '=', 'materiales.id')
            ->select('materiales.nombre', DB::raw('SUM(recolecciones.cantidad_kilogramos) as total_kg'))
            ->groupBy('materiales.id', 'materiales.nombre')
            ->orderByDesc('total_kg')
            ->first();

        // Institución con mayor recolección
        $institucionMayorRecoleccion = Recoleccion::where('recolecciones.estado', 'Validado')
            ->join('participantes', 'recolecciones.participante_id', '=', 'participantes.id')
            ->join('institucion_proyecto', 'participantes.institucion_proyecto_id', '=', 'institucion_proyecto.id')
            ->join('instituciones', 'institucion_proyecto.institucion_id', '=', 'instituciones.id')
            ->select('instituciones.nombre', DB::raw('SUM(recolecciones.cantidad_kilogramos) as total_kg'))
            ->groupBy('instituciones.id', 'instituciones.nombre')
            ->orderByDesc('total_kg')
            ->first();

        // Gráfica de materiales más reciclados (top 6)
        $graficaMaterialesTop = Recoleccion::query()
            ->where('recolecciones.estado', 'Validado')
            ->join('material_precio', 'recolecciones.material_precio_id', '=', 'material_precio.id')
            ->join('materiales', 'material_precio.material_id', '=', 'materiales.id')
            ->select('materiales.nombre', DB::raw('SUM(recolecciones.cantidad_kilogramos) as total_kg'))
            ->groupBy('materiales.id', 'materiales.nombre')
            ->orderByDesc('total_kg')
            ->limit(6)
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->nombre,
                    'total_kg' => round((float) $item->total_kg, 2),
                ];
            });

        // Gráfica de participación mensual (año actual)
        $graficaMensual = Recoleccion::query()
            ->where('recolecciones.estado', 'Validado')
            ->whereYear('recolecciones.fecha', now()->year)
            ->select(
                DB::raw('MONTH(recolecciones.fecha) as mes'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->map(function ($item) {
                $meses = [
                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
                ];

                return [
                    'mes' => $meses[$item->mes] ?? $item->mes,
                    'total' => (int) $item->total,
                ];
            });

        // Completar meses faltantes con 0
        $mesesCompletos = [];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $datosMensuales = $graficaMensual->pluck('total', 'mes')->toArray();

        foreach ($meses as $mes) {
            $mesesCompletos[] = [
                'mes' => $mes,
                'total' => $datosMensuales[$mes] ?? 0,
            ];
        }

        // Gráfica de instituciones (barras)
        $graficaInstituciones = Recoleccion::where('recolecciones.estado', 'Validado')
            ->join('participantes', 'recolecciones.participante_id', '=', 'participantes.id')
            ->join('institucion_proyecto', 'participantes.institucion_proyecto_id', '=', 'institucion_proyecto.id')
            ->join('instituciones', 'institucion_proyecto.institucion_id', '=', 'instituciones.id')
            ->select('instituciones.nombre', DB::raw('SUM(recolecciones.cantidad_kilogramos) as total_kg'))
            ->groupBy('instituciones.id', 'instituciones.nombre')
            ->orderByDesc('total_kg')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->nombre,
                    'total_kg' => round((float) $item->total_kg, 2),
                ];
            });

        // Gráfica de materiales (torta)
        $graficaMateriales = Recoleccion::where('recolecciones.estado', 'Validado')
            ->join('material_precio', 'recolecciones.material_precio_id', '=', 'material_precio.id')
            ->join('materiales', 'material_precio.material_id', '=', 'materiales.id')
            ->select('materiales.nombre', DB::raw('SUM(recolecciones.cantidad_kilogramos) as total_kg'))
            ->groupBy('materiales.id', 'materiales.nombre')
            ->orderByDesc('total_kg')
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->nombre,
                    'total_kg' => round((float) $item->total_kg, 2),
                ];
            });

        // Gráfica de evolución (últimos 30 días)
        $graficaEvolucion = Recoleccion::where('recolecciones.estado', 'Validado')
            ->whereDate('recolecciones.fecha', '>=', now()->subDays(30))
            ->select(
                DB::raw('DATE(recolecciones.fecha) as fecha'),
                DB::raw('SUM(recolecciones.cantidad_kilogramos) as total_kg')
            )
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get()
            ->map(function ($item) {
                return [
                    'fecha' => $item->fecha,
                    'total_kg' => round((float) $item->total_kg, 2),
                ];
            });

        return view('admin.dashboard', [
            'totalProyectos' => $totalProyectos,
            'totalInstituciones' => $totalInstituciones,
            'totalParticipantes' => $totalParticipantes,
            'totalKgReciclados' => round($totalKgReciclados, 2),
            'totalPremios' => $totalPremios,
            'totalMateriales' => $totalMateriales,
            'totalPuntosGenerados' => round($totalPuntosGenerados, 2),
            'materialMasReciclado' => $materialMasReciclado,
            'institucionMayorRecoleccion' => $institucionMayorRecoleccion,
            'graficaMaterialesTop' => $graficaMaterialesTop,
            'graficaMensual' => collect($mesesCompletos),
            'graficaInstituciones' => $graficaInstituciones,
            'graficaMateriales' => $graficaMateriales,
            'graficaEvolucion' => $graficaEvolucion,
        ]);
    }
}
