@extends('layouts.admin')

@section('title', 'Registrar Recolección - Paso 2 - SEDIECOTECH Rewards')

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
            href="{{ route('admin.recolecciones.create') }}" 
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Volver</span>
        </a>
    </div>

    <!-- Progress Bar -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Paso 2 de 4: Seleccione una Institución</h3>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-[#34A853] h-2.5 rounded-full" style="width: 50%"></div>
            </div>
            <div class="flex justify-between mt-2 text-xs text-gray-600">
                <span class="font-semibold text-[#34A853]">Proyecto</span>
                <span class="font-semibold text-[#34A853]">Institución</span>
                <span>Participante</span>
                <span>Registrar</span>
            </div>
        </div>

        <!-- Selected Project -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
            <p class="text-sm text-blue-700 font-medium mb-1">Proyecto seleccionado:</p>
            <p class="text-lg font-semibold text-gray-900">{{ $proyecto->nombre }}</p>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.recolecciones.paso2-institucion') }}" class="mb-6">
            <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
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
                    placeholder="Buscar institución (ej. I.E. San Juan, Universidad...)" 
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
                        href="{{ route('admin.recolecciones.paso2-institucion', ['proyecto_id' => $proyecto->id]) }}" 
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                    >
                        Limpiar
                    </a>
                @endif
            </div>
        </form>

        <!-- Institutions Grid -->
        @if($instituciones->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($instituciones as $institucion)
                    <a 
                        href="{{ route('admin.recolecciones.paso3-participantes', ['proyecto_id' => $proyecto->id, 'institucion_id' => $institucion->id]) }}"
                        class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-[#34A853] hover:shadow-lg transition-all cursor-pointer group"
                    >
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-green-50 transition-colors">
                                <svg class="w-8 h-8 text-blue-500 group-hover:text-[#34A853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-[#34A853] transition-colors">
                                    {{ $institucion->nombre }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $institucion->nivel_academico ?? 'Institución educativa' }}</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#34A853] transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <p class="text-lg font-medium text-gray-500">No se encontraron instituciones</p>
                <p class="text-sm text-gray-400 mt-2">
                    @if($search)
                        No hay instituciones que coincidan con "{{ $search }}" vinculadas a este proyecto con estado 'Iniciado'
                    @else
                        No hay instituciones vinculadas a este proyecto con estado 'Iniciado'
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection

