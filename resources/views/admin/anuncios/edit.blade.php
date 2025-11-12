@extends('layouts.admin')

@section('title', 'Editar Anuncio - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar Anuncio
            </h2>
            <p class="text-gray-600 mt-1">Modifica la información del anuncio</p>
        </div>
        <a 
            href="{{ route('admin.anuncios.index') }}" 
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
    <form action="{{ route('admin.anuncios.update', $anuncio) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            <!-- Institución-Proyecto -->
            <div>
                <label for="institucion_proyecto_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Institución y Proyecto <span class="text-red-500">*</span>
                </label>
                <select 
                    id="institucion_proyecto_id" 
                    name="institucion_proyecto_id" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('institucion_proyecto_id') border-red-500 @enderror"
                >
                    <option value="">Seleccione una institución y proyecto</option>
                    @foreach($institucionesProyectos as $ip)
                        <option value="{{ $ip['id'] }}" {{ old('institucion_proyecto_id', $anuncio->institucion_proyecto_id) == $ip['id'] ? 'selected' : '' }}>
                            {{ $ip['label'] }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_proyecto_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Motivo -->
            <div>
                <label for="motivo" class="block text-sm font-medium text-gray-700 mb-2">
                    Motivo / Título del Anuncio <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="motivo" 
                    name="motivo" 
                    rows="3"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('motivo') border-red-500 @enderror"
                    placeholder="Ingrese el motivo o título del anuncio..."
                >{{ old('motivo', $anuncio->motivo) }}</textarea>
                @error('motivo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha, Hora y Lugar -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha del Evento
                    </label>
                    <input 
                        type="date" 
                        id="fecha" 
                        name="fecha" 
                        value="{{ old('fecha', $anuncio->fecha ? $anuncio->fecha->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha') border-red-500 @enderror"
                    >
                    @error('fecha')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hora" class="block text-sm font-medium text-gray-700 mb-2">
                        Hora del Evento <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="time" 
                        id="hora" 
                        name="hora" 
                        value="{{ old('hora', $anuncio->hora ? (strlen($anuncio->hora) > 5 ? substr($anuncio->hora, 0, 5) : $anuncio->hora) : '') }}"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('hora') border-red-500 @enderror"
                    >
                    @error('hora')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lugar" class="block text-sm font-medium text-gray-700 mb-2">
                        Lugar
                    </label>
                    <input 
                        type="text" 
                        id="lugar" 
                        name="lugar" 
                        value="{{ old('lugar', $anuncio->lugar) }}"
                        placeholder="Ej: Auditorio principal"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('lugar') border-red-500 @enderror"
                    >
                    @error('lugar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
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
                    <option value="Activo" {{ old('estado', $anuncio->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado', $anuncio->estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fechas de Publicación -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="fecha_inicial" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha Inicial de Publicación <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        id="fecha_inicial" 
                        name="fecha_inicial" 
                        value="{{ old('fecha_inicial', $anuncio->fecha_inicial ? $anuncio->fecha_inicial->format('Y-m-d\TH:i') : '') }}"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha_inicial') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-xs text-gray-500">Fecha y hora desde la cual el anuncio estará visible</p>
                    @error('fecha_inicial')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fecha_final" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha Final de Publicación <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        id="fecha_final" 
                        name="fecha_final" 
                        value="{{ old('fecha_final', $anuncio->fecha_final ? $anuncio->fecha_final->format('Y-m-d\TH:i') : '') }}"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('fecha_final') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-xs text-gray-500">Fecha y hora hasta la cual el anuncio estará visible</p>
                    @error('fecha_final')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a 
                href="{{ route('admin.anuncios.index') }}" 
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
            >
                Cancelar
            </a>
            <button 
                type="submit" 
                class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
            >
                Actualizar Anuncio
            </button>
        </div>
    </form>
</div>
@endsection

