@extends('layouts.admin')

@section('title', 'Registrar Recolección - Paso 4 - SEDIECOTECH Rewards')

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
            <p class="text-gray-600 mt-1">Completa los datos para registrar la recolección</p>
        </div>
        <a 
            href="{{ route('admin.recolecciones.paso3-participantes', ['proyecto_id' => $proyecto->id, 'institucion_id' => $institucion->id]) }}" 
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Volver</span>
        </a>
    </div>

    <!-- Messages -->
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

    <!-- Progress Bar -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Paso 4 de 4: Registrar Recolección</h3>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-[#34A853] h-2.5 rounded-full" style="width: 100%"></div>
            </div>
            <div class="flex justify-between mt-2 text-xs text-gray-600">
                <span class="font-semibold text-[#34A853]">Proyecto</span>
                <span class="font-semibold text-[#34A853]">Institución</span>
                <span class="font-semibold text-[#34A853]">Participante</span>
                <span class="font-semibold text-[#34A853]">Registrar</span>
            </div>
        </div>

        <!-- Selected Information -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-blue-700 font-medium mb-1">Proyecto:</p>
                    <p class="text-base font-semibold text-gray-900">{{ $proyecto->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-700 font-medium mb-1">Institución:</p>
                    <p class="text-base font-semibold text-gray-900">{{ $institucion->nombre }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-700 font-medium mb-1">Participante:</p>
                    <p class="text-base font-semibold text-gray-900">
                        {{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}
                    </p>
                    <p class="text-xs text-gray-600">DNI: {{ $participante->persona->dni }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.recolecciones.store') }}" method="POST" class="space-y-6" id="recoleccionForm">
        @csrf
        <input type="hidden" name="participante_id" value="{{ $participante->id }}">
        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
        <input type="hidden" name="institucion_id" value="{{ $institucion->id }}">

        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            <!-- Material -->
            <div>
                <label for="material_precio_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Material <span class="text-red-500">*</span>
                </label>
                <select 
                    id="material_precio_id" 
                    name="material_precio_id" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('material_precio_id') border-red-500 @enderror"
                >
                    <option value="">Seleccione un material</option>
                    @foreach($materialesDisponibles as $materialPrecio)
                        <option 
                            value="{{ $materialPrecio->id }}" 
                            data-puntaje="{{ $materialPrecio->puntaje }}"
                            data-precio="{{ $materialPrecio->precio->cantidad_soles }}"
                            {{ old('material_precio_id') == $materialPrecio->id ? 'selected' : '' }}
                        >
                            {{ $materialPrecio->material->nombre }} - S/ {{ number_format($materialPrecio->precio->cantidad_soles, 2) }} por kg - {{ number_format($materialPrecio->puntaje, 2) }} pts/kg
                        </option>
                    @endforeach
                </select>
                @error('material_precio_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cantidad y Cálculo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="cantidad_kilogramos" class="block text-sm font-medium text-gray-700 mb-2">
                        Cantidad (Kilogramos) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="cantidad_kilogramos" 
                        name="cantidad_kilogramos" 
                        value="{{ old('cantidad_kilogramos') }}"
                        step="0.01"
                        min="0.01"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('cantidad_kilogramos') border-red-500 @enderror"
                        placeholder="0.00"
                    >
                    @error('cantidad_kilogramos')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Puntaje Obtenido</label>
                    <div class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg">
                        <p class="text-2xl font-bold text-[#34A853]" id="puntaje-calculado">0.00 pts</p>
                        <p class="text-xs text-gray-500 mt-1">Se calcula automáticamente</p>
                    </div>
                </div>
            </div>

            <!-- Fecha y Estado -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="fecha" 
                        name="fecha" 
                        value="{{ old('fecha', now()->format('Y-m-d')) }}"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha') border-red-500 @enderror"
                    >
                    @error('fecha')
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
                        <option value="Pendiente" {{ old('estado') === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Validado" {{ old('estado', 'Validado') === 'Validado' ? 'selected' : '' }}>Validado</option>
                        <option value="Rechazado" {{ old('estado') === 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Si seleccionas "Validado", el puntaje se sumará automáticamente al participante</p>
                    @error('estado')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a 
                href="{{ route('admin.recolecciones.paso3-participantes', ['proyecto_id' => $proyecto->id, 'institucion_id' => $institucion->id]) }}" 
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
            >
                Cancelar
            </a>
            <button 
                type="submit" 
                class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
            >
                Registrar Recolección
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Calcular puntaje automáticamente
    const materialSelect = document.getElementById('material_precio_id');
    const cantidadInput = document.getElementById('cantidad_kilogramos');
    const puntajeCalculado = document.getElementById('puntaje-calculado');

    function calcularPuntaje() {
        const materialOption = materialSelect.options[materialSelect.selectedIndex];
        const puntajePorKg = parseFloat(materialOption?.dataset.puntaje || 0);
        const cantidad = parseFloat(cantidadInput.value || 0);
        const total = puntajePorKg * cantidad;
        
        puntajeCalculado.textContent = total.toFixed(2) + ' pts';
    }

    materialSelect.addEventListener('change', calcularPuntaje);
    cantidadInput.addEventListener('input', calcularPuntaje);
</script>
@endpush
@endsection

