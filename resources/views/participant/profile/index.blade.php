@extends('layouts.participant')

@section('title', 'Mi Perfil - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumbs -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('participant.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#34A853]">
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Mi Perfil</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Mi Perfil
        </h2>
        <p class="text-gray-600 mt-1">Gestiona tu información personal y credenciales</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Editar Perfil -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Información Personal -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Información Personal
                </h3>

                <form action="{{ route('participant.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Foto de Perfil -->
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-[#34A853]">
                            @else
                                <div class="w-24 h-24 rounded-full bg-[#34A853] flex items-center justify-center text-white text-3xl font-bold border-4 border-green-200">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto de Perfil
                            </label>
                            <input 
                                type="file" 
                                id="profile_picture" 
                                name="profile_picture" 
                                accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#34A853] file:text-white hover:file:bg-green-600 transition-colors"
                            >
                            <p class="mt-1 text-xs text-gray-500">JPG, PNG o GIF. Máximo 2MB.</p>
                            @error('profile_picture')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre Completo <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('name') border-red-500 @enderror"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Correo Electrónico <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Información de Persona (Solo lectura) -->
                    <div class="pt-4 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3">Información Personal</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">DNI</label>
                                <p class="text-gray-900">{{ $participante->persona->dni }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nombres</label>
                                <p class="text-gray-900">{{ $participante->persona->nombres }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
                                <p class="text-gray-900">{{ $participante->persona->apellidos }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
                                <p class="text-gray-900">{{ $participante->persona->sexo }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Información Académica (Solo lectura) -->
                    <div class="pt-4 border-t border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3">Información Académica Actual</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nivel Académico</label>
                                <p class="text-gray-900">{{ $participante->nivel_academico }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Grado/Ciclo</label>
                                <p class="text-gray-900">{{ $participante->ciclo_o_grado }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Aula</label>
                                <p class="text-gray-900">{{ $participante->aula }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
                                <p class="text-gray-900">{{ $participante->anio }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Botón Guardar -->
                    <div class="pt-4 border-t border-gray-200">
                        <button 
                            type="submit"
                            class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg flex items-center space-x-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Guardar Cambios</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Cambiar Contraseña
                </h3>

                <form action="{{ route('participant.profile.password') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Contraseña Actual -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Contraseña Actual <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="current_password" 
                            name="current_password" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('current_password') border-red-500 @enderror"
                        >
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nueva Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Nueva Contraseña <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('password') border-red-500 @enderror"
                        >
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Mínimo 8 caracteres.</p>
                    </div>

                    <!-- Confirmar Nueva Contraseña -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirmar Nueva Contraseña <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                    </div>

                    <!-- Botón Cambiar Contraseña -->
                    <div class="pt-4 border-t border-gray-200">
                        <button 
                            type="submit"
                            class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg flex items-center space-x-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Cambiar Contraseña</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-[#34A853] to-green-600 rounded-xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-bold mb-4">Resumen</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-green-100">Puntaje Actual</p>
                        <p class="text-3xl font-bold">{{ number_format($participante->puntaje_total, 0) }}</p>
                    </div>
                    <div class="pt-3 border-t border-green-400">
                        <p class="text-sm text-green-100">Proyectos Participados</p>
                        <p class="text-2xl font-bold">{{ $historialProyectos->count() }}</p>
                    </div>
                    <div class="pt-3 border-t border-green-400">
                        <p class="text-sm text-green-100">Institución</p>
                        <p class="text-lg font-semibold">{{ $participante->institucionProyecto->institucion->nombre }}</p>
                    </div>
                    <div class="pt-3 border-t border-green-400">
                        <p class="text-sm text-green-100">Proyecto Actual</p>
                        <p class="text-lg font-semibold">{{ $participante->institucionProyecto->proyecto->nombre }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historial de Participación en Proyectos -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Historial de Participación en Proyectos
        </h2>

        @if($historialProyectos->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Proyecto</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Institución</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Puntaje Obtenido</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Estado</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historialProyectos as $historial)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 {{ $historial->id === $participante->id ? 'bg-green-50' : '' }}">
                                <td class="py-3 px-4 text-gray-800 font-medium">
                                    {{ $historial->institucionProyecto->proyecto->nombre }}
                                    @if($historial->id === $participante->id)
                                        <span class="ml-2 text-xs bg-[#34A853] text-white px-2 py-1 rounded">Actual</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-gray-700">
                                    {{ $historial->institucionProyecto->institucion->nombre }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span class="font-semibold text-[#34A853]">{{ number_format($historial->puntaje_total, 0) }}</span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @php
                                        $estadoProyecto = $historial->institucionProyecto->proyecto->estado;
                                    @endphp
                                    @if($estadoProyecto === 'Activo')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Activo</span>
                                    @elseif($estadoProyecto === 'Finalizado')
                                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">Finalizado</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">{{ $estadoProyecto }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center text-sm text-gray-600">
                                    {{ $historial->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">No hay historial de participación disponible.</p>
            </div>
        @endif
    </div>
</div>
@endsection

