@extends('layouts.admin')

@section('title', 'Registrar Recolección - Paso 1 - SEDIECOTECH Rewards')

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
            href="{{ route('admin.recolecciones.index') }}" 
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
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Paso 1 de 4: Seleccione un Proyecto</h3>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-[#34A853] h-2.5 rounded-full" style="width: 25%"></div>
            </div>
            <div class="flex justify-between mt-2 text-xs text-gray-600">
                <span class="font-semibold text-[#34A853]">Proyecto</span>
                <span>Institución</span>
                <span>Participante</span>
                <span>Registrar</span>
            </div>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.recolecciones.create') }}" class="mb-6">
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
                    placeholder="Buscar proyecto (ej. SEDIECOTECH 1.0, EcoCampus...)" 
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
                        href="{{ route('admin.recolecciones.create') }}" 
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                    >
                        Limpiar
                    </a>
                @endif
            </div>
        </form>

        <!-- Projects Grid -->
        @if($proyectos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($proyectos as $proyecto)
                    <a 
                        href="{{ route('admin.recolecciones.paso2-institucion', ['proyecto_id' => $proyecto->id]) }}"
                        class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-[#34A853] hover:shadow-lg transition-all cursor-pointer group"
                    >
                        <div class="flex items-start space-x-4">
                            @if($proyecto->url_logo)
                                <img 
                                    src="{{ asset('storage/' . $proyecto->url_logo) }}" 
                                    alt="{{ $proyecto->nombre }}" 
                                    class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                                >
                            @else
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-green-50 transition-colors">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-[#34A853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-[#34A853] transition-colors">
                                    {{ $proyecto->nombre }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">Proyecto activo</p>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <p class="text-lg font-medium text-gray-500">No se encontraron proyectos</p>
                <p class="text-sm text-gray-400 mt-2">
                    @if($search)
                        No hay proyectos que coincidan con "{{ $search }}"
                    @else
                        No hay proyectos activos disponibles
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection

