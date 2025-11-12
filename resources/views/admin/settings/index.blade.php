@extends('layouts.admin')

@section('title', 'Configuración - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumbs -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#34A853]">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Configuración</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Configuración
        </h2>
        <p class="text-gray-600 mt-1">Gestiona las preferencias y opciones de tu cuenta</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Opciones de Configuración -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Información de la Cuenta -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Información de la Cuenta
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Nombre</p>
                            <p class="text-gray-900 mt-1">{{ $user->name }}</p>
                        </div>
                        <a href="{{ route('admin.profile.index') }}" class="text-[#34A853] hover:text-green-700 text-sm font-medium">
                            Editar →
                        </a>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Correo Electrónico</p>
                            <p class="text-gray-900 mt-1">{{ $user->email }}</p>
                        </div>
                        <a href="{{ route('admin.profile.index') }}" class="text-[#34A853] hover:text-green-700 text-sm font-medium">
                            Editar →
                        </a>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Rol</p>
                            <p class="text-gray-900 mt-1">{{ $user->rol }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Estado</p>
                            <p class="text-gray-900 mt-1">{{ $user->status_user }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seguridad -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Seguridad
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Contraseña</p>
                            <p class="text-gray-500 text-xs mt-1">Última actualización: {{ $user->updated_at->format('d/m/Y') }}</p>
                        </div>
                        <a href="{{ route('admin.profile.index') }}" class="text-[#34A853] hover:text-green-700 text-sm font-medium">
                            Cambiar →
                        </a>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Sesiones Activas</p>
                            <p class="text-gray-500 text-xs mt-1">Gestiona tus sesiones activas</p>
                        </div>
                        <span class="text-gray-400 text-sm">Próximamente</span>
                    </div>
                </div>
            </div>

            <!-- Preferencias -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    Preferencias
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Idioma</p>
                            <p class="text-gray-500 text-xs mt-1">Idioma de la interfaz</p>
                        </div>
                        <span class="text-gray-400 text-sm">Español</span>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Zona Horaria</p>
                            <p class="text-gray-500 text-xs mt-1">Zona horaria del sistema</p>
                        </div>
                        <span class="text-gray-400 text-sm">{{ config('app.timezone') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Notificaciones</p>
                            <p class="text-gray-500 text-xs mt-1">Gestiona tus preferencias de notificaciones</p>
                        </div>
                        <span class="text-gray-400 text-sm">Próximamente</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel de Ayuda -->
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-[#34A853] to-green-600 rounded-xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-bold mb-4">Accesos Rápidos</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.profile.index') }}" class="block p-3 bg-white/10 rounded-lg hover:bg-white/20 transition-colors">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm font-medium">Mi Perfil</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="block p-3 bg-white/10 rounded-lg hover:bg-white/20 transition-colors">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="text-sm font-medium">Dashboard</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Información del Sistema</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Versión de Laravel</span>
                        <span class="font-semibold text-gray-800">{{ app()->version() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Versión de PHP</span>
                        <span class="font-semibold text-gray-800">{{ PHP_VERSION }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Entorno</span>
                        <span class="font-semibold text-gray-800">{{ config('app.env') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

