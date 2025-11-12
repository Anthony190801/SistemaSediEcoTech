@extends('layouts.admin')

@section('title', 'Gestión de Canjes - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                Gestión de Canjes
            </h2>
            <p class="text-gray-600 mt-1">Administra los canjes de premios realizados por los participantes</p>
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

    <!-- Statistics Panel -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-blue-500">
            <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Canjes</p>
                <p class="text-2xl font-bold text-gray-900">{{ $estadisticas['total'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-yellow-500">
            <div class="flex-shrink-0 bg-yellow-100 rounded-full p-3">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Pendientes</p>
                <p class="text-2xl font-bold text-gray-900">{{ $estadisticas['pendientes'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-purple-500">
            <div class="flex-shrink-0 bg-purple-100 rounded-full p-3">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Programados</p>
                <p class="text-2xl font-bold text-gray-900">{{ $estadisticas['programados'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-green-500">
            <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Entregados</p>
                <p class="text-2xl font-bold text-gray-900">{{ $estadisticas['entregados'] }}</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <form method="GET" action="{{ route('admin.canjes.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Filtro por Estado -->
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select 
                        id="estado" 
                        name="estado" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        <option value="Pendiente" {{ $estado === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Programado" {{ $estado === 'Programado' ? 'selected' : '' }}>Programado</option>
                        <option value="Entregado" {{ $estado === 'Entregado' ? 'selected' : '' }}>Entregado</option>
                    </select>
                </div>

                <!-- Filtro por Institución -->
                <div>
                    <label for="institucion_id" class="block text-sm font-medium text-gray-700 mb-1">Institución</label>
                    <select 
                        id="institucion_id" 
                        name="institucion_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todas</option>
                        @foreach($instituciones as $institucion)
                            <option value="{{ $institucion->id }}" {{ $institucion_id == $institucion->id ? 'selected' : '' }}>
                                {{ $institucion->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Proyecto -->
                <div>
                    <label for="proyecto_id" class="block text-sm font-medium text-gray-700 mb-1">Proyecto</label>
                    <select 
                        id="proyecto_id" 
                        name="proyecto_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        @foreach($proyectos as $proyecto)
                            <option value="{{ $proyecto->id }}" {{ $proyecto_id == $proyecto->id ? 'selected' : '' }}>
                                {{ $proyecto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Fecha Desde -->
                <div>
                    <label for="fecha_desde" class="block text-sm font-medium text-gray-700 mb-1">Desde</label>
                    <input 
                        type="date" 
                        id="fecha_desde" 
                        name="fecha_desde" 
                        value="{{ $fecha_desde }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                </div>

                <!-- Filtro por Fecha Hasta -->
                <div>
                    <label for="fecha_hasta" class="block text-sm font-medium text-gray-700 mb-1">Hasta</label>
                    <input 
                        type="date" 
                        id="fecha_hasta" 
                        name="fecha_hasta" 
                        value="{{ $fecha_hasta }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
                >
                    Buscar
                </button>
                @if($estado || $proyecto_id || $institucion_id || $fecha_desde || $fecha_hasta)
                    <a 
                        href="{{ route('admin.canjes.index') }}" 
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                    >
                        Limpiar
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Canjes Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Participante</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Institución - Proyecto</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Premio</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Fecha Solicitud</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($canjes as $canje)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $canje->participante->persona->nombres }} {{ $canje->participante->persona->apellidos }}
                                </div>
                                <div class="text-xs text-gray-500">DNI: {{ $canje->participante->persona->dni }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <div>{{ $canje->participante->institucionProyecto->institucion->nombre }}</div>
                                <div class="text-xs text-gray-500">{{ $canje->participante->institucionProyecto->proyecto->nombre }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $canje->premio->articulo->nombre }}</div>
                                <div class="text-xs text-gray-500">
                                    @if($canje->premio->tipo === 'Canje por puntaje')
                                        {{ number_format($canje->premio->puntaje_requerido ?? 0, 0) }} pts
                                    @else
                                        Posición #{{ $canje->premio->posicion_requerida ?? 'N/A' }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $canje->fecha_solicitud_canje->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $estadoColors = [
                                        'Pendiente' => 'bg-yellow-100 text-yellow-800',
                                        'Programado' => 'bg-purple-100 text-purple-800',
                                        'Entregado' => 'bg-green-100 text-green-800',
                                    ];
                                    $color = $estadoColors[$canje->estado] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                    {{ $canje->estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a 
                                    href="{{ route('admin.canjes.show', $canje) }}" 
                                    class="text-blue-600 hover:text-blue-900 transition-colors"
                                    title="Ver detalles"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                <p class="text-lg font-medium">No se encontraron canjes</p>
                                <p class="text-sm mt-2">Intenta ajustar los filtros de búsqueda</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($canjes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $canjes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

