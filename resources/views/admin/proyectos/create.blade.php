@extends('layouts.admin')

@section('title', 'Crear Proyecto - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Crear Nuevo Proyecto
            </h2>
            <p class="text-gray-600 mt-1">Completa el formulario para registrar un nuevo proyecto</p>
        </div>
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
    <form action="{{ route('admin.proyectos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            <!-- Información Básica -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Información Básica
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre del Proyecto <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nombre" 
                            name="nombre" 
                            value="{{ old('nombre') }}" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('nombre') border-red-500 @enderror"
                            placeholder="Ej: SEDIECOTECH 2.0"
                        >
                        @error('nombre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Logo -->
                    <div>
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                            Logo del Proyecto
                        </label>
                        <input 
                            type="file" 
                            id="logo" 
                            name="logo" 
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            onchange="previewLogo(this)"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('logo') border-red-500 @enderror"
                        >
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Formatos: JPEG, PNG, JPG, WEBP (máx. 2MB)</p>
                    </div>

                    <!-- Preview Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Vista Previa
                        </label>
                        <div id="logoPreview" class="w-full h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50">
                            <p class="text-gray-400 text-sm">Selecciona un logo para previsualizar</p>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="md:col-span-2">
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="estado" 
                            name="estado" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('estado') border-red-500 @enderror"
                        >
                            <option value="Activo" {{ old('estado', 'Activo') === 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado') === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Instituciones Asociadas -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Instituciones Asociadas
                    </h3>
                    <button 
                        type="button" 
                        onclick="addInstitucion()"
                        class="px-4 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors flex items-center space-x-2 text-sm"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Agregar Institución</span>
                    </button>
                </div>

                <div id="institucionesContainer" class="space-y-4">
                    <!-- Las instituciones se agregarán dinámicamente aquí -->
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a 
                href="{{ route('admin.proyectos.index') }}" 
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
            >
                Cancelar
            </a>
            <button 
                type="submit" 
                class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
            >
                Crear Proyecto
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const institucionesDisponibles = @json($instituciones);
    let institucionCounter = 0;

    function addInstitucion(institucionData = null) {
        const container = document.getElementById('institucionesContainer');
        const index = institucionCounter++;
        
        const div = document.createElement('div');
        div.className = 'bg-gray-50 rounded-lg p-4 border border-gray-200';
        div.id = `institucion-${index}`;
        
        div.innerHTML = `
            <div class="flex items-start justify-between mb-4">
                <h4 class="font-semibold text-gray-700">Institución ${index + 1}</h4>
                <button 
                    type="button" 
                    onclick="removeInstitucion(${index})"
                    class="text-red-600 hover:text-red-800 transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Institución <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="instituciones[${index}][id]" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Seleccione una institución</option>
                        ${institucionesDisponibles.map(inst => 
                            `<option value="${inst.id}" ${institucionData && institucionData.id == inst.id ? 'selected' : ''}>${inst.nombre}</option>`
                        ).join('')}
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Estado <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="instituciones[${index}][estado]" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="Iniciado" ${institucionData && institucionData.estado === 'Iniciado' ? 'selected' : ''}>Iniciado</option>
                        <option value="En Pausa" ${institucionData && institucionData.estado === 'En Pausa' ? 'selected' : ''}>En Pausa</option>
                        <option value="Finalizado" ${institucionData && institucionData.estado === 'Finalizado' ? 'selected' : ''}>Finalizado</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Inicio <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        name="instituciones[${index}][fecha_inicio]" 
                        value="${institucionData ? institucionData.fecha_inicio : ''}"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Fin (opcional)
                    </label>
                    <input 
                        type="date" 
                        name="instituciones[${index}][fecha_fin]" 
                        value="${institucionData ? institucionData.fecha_fin : ''}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                </div>
            </div>
        `;
        
        container.appendChild(div);
    }

    function removeInstitucion(index) {
        const element = document.getElementById(`institucion-${index}`);
        if (element) {
            element.remove();
        }
    }

    function previewLogo(input) {
        const preview = document.getElementById('logoPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="max-h-full max-w-full object-contain rounded-lg">`;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.innerHTML = '<p class="text-gray-400 text-sm">Selecciona un logo para previsualizar</p>';
        }
    }
</script>
@endpush
@endsection

