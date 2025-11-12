@extends('layouts.admin')

@section('title', 'Editar Premio - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar Premio: {{ $premio->articulo->nombre }}
            </h2>
            <p class="text-gray-600 mt-1">Modifica la información del premio</p>
        </div>
        <a 
            href="{{ route('admin.premios.index') }}" 
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Volver</span>
        </a>
    </div>

    <!-- Messages -->
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <p class="text-red-700 font-medium mb-2">{{ session('error') }}</p>
                    @if(session('error_details'))
                        <div class="bg-white rounded-lg p-3 border border-red-200 mb-3">
                            <p class="text-red-600 text-sm mb-2">{{ session('error_details.message') }}</p>
                            <p class="text-red-500 text-xs mb-3">{{ session('error_details.suggestion') }}</p>
                            @if(session('error_details.premio_id'))
                                <a 
                                    href="{{ route('admin.premios.edit', session('error_details.premio_id')) }}" 
                                    class="inline-flex items-center px-4 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors text-sm"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Ir a editar el premio existente
                                </a>
                            @endif
                        </div>
                        <p class="text-red-600 text-xs">
                            💡 <strong>Tip:</strong> Puedes crear el mismo artículo con un tipo diferente (por ejemplo, 'Canje por puntaje' y 'Canje por Ranking').
                        </p>
                    @endif
                </div>
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

    <!-- Form -->
    <form action="{{ route('admin.premios.update', $premio) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            <!-- Artículo -->
            <div>
                <label for="articulo_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Artículo <span class="text-red-500">*</span>
                </label>
                <select 
                    id="articulo_id" 
                    name="articulo_id" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('articulo_id') border-red-500 @enderror"
                >
                    <option value="">Seleccione un artículo</option>
                    @foreach($articulos as $articulo)
                        <option value="{{ $articulo->id }}" {{ old('articulo_id', $premio->articulo_id) == $articulo->id ? 'selected' : '' }}>
                            {{ $articulo->nombre }} - S/ {{ number_format($articulo->precio, 2) }}
                        </option>
                    @endforeach
                </select>
                @error('articulo_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Institución-Proyecto -->
            <div>
                <label for="institucion_proyecto_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Institución - Proyecto <span class="text-red-500">*</span>
                </label>
                <select 
                    id="institucion_proyecto_id" 
                    name="institucion_proyecto_id" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('institucion_proyecto_id') border-red-500 @enderror"
                >
                    <option value="">Seleccione una institución-proyecto</option>
                    @foreach($institucionesProyectos as $ip)
                        <option value="{{ $ip->id }}" {{ old('institucion_proyecto_id', $premio->institucion_proyecto_id) == $ip->id ? 'selected' : '' }}>
                            {{ $ip->institucion->nombre }} - {{ $ip->proyecto->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_proyecto_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipo -->
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipo de Canje <span class="text-red-500">*</span>
                </label>
                <select 
                    id="tipo" 
                    name="tipo" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('tipo') border-red-500 @enderror"
                >
                    <option value="">Seleccione un tipo</option>
                    <option value="Canje por puntaje" {{ old('tipo', $premio->tipo) === 'Canje por puntaje' ? 'selected' : '' }}>Canje por puntaje</option>
                    <option value="Canje por Ranking" {{ old('tipo', $premio->tipo) === 'Canje por Ranking' ? 'selected' : '' }}>Canje por Ranking</option>
                </select>
                @error('tipo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Puntaje Requerido (solo para Canje por puntaje) -->
            <div id="puntaje-container" style="display: none;">
                <label for="puntaje_requerido" class="block text-sm font-medium text-gray-700 mb-2">
                    Puntaje Requerido <span class="text-red-500">*</span>
                </label>
                <input 
                    type="number" 
                    id="puntaje_requerido" 
                    name="puntaje_requerido" 
                    value="{{ old('puntaje_requerido', $premio->puntaje_requerido) }}" 
                    min="0"
                    step="0.01"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('puntaje_requerido') border-red-500 @enderror"
                    placeholder="0.00"
                >
                @error('puntaje_requerido')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Posición Requerida (solo para Canje por Ranking) -->
            <div id="posicion-container" style="display: none;">
                <label for="posicion_requerida" class="block text-sm font-medium text-gray-700 mb-2">
                    Posición Requerida <span class="text-red-500">*</span>
                </label>
                <input 
                    type="number" 
                    id="posicion_requerida" 
                    name="posicion_requerida" 
                    value="{{ old('posicion_requerida', $premio->posicion_requerida) }}" 
                    min="1"
                    step="1"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('posicion_requerida') border-red-500 @enderror"
                    placeholder="Ej: 1, 2, 3..."
                >
                <p class="mt-1 text-xs text-gray-500">Ingresa la posición en el ranking (1 = primer lugar, 2 = segundo lugar, etc.)</p>
                @error('posicion_requerida')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Estado -->
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
                    <option value="Disponible" {{ old('estado', $premio->estado) === 'Disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="No disponible" {{ old('estado', $premio->estado) === 'No disponible' ? 'selected' : '' }}>No disponible</option>
                </select>
                @error('estado')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a 
                href="{{ route('admin.premios.index') }}" 
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
            >
                Cancelar
            </a>
            <button 
                type="submit" 
                class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
            >
                Actualizar Premio
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipoSelect = document.getElementById('tipo');
        const puntajeContainer = document.getElementById('puntaje-container');
        const posicionContainer = document.getElementById('posicion-container');
        const puntajeInput = document.getElementById('puntaje_requerido');
        const posicionInput = document.getElementById('posicion_requerida');

        function toggleFields() {
            const tipo = tipoSelect.value;
            
            if (tipo === 'Canje por puntaje') {
                puntajeContainer.style.display = 'block';
                posicionContainer.style.display = 'none';
                puntajeInput.setAttribute('required', 'required');
                posicionInput.removeAttribute('required');
            } else if (tipo === 'Canje por Ranking') {
                puntajeContainer.style.display = 'none';
                posicionContainer.style.display = 'block';
                posicionInput.setAttribute('required', 'required');
                puntajeInput.removeAttribute('required');
            } else {
                puntajeContainer.style.display = 'none';
                posicionContainer.style.display = 'none';
                puntajeInput.removeAttribute('required');
                posicionInput.removeAttribute('required');
            }
        }

        tipoSelect.addEventListener('change', toggleFields);
        
        // Ejecutar al cargar la página con el valor actual
        toggleFields();
    });
</script>
@endpush
@endsection

