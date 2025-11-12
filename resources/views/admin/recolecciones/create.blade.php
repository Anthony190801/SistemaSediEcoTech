@extends('layouts.admin')

@section('title', 'Registrar Recolección - SEDIECOTECH Rewards')

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
            <p class="text-gray-600 mt-1">Registra una nueva recolección de material reciclable</p>
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

    <!-- Form -->
    <form action="{{ route('admin.recolecciones.store') }}" method="POST" class="space-y-6" id="recoleccionForm">
        @csrf

        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            @if($participante)
                <!-- Participante pre-cargado (QR) -->
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                    <p class="text-sm text-green-700 font-medium mb-2">Participante identificado por QR:</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $institucionSeleccionada->nombre }} - {{ $proyectoSeleccionado->nombre }}
                    </p>
                    <input type="hidden" name="participante_id" value="{{ $participante->id }}">
                </div>
            @else
                <!-- Selección manual de participante -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="proyecto_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Proyecto <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="proyecto_id" 
                            name="proyecto_id" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                            <option value="">Seleccione un proyecto</option>
                            @foreach($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="institucion_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Institución <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="institucion_id" 
                            name="institucion_id" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                            <option value="">Seleccione una institución</option>
                            @foreach($instituciones as $institucion)
                                <option value="{{ $institucion->id }}">{{ $institucion->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="dni_participante" class="block text-sm font-medium text-gray-700 mb-2">
                            DNI del Participante <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="dni_participante" 
                            name="dni_participante" 
                            placeholder="Ingrese el DNI"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                        <p class="mt-1 text-xs text-gray-500">Buscar participante por DNI</p>
                    </div>
                </div>

                <div id="participante-info" class="hidden bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                    <p class="text-sm text-blue-700 font-medium mb-2">Participante encontrado:</p>
                    <p class="text-lg font-semibold text-gray-900" id="participante-nombre"></p>
                    <input type="hidden" name="participante_id" id="participante_id">
                </div>
            @endif

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
                    @if($materialesDisponibles->count() > 0)
                        @foreach($materialesDisponibles as $materialPrecio)
                            <option 
                                value="{{ $materialPrecio->id }}" 
                                data-puntaje="{{ $materialPrecio->puntaje }}"
                                data-precio="{{ $materialPrecio->precio->cantidad_soles }}"
                            >
                                {{ $materialPrecio->material->nombre }} - S/ {{ number_format($materialPrecio->precio->cantidad_soles, 2) }} por kg - {{ number_format($materialPrecio->puntaje, 2) }} pts/kg
                            </option>
                        @endforeach
                    @endif
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
                href="{{ route('admin.recolecciones.index') }}" 
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

    // Buscar participante por DNI (si no está pre-cargado)
    @if(!$participante)
    const dniInput = document.getElementById('dni_participante');
    const proyectoSelect = document.getElementById('proyecto_id');
    const institucionSelect = document.getElementById('institucion_id');
    const participanteInfo = document.getElementById('participante-info');
    const participanteNombre = document.getElementById('participante-nombre');
    const participanteIdInput = document.getElementById('participante_id');

    dniInput.addEventListener('blur', async function() {
        const dni = dniInput.value.trim();
        const proyectoId = proyectoSelect.value;
        const institucionId = institucionSelect.value;

        if (dni && proyectoId && institucionId) {
            try {
                const response = await fetch(`{{ route('admin.participantes.buscar') }}?dni=${dni}&proyecto_id=${proyectoId}&institucion_id=${institucionId}`);
                const data = await response.json();
                
                if (data.success && data.participante) {
                    participanteNombre.textContent = data.participante.nombre;
                    participanteIdInput.value = data.participante.id;
                    participanteInfo.classList.remove('hidden');
                } else {
                    participanteInfo.classList.add('hidden');
                    alert('Participante no encontrado para este proyecto e institución');
                }
            } catch (error) {
                console.error('Error al buscar participante:', error);
            }
        }
    });

    // Cargar materiales cuando se selecciona un proyecto
    proyectoSelect.addEventListener('change', async function() {
        const proyectoId = proyectoSelect.value;
        const materialSelect = document.getElementById('material_precio_id');
        
        if (proyectoId) {
            try {
                const response = await fetch(`/admin/materiales/por-proyecto?proyecto_id=${proyectoId}`);
                const data = await response.json();
                
                // Limpiar opciones actuales
                materialSelect.innerHTML = '<option value="">Seleccione un material</option>';
                
                // Agregar nuevas opciones
                if (data.materiales && data.materiales.length > 0) {
                    data.materiales.forEach(function(material) {
                        const option = document.createElement('option');
                        option.value = material.id;
                        option.textContent = `${material.nombre} - S/ ${material.precio} por kg - ${material.puntaje} pts/kg`;
                        option.dataset.puntaje = material.puntaje;
                        option.dataset.precio = material.precio;
                        materialSelect.appendChild(option);
                    });
                }
            } catch (error) {
                console.error('Error al cargar materiales:', error);
            }
        } else {
            materialSelect.innerHTML = '<option value="">Seleccione un material</option>';
        }
    });
    @endif
</script>
@endpush
@endsection

