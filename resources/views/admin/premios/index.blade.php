@extends('layouts.admin')

@section('title', 'Gestión de Premios - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
                Gestión de Premios
            </h2>
            <p class="text-gray-600 mt-1">Administra los premios disponibles en el sistema</p>
        </div>
        <a 
            href="{{ route('admin.premios.create') }}" 
            class="px-4 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors flex items-center space-x-2 shadow-md hover:shadow-lg"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Nuevo Premio</span>
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

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <form method="GET" action="{{ route('admin.premios.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Filtro por Tipo -->
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                    <select 
                        id="tipo" 
                        name="tipo" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        <option value="Canje por puntaje" {{ $tipo === 'Canje por puntaje' ? 'selected' : '' }}>Canje por puntaje</option>
                        <option value="Canje por Ranking" {{ $tipo === 'Canje por Ranking' ? 'selected' : '' }}>Canje por Ranking</option>
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

                <!-- Filtro por Estado -->
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select 
                        id="estado" 
                        name="estado" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        <option value="Disponible" {{ $estado === 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="No disponible" {{ $estado === 'No disponible' ? 'selected' : '' }}>No disponible</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="flex items-end">
                    <button 
                        type="submit" 
                        class="w-full px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
                    >
                        Buscar
                    </button>
                </div>
            </div>

            @if($tipo || $proyecto_id || $estado)
                <div>
                    <a 
                        href="{{ route('admin.premios.index') }}" 
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors inline-block"
                    >
                        Limpiar
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- Premios Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Artículo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Institución - Proyecto</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Puntaje</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($premios as $premio)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($premio->articulo->url_foto)
                                        <img 
                                            src="{{ asset('storage/' . $premio->articulo->url_foto) }}" 
                                            alt="{{ $premio->articulo->nombre }}" 
                                            class="w-12 h-12 object-cover rounded-lg mr-3"
                                        >
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $premio->articulo->nombre }}</div>
                                        <div class="text-xs text-gray-500">S/ {{ number_format($premio->articulo->precio, 2) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <div>{{ $premio->institucionProyecto->institucion->nombre }}</div>
                                <div class="text-xs text-gray-500">{{ $premio->institucionProyecto->proyecto->nombre }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $premio->tipo === 'Canje por puntaje' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ $premio->tipo }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                @if($premio->tipo === 'Canje por puntaje')
                                    <span class="font-semibold">{{ number_format($premio->puntaje_requerido ?? 0, 0) }} pts</span>
                                @else
                                    <span class="font-semibold">Posición #{{ $premio->posicion_requerida ?? 'N/A' }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $premio->estado === 'Disponible' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $premio->estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a 
                                        href="{{ route('admin.premios.edit', $premio) }}" 
                                        class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                        title="Editar"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form 
                                        action="{{ route('admin.premios.destroy', $premio) }}" 
                                        method="POST" 
                                        class="inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este premio? Esta acción no se puede deshacer.');"
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
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                                <p class="text-lg font-medium">No se encontraron premios</p>
                                <p class="text-sm mt-2">Crea tu primer premio para comenzar</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($premios->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $premios->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

