<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Participante;
use App\Models\Proyecto;
use App\Models\Recoleccion;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        // Obtener estadísticas reales
        $totalKg = Recoleccion::where('estado', 'Validado')
            ->sum('cantidad_kilogramos') ?? 0;

        $totalParticipantes = Participante::count();

        $totalInstituciones = Institucion::count();

        $totalProyectos = Proyecto::where('estado', 'Activo')->count();

        return view('welcome', [
            'totalKg' => round($totalKg, 2),
            'totalParticipantes' => $totalParticipantes,
            'totalInstituciones' => $totalInstituciones,
            'totalProyectos' => $totalProyectos,
        ]);
    }
}
