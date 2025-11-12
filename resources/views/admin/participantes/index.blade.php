@extends('layouts.admin')

@section('title', 'Gestión de Participantes - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Gestión de Participantes
            </h2>
            <p class="text-gray-600 mt-1">Administra los participantes del sistema SEDIECOTECH Rewards</p>
        </div>
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

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <form method="GET" action="{{ route('admin.participantes.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Búsqueda -->
                <div class="lg:col-span-2">
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

                <!-- Filtro por Institución -->
                <div>
                    <label for="institucion_id" class="block text-sm font-medium text-gray-700 mb-1">Institución</label>
                    <select 
                        id="institucion_id" 
                        name="institucion_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todas</option>
                        @foreach($instituciones as $institucion)
                            <option value="{{ $institucion->id }}" {{ $institucion_id == $institucion->id ? 'selected' : '' }}>
                                {{ $institucion->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Proyecto -->
                <div>
                    <label for="proyecto_id" class="block text-sm font-medium text-gray-700 mb-1">Proyecto</label>
                    <select 
                        id="proyecto_id" 
                        name="proyecto_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        @foreach($proyectos as $proyecto)
                            <option value="{{ $proyecto->id }}" {{ $proyecto_id == $proyecto->id ? 'selected' : '' }}>
                                {{ $proyecto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Nivel Académico -->
                <div>
                    <label for="nivel_academico" class="block text-sm font-medium text-gray-700 mb-1">Nivel</label>
                    <select 
                        id="nivel_academico" 
                        name="nivel_academico" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        @foreach($nivelesAcademicos as $nivel)
                            <option value="{{ $nivel }}" {{ $nivel_academico == $nivel ? 'selected' : '' }}>
                                {{ $nivel }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
                >
                    Buscar
                </button>
                @if($search || $institucion_id || $proyecto_id || $nivel_academico)
                    <a 
                        href="{{ route('admin.participantes.index') }}" 
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                    >
                        Limpiar
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Participants Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Participante</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">DNI</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Institución</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Proyecto</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nivel</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Puntaje</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($participantes as $participante)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-[#34A853] flex items-center justify-center text-white font-semibold mr-3">
                                        {{ strtoupper(substr($participante->persona->nombres, 0, 1)) }}{{ strtoupper(substr($participante->persona->apellidos, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $participante->ciclo_o_grado ?? 'N/A' }} - Aula: {{ $participante->aula ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $participante->persona->dni }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $participante->institucionProyecto->institucion->nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $participante->institucionProyecto->proyecto->nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $participante->nivel_academico }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    {{ number_format($participante->puntaje_total, 0) }} pts
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a 
                                        href="{{ route('admin.participantes.show', $participante) }}" 
                                        class="text-blue-600 hover:text-blue-900 transition-colors"
                                        title="Ver detalles"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a 
                                        href="{{ route('admin.participantes.edit', $participante) }}" 
                                        class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                        title="Editar"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form 
                                        action="{{ route('admin.participantes.destroy', $participante) }}" 
                                        method="POST" 
                                        class="inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este participante? Esta acción no se puede deshacer.');"
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
                                <p class="text-lg font-medium">No se encontraron participantes</p>
                                <p class="text-sm mt-2">Intenta ajustar los filtros de búsqueda</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($participantes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $participantes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

