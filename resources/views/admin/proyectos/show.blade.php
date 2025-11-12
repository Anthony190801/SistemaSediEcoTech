@extends('layouts.admin')

@section('title', 'Detalles del Proyecto - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
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

    <!-- Associated Institutions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            Instituciones Asociadas
        </h3>

        @if($proyecto->institucionProyectos->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Institución</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nivel</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Estado</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Fecha Inicio</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Fecha Fin</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($proyecto->institucionProyectos as $institucionProyecto)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $institucionProyecto->institucion->nombre }}</div>
                                    <div class="text-xs text-gray-500">{{ $institucionProyecto->institucion->direccion }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $institucionProyecto->institucion->nivel }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
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
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $institucionProyecto->fecha_inicio->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $institucionProyecto->fecha_fin ? $institucionProyecto->fecha_fin->format('d/m/Y') : 'En curso' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <p class="text-gray-500 font-medium">No hay instituciones asociadas</p>
                <p class="text-gray-400 text-sm mt-1">Puedes agregar instituciones editando el proyecto</p>
            </div>
        @endif
    </div>
</div>
@endsection

