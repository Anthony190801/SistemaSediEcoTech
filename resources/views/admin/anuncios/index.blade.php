@extends('layouts.admin')

@section('title', 'Gestión de Anuncios - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
                Gestión de Anuncios
            </h2>
            <p class="text-gray-600 mt-1">Administra los anuncios dirigidos a instituciones y proyectos</p>
        </div>
        <a 
            href="{{ route('admin.anuncios.create') }}" 
            class="px-4 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors flex items-center space-x-2 shadow-md hover:shadow-lg"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Nuevo Anuncio</span>
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

    <!-- Statistics Panel -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-green-500">
            <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Anuncios Activos</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalActivos }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-gray-500">
            <div class="flex-shrink-0 bg-gray-100 rounded-full p-3">
                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Anuncios Inactivos</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalInactivos }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-blue-500">
            <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Proyectos</p>
                <p class="text-2xl font-bold text-gray-900">{{ $anunciosPorProyecto->count() }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-purple-500">
            <div class="flex-shrink-0 bg-purple-100 rounded-full p-3">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Anuncios</p>
                <p class="text-2xl font-bold text-gray-900">{{ $anuncios->total() }}</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Anuncios por Institución</h3>
            <div class="h-80">
                <canvas id="institucionesChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribución por Estado</h3>
            <div class="h-80">
                <canvas id="estadosChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <form method="GET" action="{{ route('admin.anuncios.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="proyecto_id" class="block text-sm font-medium text-gray-700 mb-1">Proyecto</label>
                    <select 
                        id="proyecto_id" 
                        name="proyecto_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        @foreach($proyectos as $proyecto)
                            <option value="{{ $proyecto->id }}" {{ $proyectoFilter == $proyecto->id ? 'selected' : '' }}>
                                {{ $proyecto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="institucion_id" class="block text-sm font-medium text-gray-700 mb-1">Institución</label>
                    <select 
                        id="institucion_id" 
                        name="institucion_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todas</option>
                        @foreach($instituciones as $institucion)
                            <option value="{{ $institucion->id }}" {{ $institucionFilter == $institucion->id ? 'selected' : '' }}>
                                {{ $institucion->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select 
                        id="estado" 
                        name="estado" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                    >
                        <option value="">Todos</option>
                        <option value="Activo" {{ $estadoFilter === 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $estadoFilter === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button 
                        type="submit" 
                        class="w-full px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors"
                    >
                        Buscar
                    </button>
                    @if($proyectoFilter || $institucionFilter || $estadoFilter)
                        <a 
                            href="{{ route('admin.anuncios.index') }}" 
                            class="ml-2 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                        >
                            Limpiar
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Anuncios Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Motivo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Proyecto</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Institución</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Fecha Inicial</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Fecha Final</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($anuncios as $anuncio)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($anuncio->motivo, 50) }}</div>
                                @if($anuncio->fecha)
                                    <div class="text-xs text-gray-500 mt-1">
                                        📅 {{ $anuncio->fecha->format('d/m/Y') }}
                                        @if($anuncio->hora)
                                            🕐 {{ strlen($anuncio->hora) > 5 ? substr($anuncio->hora, 0, 5) : $anuncio->hora }}
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $anuncio->institucionProyecto->proyecto->nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $anuncio->institucionProyecto->institucion->nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $anuncio->fecha_inicial->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $anuncio->fecha_final ? $anuncio->fecha_final->format('d/m/Y') : 'Sin límite' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $estaActivo = $anuncio->estado === 'Activo' && 
                                                  $anuncio->fecha_inicial <= now() && 
                                                  ($anuncio->fecha_final === null || $anuncio->fecha_final >= now());
                                    $proximoExpirar = $anuncio->fecha_final && 
                                                      $anuncio->fecha_final->diffInDays(now()) <= 7 && 
                                                      $anuncio->fecha_final >= now();
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                    {{ $estaActivo ? 'bg-green-100 text-green-800' : 
                                       ($proximoExpirar ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $estaActivo ? 'Activo' : ($proximoExpirar ? 'Por expirar' : 'Inactivo') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a 
                                        href="{{ route('admin.anuncios.show', $anuncio) }}" 
                                        class="text-blue-600 hover:text-blue-900 transition-colors"
                                        title="Ver"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a 
                                        href="{{ route('admin.anuncios.edit', $anuncio) }}" 
                                        class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                        title="Editar"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form 
                                        action="{{ route('admin.anuncios.destroy', $anuncio) }}" 
                                        method="POST" 
                                        class="inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este anuncio?');"
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                </svg>
                                <p class="text-lg font-medium">No se encontraron anuncios</p>
                                <p class="text-sm mt-2">Crea tu primer anuncio para comenzar</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($anuncios->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $anuncios->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Gráfica de Instituciones (Barras)
    const institucionesCtx = document.getElementById('institucionesChart').getContext('2d');
    const institucionesData = @json($graficaInstituciones);
    
    new Chart(institucionesCtx, {
        type: 'bar',
        data: {
            labels: institucionesData.map(item => item.nombre),
            datasets: [{
                label: 'Cantidad de Anuncios',
                data: institucionesData.map(item => item.total),
                backgroundColor: '#34A853',
                borderColor: '#2d8f47',
                borderWidth: 1,
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Gráfica de Estados (Torta)
    const estadosCtx = document.getElementById('estadosChart').getContext('2d');
    const estadosData = @json($graficaEstados);
    
    new Chart(estadosCtx, {
        type: 'doughnut',
        data: {
            labels: ['Activo', 'Inactivo'],
            datasets: [{
                data: [estadosData.Activo, estadosData.Inactivo],
                backgroundColor: ['#34A853', '#9CA3AF'],
                borderWidth: 2,
                borderColor: '#ffffff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
@endsection

