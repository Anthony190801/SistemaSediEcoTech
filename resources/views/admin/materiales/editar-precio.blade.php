@extends('layouts.admin')

@section('title', 'Editar Configuración de Precio - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar Configuración de Precio
            </h2>
            <p class="text-gray-600 mt-1">Material: <strong>{{ $material->nombre }}</strong></p>
        </div>
        <a 
            href="{{ route('admin.materiales.edit', $material) }}" 
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

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <p class="text-red-700 font-medium mb-2">Por favor, corrige los siguientes errores:</p>
                    <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Formulario de Edición -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.materiales.actualizar-precio', ['material' => $material->id, 'materialPrecio' => $materialPrecio->id]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Precio -->
                <div>
                    <label for="cantidad_soles" class="block text-sm font-medium text-gray-700 mb-2">
                        Precio (S/) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="cantidad_soles" 
                        name="cantidad_soles" 
                        value="{{ old('cantidad_soles', $materialPrecio->precio->cantidad_soles) }}"
                        step="0.01"
                        min="0.01"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('cantidad_soles') border-red-500 @enderror"
                        placeholder="0.00"
                    >
                    @error('cantidad_soles')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Puntaje -->
                <div>
                    <label for="puntaje" class="block text-sm font-medium text-gray-700 mb-2">
                        Puntaje por Kilogramo <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="puntaje" 
                        name="puntaje" 
                        value="{{ old('puntaje', $materialPrecio->puntaje) }}"
                        step="0.01"
                        min="0.01"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('puntaje') border-red-500 @enderror"
                        placeholder="0.00"
                    >
                    <p class="mt-1 text-xs text-gray-500">Puntos que se otorgan por cada kilogramo reciclado</p>
                    @error('puntaje')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Fechas de Vigencia -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Inicio <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="fecha_inicio" 
                        name="fecha_inicio" 
                        value="{{ old('fecha_inicio', $materialPrecio->fecha_inicio?->format('Y-m-d')) }}"
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
                        value="{{ old('fecha_fin', $materialPrecio->fecha_fin?->format('Y-m-d')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha_fin') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-xs text-gray-500">Dejar vacío si no tiene fecha de finalización</p>
                    @error('fecha_fin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Proyectos -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Proyectos para esta Configuración <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-gray-500 mb-3">Selecciona los proyectos donde este precio y puntaje estarán activos</p>
                
                @php
                    $proyectosActuales = $materialPrecio->proyectos->pluck('id')->toArray();
                    $otrosPreciosActivos = $material->materialPrecios()
                        ->where('id', '!=', $materialPrecio->id)
                        ->where('fecha_inicio', '<=', now())
                        ->where(function ($q) {
                            $q->whereNull('fecha_fin')
                                ->orWhere('fecha_fin', '>=', now());
                        })
                        ->with('proyectos')
                        ->get()
                        ->pluck('proyectos')
                        ->flatten()
                        ->pluck('id')
                        ->unique()
                        ->toArray();
                @endphp
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 border border-gray-300 rounded-lg p-4 max-h-60 overflow-y-auto">
                    @foreach($proyectos as $proyecto)
                        @php
                            $yaTieneOtroPrecio = in_array($proyecto->id, $otrosPreciosActivos);
                            $esProyectoActual = in_array($proyecto->id, $proyectosActuales);
                        @endphp
                        <label class="flex items-center space-x-2 {{ $yaTieneOtroPrecio && !$esProyectoActual ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:bg-gray-50' }} p-2 rounded">
                            <input 
                                type="checkbox" 
                                name="proyectos[]" 
                                value="{{ $proyecto->id }}"
                                {{ in_array($proyecto->id, old('proyectos', $proyectosActuales)) ? 'checked' : '' }}
                                {{ $yaTieneOtroPrecio && !$esProyectoActual ? 'disabled' : '' }}
                                class="rounded border-gray-300 text-[#34A853] focus:ring-[#34A853]"
                            >
                            <span class="text-sm text-gray-700">
                                {{ $proyecto->nombre }}
                                @if($yaTieneOtroPrecio && !$esProyectoActual)
                                    <span class="text-xs text-orange-600 font-semibold">(Ya tiene otro precio)</span>
                                @endif
                            </span>
                        </label>
                    @endforeach
                </div>
                @if(count($otrosPreciosActivos) > 0)
                    <p class="mt-2 text-xs text-orange-600">
                        <strong>Nota:</strong> Los proyectos marcados ya tienen otra configuración de precio activa. Puedes mantener los proyectos actuales o cambiarlos, pero no puedes agregar proyectos que ya tienen precio asignado.
                    </p>
                @endif
                @error('proyectos')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-4">
                <a 
                    href="{{ route('admin.materiales.edit', $material) }}" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                >
                    Cancelar
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
                >
                    Actualizar Configuración
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

