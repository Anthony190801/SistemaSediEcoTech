@extends('layouts.participant')

@section('title', 'Mi Dashboard - SEDIECOTECH Rewards')

@push('styles')
<style>
    .timeline-item {
        position: relative;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
        transform: translateX(-50%);
    }
    .timeline-item:first-child::before {
        top: 50%;
    }
    .timeline-item:last-child::before {
        bottom: 50%;
    }
    .timeline-item.alcanzado::before {
        background: #34A853;
    }
    
    /* Timeline vertical para premios */
    @media (max-width: 1024px) {
        .timeline-premios .flex-row-reverse {
            flex-direction: row !important;
        }
        .timeline-premios .text-left {
            text-align: right !important;
        }
        .timeline-premios .pl-8 {
            padding-left: 0 !important;
            padding-right: 2rem !important;
        }
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Breadcrumbs -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-500">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Mi Dashboard
        </h2>
        <p class="text-gray-600 mt-1">Bienvenido a tu dashboard de SEDIECOTECH Rewards</p>
    </div>

    <!-- Métricas Principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Puntaje Total -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#34A853]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Puntaje Total</p>
                    <p class="text-3xl font-bold text-[#34A853]">{{ number_format($participante->puntaje_total, 0) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#34A853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Posición en Ranking -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Posición</p>
                    <p class="text-3xl font-bold text-blue-600">#{{ $posicion }}</p>
                    <p class="text-xs text-gray-500 mt-1">de {{ $totalParticipantes }} participantes</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Materiales Reciclados -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Materiales Reciclados</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ number_format($totalKg, 2) }} kg</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Próximo Premio -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Próximo Premio</p>
                    @if($siguientePremio)
                        <p class="text-lg font-bold text-purple-600">{{ $faltanPuntos }} pts</p>
                        <p class="text-xs text-gray-500 mt-1">faltan</p>
                    @else
                        <p class="text-lg font-bold text-purple-600">¡Completado! 🎉</p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Materiales Reciclados -->
    @if($materialesData->count() > 0)
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Distribución de Materiales Reciclados
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Gráfico Circular -->
                <div class="lg:col-span-1">
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4" style="position: relative; height: 280px;">
                        <canvas id="materialesChart"></canvas>
                    </div>
                </div>

                <!-- Lista de Materiales con Estadísticas -->
                <div class="lg:col-span-2">
                    @php
                        $materialesOrdenados = $materialesData->sortDesc();
                        $materialMasReciclado = $materialesOrdenados->keys()->first();
                        $totalMateriales = $materialesData->sum();
                    @endphp

                    <!-- Estadísticas Rápidas -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
                            <p class="text-sm text-gray-600 mb-1">Materiales Diferentes</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $materialesData->count() }}</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4 border-l-4 border-[#34A853]">
                            <p class="text-sm text-gray-600 mb-1">Material Más Reciclado</p>
                            <p class="text-lg font-bold text-[#34A853] truncate" title="{{ $materialMasReciclado }}">{{ $materialMasReciclado ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Lista Detallada de Materiales -->
                    <div class="space-y-3">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Detalle por Material</h3>
                        @foreach($materialesOrdenados as $material => $cantidad)
                            @php
                                $porcentaje = ($cantidad / $totalMateriales) * 100;
                                $colorClass = match(true) {
                                    $porcentaje >= 30 => 'bg-[#34A853]',
                                    $porcentaje >= 20 => 'bg-green-500',
                                    $porcentaje >= 10 => 'bg-green-400',
                                    default => 'bg-green-300'
                                };
                            @endphp
                            <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 rounded-full {{ $colorClass }}"></div>
                                        <span class="font-semibold text-gray-800">{{ $material }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-lg font-bold text-[#34A853]">{{ number_format($cantidad, 2) }} kg</span>
                                        <span class="text-sm text-gray-500 ml-2">({{ number_format($porcentaje, 1) }}%)</span>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div 
                                        class="{{ $colorClass }} h-2.5 rounded-full transition-all duration-500"
                                        style="width: {{ $porcentaje }}%"
                                    ></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Resumen Total -->
                    <div class="mt-6 bg-gradient-to-r from-[#34A853] to-green-600 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-green-100 mb-1">Total Reciclado</p>
                                <p class="text-3xl font-bold">{{ number_format($totalKg, 2) }} kg</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-green-100 mb-1">Promedio por Material</p>
                                <p class="text-2xl font-bold">{{ number_format($totalMateriales / $materialesData->count(), 2) }} kg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aún no has reciclado materiales</h3>
                <p class="text-gray-500">¡Comienza a reciclar para ver tus estadísticas aquí!</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Ranking Institucional -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Ranking Institucional
            </h2>
            
            <div class="bg-green-50 rounded-lg p-4 mb-4">
                <p class="text-center text-gray-700">
                    Estás en la posición <span class="font-bold text-[#34A853] text-xl">#{{ $posicion }}</span> 
                    de <span class="font-semibold">{{ $totalParticipantes }}</span> participantes
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 px-3 text-sm font-semibold text-gray-700">Pos.</th>
                            <th class="text-left py-2 px-3 text-sm font-semibold text-gray-700">Nombre</th>
                            <th class="text-right py-2 px-3 text-sm font-semibold text-gray-700">Puntos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ranking->take(10) as $index => $participanteRanking)
                            <tr class="border-b border-gray-100 {{ $participanteRanking->persona_id === $user->persona_id ? 'bg-green-50 font-semibold' : '' }}">
                                <td class="py-3 px-3">
                                    @if($index === 0)
                                        <span class="text-yellow-500 text-xl">🥇</span>
                                    @elseif($index === 1)
                                        <span class="text-gray-400 text-xl">🥈</span>
                                    @elseif($index === 2)
                                        <span class="text-orange-500 text-xl">🥉</span>
                                    @else
                                        <span class="text-gray-500">#{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-gray-700">
                                    {{ $participanteRanking->persona->nombres }} {{ $participanteRanking->persona->apellidos }}
                                    @if($participanteRanking->persona_id === $user->persona_id)
                                        <span class="ml-2 text-xs bg-[#34A853] text-white px-2 py-1 rounded">Tú</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-right font-semibold text-gray-800">
                                    {{ number_format($participanteRanking->puntaje_total, 0) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('participant.ranking') }}" class="text-[#34A853] hover:text-green-700 font-medium text-sm">
                    Ver ranking completo →
                </a>
            </div>
        </div>

        <!-- Premios por Ranking - Línea de Tiempo -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
                Premios por Ranking
            </h2>

            @if($premiosRanking->count() > 0)
                @php
                    $premiosTop3 = $premiosRanking->sortBy('posicion_requerida')->take(3);
                    $colores = [
                        1 => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-600', 'border' => 'border-yellow-500', 'light' => 'bg-yellow-50'],
                        2 => ['bg' => 'bg-gray-400', 'text' => 'text-gray-600', 'border' => 'border-gray-400', 'light' => 'bg-gray-50'],
                        3 => ['bg' => 'bg-orange-500', 'text' => 'text-orange-600', 'border' => 'border-orange-500', 'light' => 'bg-orange-50'],
                    ];
                @endphp

                <div class="relative py-4 timeline-premios">
                    <!-- Línea Vertical Central -->
                    <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-yellow-500 via-gray-400 to-orange-500 transform -translate-x-1/2 rounded-full z-0"></div>

                    <!-- Items de la Línea de Tiempo -->
                    <div class="relative space-y-8">
                        @foreach($premiosTop3 as $index => $premio)
                            @php
                                $posicionPremio = $premio->posicion_requerida;
                                $color = $colores[$posicionPremio] ?? $colores[3];
                                $isLeft = $index % 2 === 0;
                                $alcanzado = $posicion <= $posicionPremio;
                            @endphp
                            <div class="relative flex items-center {{ $isLeft ? 'flex-row' : 'flex-row-reverse' }}">
                                <!-- Contenido -->
                                <div class="{{ $isLeft ? 'pr-8 text-right' : 'pl-8 text-left' }} flex-1">
                                    <div class="inline-block {{ $color['light'] }} rounded-lg p-4 max-w-xs shadow-md hover:shadow-lg transition-shadow">
                                        <div class="flex items-center {{ $isLeft ? 'justify-end' : 'justify-start' }} mb-2">
                                            <span class="text-2xl font-bold {{ $color['text'] }}">#{{ $posicionPremio }}</span>
                                        </div>
                                        <h3 class="font-bold text-gray-800 mb-1 text-sm">{{ $premio->articulo->nombre }}</h3>
                                        @if($premio->articulo->url_foto)
                                            <img src="{{ asset('storage/' . $premio->articulo->url_foto) }}" alt="{{ $premio->articulo->nombre }}" class="w-16 h-16 object-cover rounded-lg mx-auto mt-2">
                                        @endif
                                        @if($alcanzado)
                                            <span class="inline-block mt-2 px-2 py-1 bg-[#34A853] text-white text-xs rounded-full">Disponible</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Nodo Circular -->
                                <div class="relative z-10 flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full {{ $color['bg'] }} border-4 border-white shadow-lg flex items-center justify-center">
                                        @if($posicionPremio === 1)
                                            <span class="text-white text-xl">🥇</span>
                                        @elseif($posicionPremio === 2)
                                            <span class="text-white text-xl">🥈</span>
                                        @elseif($posicionPremio === 3)
                                            <span class="text-white text-xl">🥉</span>
                                        @else
                                            <span class="text-white font-bold text-sm">#{{ $posicionPremio }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Espacio vacío del otro lado -->
                                <div class="{{ $isLeft ? 'pl-8' : 'pr-8' }} flex-1"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($premiosRanking->count() > 3)
                    <div class="mt-4 text-center">
                        <a href="{{ route('participant.premios') }}" class="text-[#34A853] hover:text-green-700 font-medium text-sm">
                            Ver todos los premios →
                        </a>
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    <p class="text-gray-500">No hay premios por ranking disponibles</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Progreso hacia el siguiente premio -->
    @if($siguientePremio)
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                Progreso hacia el Siguiente Premio
            </h2>
            
            <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-6 mb-4">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Próximo Premio</p>
                        <p class="text-xl font-bold text-gray-800">{{ $siguientePremio->articulo->nombre }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 mb-1">Puntos Requeridos</p>
                        <p class="text-xl font-bold text-[#34A853]">{{ number_format($siguientePremio->puntaje_requerido, 0) }}</p>
                    </div>
                </div>
                
                <!-- Barra de progreso -->
                <div class="w-full bg-gray-200 rounded-full h-6 mb-2">
                    <div 
                        class="bg-[#34A853] h-6 rounded-full transition-all duration-500 ease-out flex items-center justify-end pr-2"
                        style="width: {{ $progresoPorcentaje }}%"
                    >
                        @if($progresoPorcentaje > 10)
                            <span class="text-white text-xs font-semibold">{{ number_format($progresoPorcentaje, 1) }}%</span>
                        @endif
                    </div>
                </div>
                <div class="flex justify-between text-sm text-gray-600">
                    <span>Puntos actuales: <strong>{{ number_format($participante->puntaje_total, 0) }}</strong></span>
                    <span>Faltan: <strong class="text-[#34A853]">{{ $faltanPuntos }}</strong> puntos</span>
                </div>
            </div>
        </div>
    @endif

    <!-- Mensaje Motivacional -->
    <div class="bg-gradient-to-r from-[#34A853] to-green-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold mb-2">
                    @if($posicion <= 3)
                        ¡Excelente trabajo! Estás entre los mejores 🏆
                    @elseif($posicion <= 10)
                        ¡Sigue así! Estás en el top 10 💪
                    @else
                        ¡Sigue reciclando! Cada punto cuenta 🌱
                    @endif
                </h3>
                <p class="text-green-100">
                    {{ $participante->institucionProyecto->institucion->nombre }} - {{ $participante->institucionProyecto->proyecto->nombre }}
                </p>
            </div>
            <div class="text-6xl">
                @if($posicion <= 3)
                    🏆
                @elseif($posicion <= 10)
                    💪
                @else
                    🌱
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
@if($materialesData->count() > 0)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('materialesChart');
        if (ctx) {
            const materialesData = @json($materialesData);
            const labels = Object.keys(materialesData);
            const data = Object.values(materialesData);
            
            const colors = [
                '#34A853', '#4CAF50', '#66BB6A', '#81C784', '#A5D6A7',
                '#C8E6C9', '#E8F5E9', '#FF9800', '#FF5722', '#9C27B0'
            ];

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors.slice(0, labels.length),
                        borderWidth: 3,
                        borderColor: '#fff',
                        hoverBorderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return label + ': ' + value.toFixed(2) + ' kg (' + percentage + '%)';
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
        }
    });
</script>
@endif
@endpush
@endsection

