@extends('layouts.participant')

@section('title', 'Historial de Canjes - SEDIECOTECH Rewards')

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Mis Canjes</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            Historial de Canjes
        </h2>
        <p class="text-gray-600 mt-1">Revisa todos los premios que has canjeado</p>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <form method="GET" action="{{ route('participant.canjes') }}" class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
            <div class="flex-1">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}"
                    placeholder="Buscar por nombre del premio..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                >
            </div>
            <div class="flex items-center space-x-2">
                <label for="orden" class="text-sm font-medium text-gray-700">Orden:</label>
                <select 
                    name="orden" 
                    id="orden"
                    onchange="this.form.submit()"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                >
                    <option value="desc" {{ $orden === 'desc' ? 'selected' : '' }}>Más recientes</option>
                    <option value="asc" {{ $orden === 'asc' ? 'selected' : '' }}>Más antiguos</option>
                </select>
            </div>
            <button 
                type="submit"
                class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
            >
                Buscar
            </button>
        </form>
    </div>

    <!-- Tabla de Canjes -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        @if($canjes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Premio</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Puntaje Requerido</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Fecha del Canje</th>
                            <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Estado</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Proyecto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($canjes as $canje)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        @if($canje->premio->articulo->url_foto)
                                            <img src="{{ asset('storage/' . $canje->premio->articulo->url_foto) }}" alt="{{ $canje->premio->articulo->nombre }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $canje->premio->articulo->nombre }}</p>
                                            <p class="text-xs text-gray-500">{{ $canje->premio->institucionProyecto->institucion->nombre }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="font-bold text-[#34A853]">{{ number_format($canje->premio->puntaje_requerido ?? $canje->premio->posicion_requerida ?? 0, 0) }}</span>
                                </td>
                                <td class="py-4 px-4 text-center text-gray-700">
                                    {{ $canje->fecha_solicitud_canje->format('d/m/Y') }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($canje->estado === 'Entregado')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Entregado</span>
                                    @elseif($canje->estado === 'En proceso')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">En proceso</span>
                                    @elseif($canje->estado === 'Cancelado')
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Cancelado</span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">{{ $canje->estado }}</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-gray-700">
                                    {{ $canje->premio->institucionProyecto->proyecto->nombre }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $canjes->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No has realizado ningún canje aún</h3>
                <p class="text-gray-500 mb-4">Cuando canjees un premio, aparecerá aquí.</p>
                <a href="{{ route('participant.premios') }}" class="inline-block px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors">
                    Ver Premios Disponibles
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

