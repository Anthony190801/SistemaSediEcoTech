@extends('layouts.admin')

@section('title', 'Editar Participante - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar Participante: {{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}
            </h2>
            <p class="text-gray-600 mt-1">Modifica la información del participante</p>
        </div>
        <a 
            href="{{ route('admin.participantes.show', $participante) }}" 
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
    <form action="{{ route('admin.participantes.update', $participante) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            <!-- Información Personal (Solo lectura) -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Información Personal
                </h3>
                <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nombre Completo</p>
                            <p class="text-gray-900">{{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">DNI</p>
                            <p class="text-gray-900">{{ $participante->persona->dni }}</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Esta información no se puede modificar desde aquí.</p>
                </div>
            </div>

            <!-- Información Académica -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Información Académica
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Institución-Proyecto -->
                    <div class="md:col-span-2">
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
                                <option value="{{ $ip['id'] }}" {{ old('institucion_proyecto_id', $participante->institucion_proyecto_id) == $ip['id'] ? 'selected' : '' }}>
                                    {{ $ip['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('institucion_proyecto_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nivel Académico -->
                    <div>
                        <label for="nivel_academico" class="block text-sm font-medium text-gray-700 mb-2">
                            Nivel Académico <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nivel_academico" 
                            name="nivel_academico" 
                            value="{{ old('nivel_academico', $participante->nivel_academico) }}" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('nivel_academico') border-red-500 @enderror"
                            placeholder="Ej: Primaria, Secundaria, Superior"
                        >
                        @error('nivel_academico')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ciclo o Grado -->
                    <div>
                        <label for="ciclo_o_grado" class="block text-sm font-medium text-gray-700 mb-2">
                            Ciclo o Grado
                        </label>
                        <input 
                            type="text" 
                            id="ciclo_o_grado" 
                            name="ciclo_o_grado" 
                            value="{{ old('ciclo_o_grado', $participante->ciclo_o_grado) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('ciclo_o_grado') border-red-500 @enderror"
                            placeholder="Ej: 3er grado, 5to ciclo"
                        >
                        @error('ciclo_o_grado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Aula -->
                    <div>
                        <label for="aula" class="block text-sm font-medium text-gray-700 mb-2">
                            Aula
                        </label>
                        <input 
                            type="text" 
                            id="aula" 
                            name="aula" 
                            value="{{ old('aula', $participante->aula) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('aula') border-red-500 @enderror"
                            placeholder="Ej: A-101"
                        >
                        @error('aula')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Año -->
                    <div>
                        <label for="anio" class="block text-sm font-medium text-gray-700 mb-2">
                            Año
                        </label>
                        <input 
                            type="number" 
                            id="anio" 
                            name="anio" 
                            value="{{ old('anio', $participante->anio) }}" 
                            min="2000"
                            max="2100"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('anio') border-red-500 @enderror"
                            placeholder="Ej: 2025"
                        >
                        @error('anio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Puntaje Total -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    Puntaje Total
                </h3>
                <div>
                    <label for="puntaje_total" class="block text-sm font-medium text-gray-700 mb-2">
                        Puntaje Total (opcional)
                    </label>
                    <input 
                        type="number" 
                        id="puntaje_total" 
                        name="puntaje_total" 
                        value="{{ old('puntaje_total', $participante->puntaje_total) }}" 
                        min="0"
                        step="0.01"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('puntaje_total') border-red-500 @enderror"
                        placeholder="0.00"
                    >
                    @error('puntaje_total')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Puede modificar el puntaje total manualmente si es necesario.</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a 
                href="{{ route('admin.participantes.show', $participante) }}" 
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
            >
                Cancelar
            </a>
            <button 
                type="submit" 
                class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
            >
                Actualizar Participante
            </button>
        </div>
    </form>
</div>
@endsection

