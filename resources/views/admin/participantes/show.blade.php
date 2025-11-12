@extends('layouts.admin')

@section('title', 'Detalles del Participante - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Detalles del Participante
            </h2>
            <p class="text-gray-600 mt-1">Información completa de {{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a 
                href="{{ route('admin.participantes.edit', $participante) }}" 
                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors flex items-center space-x-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Editar</span>
            </a>
            <a 
                href="{{ route('admin.participantes.index') }}" 
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

    <!-- Participant Info Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Avatar -->
            <div class="md:col-span-1">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Foto del Participante</h3>
                <div class="w-32 h-32 rounded-full bg-[#34A853] flex items-center justify-center text-white text-4xl font-bold mx-auto">
                    {{ strtoupper(substr($participante->persona->nombres, 0, 1)) }}{{ strtoupper(substr($participante->persona->apellidos, 0, 1)) }}
                </div>
            </div>

            <!-- Basic Info -->
            <div class="md:col-span-2 space-y-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Nombre Completo</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">DNI</h3>
                        <p class="text-sm text-gray-700">{{ $participante->persona->dni }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Sexo</h3>
                        <p class="text-sm text-gray-700">{{ $participante->persona->sexo }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Nivel Académico</h3>
                        <p class="text-sm text-gray-700">{{ $participante->nivel_academico }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Ciclo/Grado</h3>
                        <p class="text-sm text-gray-700">{{ $participante->ciclo_o_grado ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Aula</h3>
                        <p class="text-sm text-gray-700">{{ $participante->aula ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Año</h3>
                        <p class="text-sm text-gray-700">{{ $participante->anio ?? 'N/A' }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Institución</h3>
                    <p class="text-sm text-gray-700">{{ $participante->institucionProyecto->institucion->nombre }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Proyecto</h3>
                    <p class="text-sm text-gray-700">{{ $participante->institucionProyecto->proyecto->nombre }}</p>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="mt-6 pt-6 border-t border-gray-200 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-green-50 rounded-lg p-4 border-l-4 border-[#34A853]">
                <h3 class="text-sm font-medium text-gray-500 mb-1">Puntaje Total</h3>
                <p class="text-2xl font-bold text-[#34A853]">{{ number_format($participante->puntaje_total, 0) }} pts</p>
            </div>
            <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
                <h3 class="text-sm font-medium text-gray-500 mb-1">Ranking</h3>
                <p class="text-2xl font-bold text-blue-600">#{{ $ranking }} de {{ $totalParticipantes }}</p>
            </div>
            <div class="bg-purple-50 rounded-lg p-4 border-l-4 border-purple-500">
                <h3 class="text-sm font-medium text-gray-500 mb-1">UUID</h3>
                <p class="text-sm font-mono text-purple-600">{{ $participante->uuid }}</p>
            </div>
        </div>
    </div>

    <!-- History Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recolecciones -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Historial de Recolecciones
            </h3>

            @if($participante->recolecciones->count() > 0)
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @foreach($participante->recolecciones->sortByDesc('fecha') as $recoleccion)
                        <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">
                                        {{ $recoleccion->materialPrecio->material->nombre ?? 'Material no disponible' }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ number_format($recoleccion->cantidad_kilogramos, 2) }} kg
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $recoleccion->fecha->format('d/m/Y') }}
                                    </p>
                                </div>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $recoleccion->estado === 'Validado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $recoleccion->estado }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="text-gray-500 text-sm">No hay recolecciones registradas</p>
                </div>
            @endif
        </div>

        <!-- Canjes -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
                Historial de Canjes
            </h3>

            @if($participante->canjes->count() > 0)
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @foreach($participante->canjes->sortByDesc('fecha_solicitud_canje') as $canje)
                        <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">
                                        {{ $canje->premio->articulo->nombre ?? 'Premio no disponible' }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Solicitud: {{ $canje->fecha_solicitud_canje->format('d/m/Y') }}
                                    </p>
                                    @if($canje->fecha_entrega)
                                        <p class="text-sm text-gray-600 mt-1">
                                            Entrega: {{ $canje->fecha_entrega->format('d/m/Y H:i') }}
                                        </p>
                                    @endif
                                </div>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $canje->estado === 'Entregado' ? 'bg-green-100 text-green-800' : 
                                       ($canje->estado === 'Pendiente' ? 'bg-yellow-100 text-yellow-800' : 
                                       'bg-gray-100 text-gray-800') }}">
                                    {{ $canje->estado }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    <p class="text-gray-500 text-sm">No hay canjes registrados</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

