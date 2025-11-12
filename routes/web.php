<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\ParticipantLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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

// Rutas protegidas (ejemplo - se crearán los dashboards después)
Route::middleware(['auth:participant', 'role:Usuario'])->prefix('dashboard/participant')->group(function () {
    Route::get('/', function () {
        return view('dashboard.participant');
    })->name('dashboard.participant');
});

Route::middleware(['auth:admin', 'role:Administrador'])->prefix('dashboard/admin')->group(function () {
    Route::get('/', function () {
        return view('dashboard.admin');
    })->name('dashboard.admin');
});
