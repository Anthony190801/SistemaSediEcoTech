@extends('layouts.admin')

@section('title', 'Detalles del Usuario - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
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
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('admin.users.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#34A853] md:ml-2">Usuarios</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $user->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Detalles del Usuario
            </h2>
            <p class="text-gray-600 mt-1">Información completa de {{ $user->name }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a 
                href="{{ route('admin.users.edit', $user) }}" 
                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors flex items-center space-x-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Editar</span>
            </a>
            <a 
                href="{{ route('admin.users.index') }}" 
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Volver</span>
            </a>
        </div>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- User Info Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Avatar -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Foto de Perfil</h3>
                @if($user->profile_picture)
                    <img 
                        src="{{ asset('storage/' . $user->profile_picture) }}" 
                        alt="{{ $user->name }}" 
                        class="w-32 h-32 rounded-full object-cover border-4 border-[#34A853] mx-auto"
                    >
                @else
                    <div class="w-32 h-32 rounded-full bg-[#34A853] flex items-center justify-center text-white text-4xl font-bold mx-auto">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <!-- Basic Info -->
            <div class="md:col-span-2 space-y-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Nombre de Usuario</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                </div>

                @if($user->persona)
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Nombre Completo</h3>
                        <p class="text-lg font-semibold text-gray-900">{{ $user->persona->nombres }} {{ $user->persona->apellidos }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">DNI</h3>
                            <p class="text-sm text-gray-700">{{ $user->persona->dni }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Sexo</h3>
                            <p class="text-sm text-gray-700">{{ $user->persona->sexo }}</p>
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                        <p class="text-sm text-yellow-700">⚠️ Este usuario no tiene información personal asociada.</p>
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Email</h3>
                        <p class="text-sm text-gray-700">{{ $user->email }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Rol</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $user->rol === 'Administrador' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $user->rol }}
                        </span>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Estado</h3>
                    @php
                        $estadoColors = [
                            'Activo' => 'bg-green-100 text-green-800',
                            'Inactivo' => 'bg-yellow-100 text-yellow-800',
                            'Eliminado' => 'bg-red-100 text-red-800',
                        ];
                        $color = $estadoColors[$user->status_user] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                        {{ $user->status_user }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="mt-6 pt-6 border-t border-gray-200 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
                <h3 class="text-sm font-medium text-gray-500 mb-1">Fecha de Registro</h3>
                <p class="text-lg font-semibold text-blue-600">{{ $user->created_at->format('d/m/Y') }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
            </div>
            <div class="bg-purple-50 rounded-lg p-4 border-l-4 border-purple-500">
                <h3 class="text-sm font-medium text-gray-500 mb-1">Última Actualización</h3>
                <p class="text-lg font-semibold text-purple-600">{{ $user->updated_at->format('d/m/Y') }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $user->updated_at->diffForHumans() }}</p>
            </div>
            <div class="bg-green-50 rounded-lg p-4 border-l-4 border-[#34A853]">
                <h3 class="text-sm font-medium text-gray-500 mb-1">Email Verificado</h3>
                <p class="text-lg font-semibold text-[#34A853]">
                    {{ $user->email_verified_at ? 'Sí' : 'No' }}
                </p>
                @if($user->email_verified_at)
                    <p class="text-xs text-gray-500 mt-1">{{ $user->email_verified_at->format('d/m/Y') }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Information -->
    @if($user->persona)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Participantes relacionados -->
            @if($user->persona->participantes->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Participaciones ({{ $user->persona->participantes->count() }})
                    </h3>

                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($user->persona->participantes as $participante)
                            <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">
                                            {{ $participante->institucionProyecto->institucion->nombre ?? 'N/A' }}
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            {{ $participante->institucionProyecto->proyecto->nombre ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $participante->nivel_academico }} - {{ $participante->ciclo_o_grado }}° grado
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-[#34A853]">
                                            {{ number_format($participante->puntaje_total, 0) }} pts
                                        </p>
                                        <a 
                                            href="{{ route('admin.participantes.show', $participante) }}" 
                                            class="text-xs text-blue-600 hover:text-blue-800 mt-1 inline-block"
                                        >
                                            Ver detalles →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Información adicional -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Información Adicional
                </h3>

                <div class="space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">ID de Usuario</h4>
                        <p class="text-sm font-mono text-gray-700">{{ $user->id }}</p>
                    </div>

                    @if($user->persona)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">ID de Persona</h4>
                            <p class="text-sm font-mono text-gray-700">{{ $user->persona->id }}</p>
                        </div>
                    @endif

                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Total de Participaciones</h4>
                        <p class="text-2xl font-bold text-[#34A853]">
                            {{ $user->persona ? $user->persona->participantes->count() : 0 }}
                        </p>
                    </div>

                    @if($user->persona && $user->persona->participantes->count() > 0)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Puntaje Total Acumulado</h4>
                            <p class="text-2xl font-bold text-blue-600">
                                {{ number_format($user->persona->participantes->sum('puntaje_total'), 0) }} pts
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

