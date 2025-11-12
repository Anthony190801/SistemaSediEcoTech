<?php

use App\Http\Controllers\Admin\CanjeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ParticipanteController;
use App\Http\Controllers\Admin\PremioController;
use App\Http\Controllers\Admin\ProyectoController;
use App\Http\Controllers\Admin\RecoleccionController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\ParticipantLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Participant\DashboardController as ParticipantDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación para participantes
Route::middleware('guest')->group(function () {
    Route::get('/login', [ParticipantLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ParticipantLoginController::class, 'login']);
});

Route::post('/logout', [ParticipantLoginController::class, 'logout'])->name('logout');

// Rutas de autenticación para administradores
Route::prefix('admin')->middleware('guest')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::get('/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [AdminRegisterController::class, 'register']);
});

// Ruta POST para logout de administradores
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Ruta GET para logout (por si alguien accede directamente, también ejecuta el logout)
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout.get');

// Rutas protegidas para participantes
Route::middleware(['auth:participant', 'role:Usuario'])->prefix('dashboard/participant')->group(function () {
    Route::get('/', [ParticipantDashboardController::class, 'index'])->name('participant.dashboard');
});

Route::middleware(['auth:admin', 'role:Administrador'])->prefix('dashboard/admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Rutas protegidas para administradores - Módulo de Proyectos
Route::middleware(['auth:admin', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('proyectos', ProyectoController::class);
    Route::post('proyectos/{proyecto}/toggle-status', [ProyectoController::class, 'toggleStatus'])->name('proyectos.toggle-status');
    
    // Gestión de instituciones en proyectos
    Route::post('proyectos/{proyecto}/instituciones', [\App\Http\Controllers\Admin\InstitucionProyectoController::class, 'store'])->name('proyectos.instituciones.store');
    Route::post('instituciones/quick-create', [\App\Http\Controllers\Admin\InstitucionProyectoController::class, 'quickCreate'])->name('instituciones.quick-create');
    Route::delete('proyectos/{proyecto}/instituciones/{institucionProyecto}', [\App\Http\Controllers\Admin\InstitucionProyectoController::class, 'destroy'])->name('proyectos.instituciones.destroy');
    
    // Gestión de participantes de una institución en un proyecto
    Route::get('proyectos/{proyecto}/instituciones/{institucionProyecto}/participantes', [\App\Http\Controllers\Admin\InstitucionParticipanteController::class, 'index'])->name('proyectos.instituciones.participantes');
    Route::post('proyectos/{proyecto}/instituciones/{institucionProyecto}/participantes', [\App\Http\Controllers\Admin\InstitucionParticipanteController::class, 'store'])->name('proyectos.instituciones.participantes.store');
    Route::delete('proyectos/{proyecto}/instituciones/{institucionProyecto}/participantes/{participante}', [\App\Http\Controllers\Admin\InstitucionParticipanteController::class, 'destroy'])->name('proyectos.instituciones.participantes.destroy');

    // Módulo de Usuarios
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->parameters(['users' => 'user']);

    // Módulo de Participantes
    Route::resource('participantes', ParticipanteController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::get('participantes/buscar', [ParticipanteController::class, 'buscar'])->name('participantes.buscar');

    // Módulo de Premios
    Route::resource('premios', PremioController::class);

    // Módulo de Canjes
    Route::resource('canjes', CanjeController::class)->only(['index', 'show', 'update', 'destroy']);

    // Módulo de Materiales
    Route::resource('materiales', MaterialController::class)->parameters([
        'materiales' => 'material',
    ]);
    Route::get('materiales/por-proyecto', [MaterialController::class, 'porProyecto'])->name('materiales.por-proyecto');
    Route::post('materiales/{material}/agregar-precio', [MaterialController::class, 'agregarPrecio'])->name('materiales.agregar-precio');
    Route::get('materiales/{material}/precios/{materialPrecio}/editar', [MaterialController::class, 'editarPrecio'])->name('materiales.editar-precio');
    Route::put('materiales/{material}/precios/{materialPrecio}', [MaterialController::class, 'actualizarPrecio'])->name('materiales.actualizar-precio');
    Route::delete('materiales/{material}/precios/{materialPrecio}', [MaterialController::class, 'eliminarPrecio'])->name('materiales.eliminar-precio');

    // Módulo de Recolecciones
    Route::resource('recolecciones', RecoleccionController::class)
        ->only(['index', 'create', 'store', 'destroy'])
        ->parameters([
            'recolecciones' => 'recoleccion',
        ]);
    Route::get('recolecciones/paso2-institucion', [RecoleccionController::class, 'paso2Institucion'])->name('recolecciones.paso2-institucion');
    Route::get('recolecciones/paso3-participantes', [RecoleccionController::class, 'paso3Participantes'])->name('recolecciones.paso3-participantes');
    Route::get('recolecciones/paso4-registrar', [RecoleccionController::class, 'paso4Registrar'])->name('recolecciones.paso4-registrar');

    // Módulo de Anuncios
    Route::resource('anuncios', \App\Http\Controllers\Admin\AnuncioController::class);
});

// Rutas protegidas para participantes
Route::middleware(['auth:participant', 'role:Usuario'])->prefix('participant')->name('participant.')->group(function () {
    Route::get('anuncios', [\App\Http\Controllers\Participant\AnuncioController::class, 'index'])->name('anuncios.index');
});
