@extends('layouts.admin')

@section('title', 'Detalles del Proyecto - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-7xl mx-auto space-y-6" x-data="{ showModalNueva: false }">
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
                    <a href="{{ route('admin.proyectos.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#34A853] md:ml-2">Proyectos</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $proyecto->nombre }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Detalles del Proyecto
            </h2>
            <p class="text-gray-600 mt-1">Información completa del proyecto {{ $proyecto->nombre }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a 
                href="{{ route('admin.proyectos.edit', $proyecto) }}" 
                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors flex items-center space-x-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Editar</span>
            </a>
            <a 
                href="{{ route('admin.proyectos.index') }}" 
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Volver</span>
            </a>
        </div>
    </div>

    <!-- Project Info Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Logo -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Logo del Proyecto</h3>
                @if($proyecto->url_logo)
                    <div class="w-full h-48 border-2 border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                        <img 
                            src="{{ asset('storage/' . $proyecto->url_logo) }}" 
                            alt="{{ $proyecto->nombre }}" 
                            class="max-h-full max-w-full object-contain"
                        >
                    </div>
                @else
                    <div class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-400 text-sm">Sin logo</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Basic Info -->
            <div class="md:col-span-2 space-y-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Nombre del Proyecto</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $proyecto->nombre }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Estado</h3>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $proyecto->estado === 'Activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $proyecto->estado }}
                    </span>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Instituciones Asociadas</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $proyecto->institucionProyectos->count() }} institución(es)</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Fechas del Proyecto</h3>
                    <div class="space-y-1">
                        @php
                            $fechaInicio = $proyecto->institucionProyectos->min('fecha_inicio');
                            $fechaFin = $proyecto->institucionProyectos->whereNotNull('fecha_fin')->max('fecha_fin');
                        @endphp
                        @if($fechaInicio)
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">Inicio más temprano:</span> 
                                {{ $fechaInicio->format('d/m/Y') }}
                            </p>
                        @endif
                        @if($fechaFin)
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">Fin más reciente:</span> 
                                {{ $fechaFin->format('d/m/Y') }}
                            </p>
                        @else
                            <p class="text-sm text-gray-500">Proyecto en curso</p>
                        @endif
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Fecha de Creación</h3>
                    <p class="text-sm text-gray-700">{{ $proyecto->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Última Actualización</h3>
                    <p class="text-sm text-gray-700">{{ $proyecto->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
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

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <p class="text-red-700 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Instituciones Asociadas Section -->
    <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
        <!-- Section Header -->
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Instituciones Asociadas
            </h3>
            <button
                @click="showModalNueva = true"
                class="px-4 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors flex items-center space-x-2 shadow-md hover:shadow-lg"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Nueva Institución</span>
            </button>
        </div>

        <!-- Panel de Métricas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-blue-500">
                <div class="flex-shrink-0 bg-blue-500 rounded-full p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Instituciones</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalInstituciones }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-green-500">
                <div class="flex-shrink-0 bg-green-500 rounded-full p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Participantes</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalParticipantes }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-purple-500">
                <div class="flex-shrink-0 bg-purple-500 rounded-full p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium">Recolecciones</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalRecolecciones }}</p>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="bg-gray-50 rounded-lg p-4">
            <form method="GET" action="{{ route('admin.proyectos.show', $proyecto) }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search_institucion" class="block text-sm font-medium text-gray-700 mb-1">Buscar Institución</label>
                        <input 
                            type="text" 
                            id="search_institucion" 
                            name="search_institucion" 
                            value="{{ $searchInstitucion }}"
                            placeholder="Nombre de la institución..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                    </div>

                    <div>
                        <label for="estado_vinculo" class="block text-sm font-medium text-gray-700 mb-1">Estado del Vínculo</label>
                        <select 
                            id="estado_vinculo" 
                            name="estado_vinculo" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                            <option value="">Todos</option>
                            <option value="Iniciado" {{ $estadoVinculoFilter === 'Iniciado' ? 'selected' : '' }}>Iniciado</option>
                            <option value="En Pausa" {{ $estadoVinculoFilter === 'En Pausa' ? 'selected' : '' }}>En Pausa</option>
                            <option value="Finalizado" {{ $estadoVinculoFilter === 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button 
                            type="submit" 
                            class="w-full px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
                        >
                            Buscar
                        </button>
                        @if($searchInstitucion || $estadoVinculoFilter)
                            <a 
                                href="{{ route('admin.proyectos.show', $proyecto) }}" 
                                class="ml-2 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                            >
                                Limpiar
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Formulario para Asociar Institución Existente -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4" x-data="{ showForm: false }">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-md font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Asociar Institución Existente
                </h4>
                <button 
                    @click="showForm = !showForm"
                    type="button"
                    class="text-blue-600 hover:text-blue-800 transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!showForm">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="showForm" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
            </div>

            <form 
                action="{{ route('admin.proyectos.instituciones.store', $proyecto) }}" 
                method="POST"
                x-show="showForm"
                style="display: none;"
                class="space-y-4"
            >
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="institucion_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Institución <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="institucion_id" 
                            name="institucion_id" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('institucion_id') border-red-500 @enderror"
                        >
                            <option value="">Seleccione una institución</option>
                            @foreach($institucionesDisponibles as $institucion)
                                <option value="{{ $institucion->id }}" {{ old('institucion_id') == $institucion->id ? 'selected' : '' }}>
                                    {{ $institucion->nombre }} - {{ $institucion->nivel }}
                                </option>
                            @endforeach
                        </select>
                        @error('institucion_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if($institucionesDisponibles->isEmpty())
                            <p class="mt-1 text-sm text-yellow-600">No hay instituciones disponibles. Crea una nueva institución.</p>
                        @endif
                    </div>

                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="estado" 
                            name="estado" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('estado') border-red-500 @enderror"
                        >
                            <option value="Iniciado" {{ old('estado', 'Iniciado') === 'Iniciado' ? 'selected' : '' }}>Iniciado</option>
                            <option value="En Pausa" {{ old('estado') === 'En Pausa' ? 'selected' : '' }}>En Pausa</option>
                            <option value="Finalizado" {{ old('estado') === 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha de Inicio <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="fecha_inicio" 
                            name="fecha_inicio" 
                            value="{{ old('fecha_inicio', now()->format('Y-m-d')) }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha_inicio') border-red-500 @enderror"
                        >
                        @error('fecha_inicio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha de Fin (Opcional)
                        </label>
                        <input 
                            type="date" 
                            id="fecha_fin" 
                            name="fecha_fin" 
                            value="{{ old('fecha_fin') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha_fin') border-red-500 @enderror"
                        >
                        @error('fecha_fin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4">
                    <button 
                        type="button"
                        @click="showForm = false"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                    >
                        Cancelar
                    </button>
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
                    >
                        Asociar Institución
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabla de Instituciones -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Institución</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nivel Educativo</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Fechas</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Participantes</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($institucionesProyecto as $institucionProyecto)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $institucionProyecto->institucion->nombre }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $institucionProyecto->institucion->direccion }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $institucionProyecto->institucion->nivel }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $estadoColors = [
                                            'Iniciado' => 'bg-blue-100 text-blue-800',
                                            'En Pausa' => 'bg-yellow-100 text-yellow-800',
                                            'Finalizado' => 'bg-gray-100 text-gray-800',
                                        ];
                                        $color = $estadoColors[$institucionProyecto->estado] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                        {{ $institucionProyecto->estado }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <div>Inicio: {{ $institucionProyecto->fecha_inicio->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">
                                        Fin: {{ $institucionProyecto->fecha_fin ? $institucionProyecto->fecha_fin->format('d/m/Y') : 'En curso' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    <span class="font-semibold">{{ $institucionProyecto->participantes->count() }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a 
                                            href="{{ route('admin.proyectos.instituciones.participantes', [$proyecto, $institucionProyecto]) }}" 
                                            class="text-blue-600 hover:text-blue-900 transition-colors"
                                            title="Ver participantes"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                        </a>
                                        <a 
                                            href="{{ route('admin.proyectos.edit', $proyecto) }}" 
                                            class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                            title="Editar vínculo"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form 
                                            action="{{ route('admin.proyectos.instituciones.destroy', [$proyecto, $institucionProyecto]) }}" 
                                            method="POST" 
                                            class="inline"
                                            onsubmit="return confirm('¿Estás seguro de desvincular esta institución del proyecto?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="text-red-600 hover:text-red-900 transition-colors"
                                                title="Desvincular"
                                            >
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No hay instituciones asociadas</p>
                                    <p class="text-sm mt-2">Asocia una institución existente o crea una nueva para comenzar</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Nueva Institución -->
    <div 
        x-show="showModalNueva"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        @keydown.escape.window="showModalNueva = false"
    >
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div 
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                @click="showModalNueva = false"
            ></div>

            <!-- Modal Panel -->
            <div 
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative z-10"
                @click.stop
            >
                <form 
                    action="{{ route('admin.instituciones.quick-create') }}" 
                    method="POST"
                    class="space-y-6"
                >
                    @csrf
                    <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">

                    <!-- Modal Header -->
                    <div class="bg-[#34A853] px-6 py-4 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Crear Nueva Institución
                        </h3>
                        <button 
                            type="button"
                            @click="showModalNueva = false"
                            class="text-white hover:text-gray-200 transition-colors"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-4 space-y-4">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre de la Institución <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="nombre" 
                                name="nombre" 
                                value="{{ old('nombre') }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('nombre') border-red-500 @enderror"
                                placeholder="Ej: Colegio Nacional San Juan"
                            >
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="direccion" class="block text-sm font-medium text-gray-700 mb-2">
                                Dirección <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="direccion" 
                                name="direccion" 
                                value="{{ old('direccion') }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('direccion') border-red-500 @enderror"
                                placeholder="Ej: Av. Principal 123, Trujillo"
                            >
                            @error('direccion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nivel" class="block text-sm font-medium text-gray-700 mb-2">
                                Nivel Educativo <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="nivel" 
                                name="nivel" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('nivel') border-red-500 @enderror"
                            >
                                <option value="">Seleccione un nivel</option>
                                <option value="Educacion Basica" {{ old('nivel') === 'Educacion Basica' ? 'selected' : '' }}>Educación Básica</option>
                                <option value="Educacion Media Superior" {{ old('nivel') === 'Educacion Media Superior' ? 'selected' : '' }}>Educación Media Superior</option>
                                <option value="Educacion Superior" {{ old('nivel') === 'Educacion Superior' ? 'selected' : '' }}>Educación Superior</option>
                            </select>
                            @error('nivel')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fecha de Inicio <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    id="fecha_inicio" 
                                    name="fecha_inicio" 
                                    value="{{ old('fecha_inicio', now()->format('Y-m-d')) }}"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha_inicio') border-red-500 @enderror"
                                >
                                @error('fecha_inicio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fecha de Fin (Opcional)
                                </label>
                                <input 
                                    type="date" 
                                    id="fecha_fin" 
                                    name="fecha_fin" 
                                    value="{{ old('fecha_fin') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha_fin') border-red-500 @enderror"
                                >
                                @error('fecha_fin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                                    Estado <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    id="estado" 
                                    name="estado" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('estado') border-red-500 @enderror"
                                >
                                    <option value="Iniciado" {{ old('estado', 'Iniciado') === 'Iniciado' ? 'selected' : '' }}>Iniciado</option>
                                    <option value="En Pausa" {{ old('estado') === 'En Pausa' ? 'selected' : '' }}>En Pausa</option>
                                    <option value="Finalizado" {{ old('estado') === 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                </select>
                                @error('estado')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-4">
                        <button 
                            type="button"
                            @click="showModalNueva = false"
                            class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                        >
                            Cancelar
                        </button>
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
                        >
                            Crear y Asociar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


