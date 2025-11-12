@extends('layouts.admin')

@section('title', 'Registrar Recolección - Paso 3 - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Registrar Nueva Recolección
            </h2>
            <p class="text-gray-600 mt-1">Sigue los pasos para registrar una nueva recolección</p>
        </div>
        <a 
            href="{{ route('admin.recolecciones.paso2-institucion', ['proyecto_id' => $proyecto->id]) }}" 
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Volver</span>
        </a>
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

    <!-- Progress Bar -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Paso 3 de 4: Seleccione un Participante</h3>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-[#34A853] h-2.5 rounded-full" style="width: 75%"></div>
            </div>
            <div class="flex justify-between mt-2 text-xs text-gray-600">
                <span class="font-semibold text-[#34A853]">Proyecto</span>
                <span class="font-semibold text-[#34A853]">Institución</span>
                <span class="font-semibold text-[#34A853]">Participante</span>
                <span>Registrar</span>
            </div>
        </div>

        <!-- Selected Project and Institution -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-blue-700 font-medium mb-1">Proyecto seleccionado:</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $proyecto->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-700 font-medium mb-1">Institución seleccionada:</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $institucion->nombre }}</p>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.recolecciones.paso3-participantes') }}" class="mb-6">
            <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
            <input type="hidden" name="institucion_id" value="{{ $institucion->id }}">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}"
                    placeholder="Buscar participante por DNI, nombre o apellidos..." 
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                >
            </div>
            <div class="mt-2 flex items-center space-x-2">
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
                >
                    Buscar
                </button>
                @if($search)
                    <a 
                        href="{{ route('admin.recolecciones.paso3-participantes', ['proyecto_id' => $proyecto->id, 'institucion_id' => $institucion->id]) }}" 
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                    >
                        Limpiar
                    </a>
                @endif
            </div>
        </form>

        <!-- Participants Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Participante</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">DNI</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nivel Académico</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Puntaje Total</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($participantes as $participante)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $participante->persona->dni }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $participante->nivel_academico }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                        {{ number_format($participante->puntaje_total, 2) }} pts
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a 
                                        href="{{ route('admin.recolecciones.paso4-registrar', [
                                            'proyecto_id' => $proyecto->id,
                                            'institucion_id' => $institucion->id,
                                            'participante_id' => $participante->id
                                        ]) }}"
                                        class="inline-flex items-center px-4 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
                                    >
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Registrar Recolección
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No se encontraron participantes</p>
                                    <p class="text-sm mt-2">
                                        @if($search)
                                            No hay participantes que coincidan con "{{ $search }}"
                                        @else
                                            No hay participantes registrados en esta institución para este proyecto
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($participantes->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $participantes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

