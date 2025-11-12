@extends('layouts.admin')

@section('title', 'Editar Material - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar Material: {{ $material->nombre }}
            </h2>
            <p class="text-gray-600 mt-1">Gestiona la información del material y sus configuraciones de precio por proyecto</p>
        </div>
        <a 
            href="{{ route('admin.materiales.index') }}" 
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

    <!-- Formulario de Edición del Material -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Información del Material
        </h3>

        <form action="{{ route('admin.materiales.update', $material) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre del Material <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        value="{{ old('nombre', $material->nombre) }}"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('nombre') border-red-500 @enderror"
                    >
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Imagen -->
                <div>
                    @if($material->url_foto)
                        <label class="block text-sm font-medium text-gray-700 mb-2">Imagen Actual</label>
                        <img 
                            src="{{ asset('storage/' . $material->url_foto) }}" 
                            alt="{{ $material->nombre }}" 
                            class="w-32 h-32 object-cover rounded-lg border border-gray-300 mb-2"
                        >
                    @endif
                    <label for="url_foto" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $material->url_foto ? 'Reemplazar Imagen' : 'Imagen del Material' }}
                    </label>
                    <input 
                        type="file" 
                        id="url_foto" 
                        name="url_foto" 
                        accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('url_foto') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-xs text-gray-500">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</p>
                    @error('url_foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
                >
                    Actualizar Material
                </button>
            </div>
        </form>
    </div>

    <!-- Configuraciones de Precio Existentes -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Configuraciones de Precio por Proyecto
            </h3>
        </div>

        @if($configuracionesPrecio->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Precio (S/)</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Puntaje (pts/kg)</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Proyectos</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Fechas</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Estado</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($configuracionesPrecio as $config)
                            <tr class="hover:bg-gray-50 {{ $config['activo'] ? '' : 'opacity-60' }}">
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                                    S/ {{ number_format($config['precio'], 2) }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ number_format($config['puntaje'], 2) }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($config['proyectos_nombres'] as $proyectoNombre)
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">
                                                {{ $proyectoNombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    <div>
                                        <div class="text-xs">Inicio: {{ $config['fecha_inicio'] }}</div>
                                        <div class="text-xs">Fin: {{ $config['fecha_fin'] ?? 'Sin límite' }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $config['activo'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $config['activo'] ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a 
                                            href="{{ route('admin.materiales.editar-precio', ['material' => $material->id, 'materialPrecio' => $config['id']]) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors"
                                            title="Editar"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form 
                                            action="{{ route('admin.materiales.eliminar-precio', ['material' => $material->id, 'materialPrecio' => $config['id']]) }}" 
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta configuración de precio? Esta acción no se puede deshacer.');"
                                            class="inline"
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-lg font-medium">No hay configuraciones de precio registradas</p>
                <p class="text-sm mt-2">Agrega una configuración de precio para comenzar</p>
            </div>
        @endif
    </div>

    <!-- Formulario para Agregar Nueva Configuración de Precio -->
    @if(!$todosProyectosTienenPrecio)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Agregar Nueva Configuración de Precio
            </h3>

            <form action="{{ route('admin.materiales.agregar-precio', $material) }}" method="POST" class="space-y-6">
                @csrf

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
                            value="{{ old('cantidad_soles') }}"
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
                            value="{{ old('puntaje') }}"
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
                            value="{{ old('fecha_inicio', now()->format('Y-m-d')) }}"
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
                            value="{{ old('fecha_fin') }}"
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
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 border border-gray-300 rounded-lg p-4 max-h-60 overflow-y-auto">
                        @foreach($proyectosDisponibles as $proyecto)
                            <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                                <input 
                                    type="checkbox" 
                                    name="proyectos[]" 
                                    value="{{ $proyecto->id }}"
                                    {{ in_array($proyecto->id, old('proyectos', [])) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-[#34A853] focus:ring-[#34A853]"
                                >
                                <span class="text-sm text-gray-700">{{ $proyecto->nombre }}</span>
                            </label>
                        @endforeach
                    </div>
                    @if($proyectosDisponibles->isEmpty())
                        <p class="mt-2 text-xs text-orange-600">
                            <strong>Nota:</strong> Todos los proyectos activos ya tienen una configuración de precio asignada.
                        </p>
                    @endif
                    @error('proyectos')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
                    >
                        Agregar Configuración de Precio
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-green-800 mb-2">
                        Configuración Completa
                    </h3>
                    <p class="text-green-700">
                        Este material ya tiene configuraciones de precio asignadas para todos los proyectos activos disponibles. 
                        Si necesitas modificar alguna configuración, puedes usar el botón <strong>"Editar"</strong> en la tabla de configuraciones de arriba.
                    </p>
                    <p class="text-sm text-green-600 mt-2">
                        Si se crean nuevos proyectos en el sistema, podrás agregar configuraciones de precio para ellos desde aquí.
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
