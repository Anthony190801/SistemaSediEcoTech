@extends('layouts.admin')

@section('title', 'Participantes - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-7xl mx-auto space-y-6" x-data="{ showModalNuevo: {{ $errors->any() ? 'true' : 'false' }} }">
    <!-- Breadcrumbs -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#34A853]">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('admin.proyectos.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#34A853] md:ml-2">Proyectos</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('admin.proyectos.show', $proyecto) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#34A853] md:ml-2">{{ $proyecto->nombre }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $institucionProyecto->institucion->nombre }}</span>
                </div>
            </li>
        </ol>
    </nav>

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

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Participantes
            </h2>
            <p class="text-gray-600 mt-1">
                {{ $institucionProyecto->institucion->nombre }} - {{ $proyecto->nombre }}
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <button
                @click="showModalNuevo = true"
                class="px-4 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors flex items-center space-x-2 shadow-md hover:shadow-lg"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Agregar Participante</span>
            </button>
            <a 
                href="{{ route('admin.proyectos.show', $proyecto) }}" 
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Volver</span>
            </a>
        </div>
    </div>

    <!-- Filtros y Búsqueda -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <form method="GET" action="{{ route('admin.proyectos.instituciones.participantes', [$proyecto, $institucionProyecto]) }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                    <input 
                        type="text" 
                        id="search" 
                        name="search" 
                        value="{{ $search }}"
                        placeholder="Nombre, apellidos o DNI..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                </div>

                <div>
                    <label for="nivel_academico" class="block text-sm font-medium text-gray-700 mb-1">Nivel Académico</label>
                    <select 
                        id="nivel_academico" 
                        name="nivel_academico" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        @foreach($nivelesAcademicos as $nivel)
                            <option value="{{ $nivel }}" {{ $nivel_academico === $nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button 
                        type="submit" 
                        class="w-full px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
                    >
                        Buscar
                    </button>
                    @if($search || $nivel_academico)
                        <a 
                            href="{{ route('admin.proyectos.instituciones.participantes', [$proyecto, $institucionProyecto]) }}" 
                            class="ml-2 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                        >
                            Limpiar
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Tabla de Participantes -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Participante</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">DNI</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nivel Académico</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Ciclo/Grado</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aula</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Puntaje</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($participantes as $participante)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $participante->ciclo_o_grado }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $participante->aula }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <span class="font-semibold text-[#34A853]">{{ number_format($participante->puntaje_total, 0) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a 
                                        href="{{ route('admin.participantes.show', ['participante' => $participante, 'return_to' => route('admin.proyectos.instituciones.participantes', [$proyecto, $institucionProyecto])]) }}" 
                                        class="text-blue-600 hover:text-blue-900 transition-colors"
                                        title="Ver detalles"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <form 
                                        action="{{ route('admin.proyectos.instituciones.participantes.destroy', [$proyecto, $institucionProyecto, $participante]) }}" 
                                        method="POST" 
                                        class="inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este participante?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors"
                                            title="Eliminar"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="text-lg font-medium">No hay participantes registrados</p>
                                <p class="text-sm mt-2">Agrega un participante para comenzar</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        @if($participantes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $participantes->links() }}
            </div>
        @endif
    </div>

    <!-- Modal para Agregar Participante -->
    <div 
        x-show="showModalNuevo"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        @keydown.escape.window="showModalNuevo = false"
    >
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div 
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                @click="showModalNuevo = false"
            ></div>

            <!-- Modal Panel -->
            <div 
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative z-10"
                @click.stop
            >
                <form 
                    action="{{ route('admin.proyectos.instituciones.participantes.store', [$proyecto, $institucionProyecto]) }}" 
                    method="POST"
                    class="space-y-6"
                >
                    @csrf
                    <input type="hidden" name="institucion_proyecto_id" value="{{ $institucionProyecto->id }}">

                    <!-- Modal Header -->
                    <div class="bg-[#34A853] px-6 py-4 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Agregar Participante
                        </h3>
                        <button 
                            type="button"
                            @click="showModalNuevo = false"
                            class="text-white hover:text-gray-200 transition-colors"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-4 space-y-4">
                        @if($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-4">
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
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="persona_id" class="block text-sm font-medium text-gray-700">
                                    Persona <span class="text-red-500">*</span>
                                </label>
                                <a 
                                    href="{{ route('admin.users.create') }}" 
                                    target="_blank"
                                    class="text-sm text-[#34A853] hover:text-green-700 font-medium flex items-center space-x-1"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>Crear nueva persona</span>
                                </a>
                            </div>
                            <select 
                                id="persona_id" 
                                name="persona_id" 
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('persona_id') border-red-500 @enderror"
                            >
                                <option value="">Seleccione una persona</option>
                                @foreach($personasDisponibles as $persona)
                                    <option value="{{ $persona->id }}" {{ old('persona_id') == $persona->id ? 'selected' : '' }}>
                                        {{ $persona->nombres }} {{ $persona->apellidos }} - DNI: {{ $persona->dni }}
                                    </option>
                                @endforeach
                            </select>
                            @error('persona_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @if($personasDisponibles->isEmpty())
                                <p class="mt-1 text-sm text-yellow-600">No hay personas disponibles. Crea una nueva persona usando el enlace de arriba.</p>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nivel_academico" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nivel Académico <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    id="nivel_academico" 
                                    name="nivel_academico" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('nivel_academico') border-red-500 @enderror"
                                >
                                    <option value="">Seleccione un nivel</option>
                                    @foreach($nivelesAcademicos as $nivel)
                                        <option value="{{ $nivel }}" {{ old('nivel_academico') === $nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                                    @endforeach
                                </select>
                                @error('nivel_academico')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="ciclo_o_grado" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ciclo o Grado <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    id="ciclo_o_grado" 
                                    name="ciclo_o_grado" 
                                    value="{{ old('ciclo_o_grado') }}"
                                    min="1"
                                    max="20"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('ciclo_o_grado') border-red-500 @enderror"
                                >
                                @error('ciclo_o_grado')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="aula" class="block text-sm font-medium text-gray-700 mb-2">
                                    Aula <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="aula" 
                                    name="aula" 
                                    value="{{ old('aula') }}"
                                    maxlength="10"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('aula') border-red-500 @enderror"
                                >
                                @error('aula')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="anio" class="block text-sm font-medium text-gray-700 mb-2">
                                    Año <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    id="anio" 
                                    name="anio" 
                                    value="{{ old('anio', date('Y')) }}"
                                    min="2000"
                                    max="2100"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('anio') border-red-500 @enderror"
                                >
                                @error('anio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-4">
                        <button 
                            type="button"
                            @click="showModalNuevo = false"
                            class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                        >
                            Cancelar
                        </button>
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
                        >
                            Agregar Participante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

