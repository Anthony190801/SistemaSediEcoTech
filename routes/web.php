<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProyectoController;
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

Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

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
});
