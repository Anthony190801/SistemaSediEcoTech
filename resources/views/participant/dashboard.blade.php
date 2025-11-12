@extends('layouts.app')

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
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-white">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Saludo personalizado -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Hola, {{ $user->name }} 👋
            </h1>
            <p class="text-gray-600 mt-1">Bienvenido a tu dashboard de SEDIECOTECH Rewards</p>
        </div>
        <!-- Resumen del Participante -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border-l-4 border-[#34A853]">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Mi Información</h2>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#34A853] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-gray-700"><strong>Nombre:</strong> {{ $participante->persona->nombres }} {{ $participante->persona->apellidos }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#34A853] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="text-gray-700"><strong>Institución:</strong> {{ $participante->institucionProyecto->institucion->nombre }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#34A853] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span class="text-gray-700"><strong>Proyecto:</strong> {{ $participante->institucionProyecto->proyecto->nombre }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#34A853] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="text-gray-700"><strong>Nivel:</strong> {{ $participante->nivel_academico }} - Grado {{ $participante->ciclo_o_grado }} - Aula {{ $participante->aula }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Mi Puntaje</h2>
                    <div class="text-center">
                        <div class="text-5xl font-bold text-[#34A853] mb-4">
                            {{ number_format($participante->puntaje_total, 0) }}
                        </div>
                        <p class="text-gray-600 mb-4">puntos acumulados</p>
                        
                        @if($siguientePremio)
                            <div class="bg-green-50 rounded-lg p-4 mb-4">
                                <p class="text-sm text-gray-700 mb-2">
                                    <strong>Próximo premio:</strong> {{ $siguientePremio->articulo->nombre }}
                                </p>
                                <p class="text-lg font-semibold text-[#34A853]">
                                    Te faltan <span class="text-2xl">{{ $faltanPuntos }}</span> puntos 🎯
                                </p>
                            </div>
                            
                            <!-- Barra de progreso -->
                            <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                                <div 
                                    class="bg-[#34A853] h-4 rounded-full transition-all duration-500 ease-out"
                                    style="width: {{ $progresoPorcentaje }}%"
                                ></div>
                            </div>
                            <p class="text-xs text-gray-500">
                                {{ number_format($progresoPorcentaje, 1) }}% completado
                            </p>
                        @else
                            <div class="bg-yellow-50 rounded-lg p-4">
                                <p class="text-sm text-gray-700">
                                    ¡Felicidades! Has alcanzado todos los premios disponibles 🎉
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
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
            </div>

            <!-- Premios Disponibles -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    Premios Disponibles
                </h2>

                <!-- Premios por Ranking -->
                @if($premiosRanking->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                            🏆 Premios por Ranking
                        </h3>
                        <div class="space-y-3">
                            @foreach($premiosRanking as $premio)
                                <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <div class="flex items-center space-x-3">
                                        @if($premio->articulo->url_foto)
                                            <img src="{{ asset('storage/' . $premio->articulo->url_foto) }}" alt="{{ $premio->articulo->nombre }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800">{{ $premio->articulo->nombre }}</p>
                                            <p class="text-sm text-gray-600">Canje por Ranking</p>
                                        </div>
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                            Disponible
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Premios por Puntaje -->
                @if($premiosPuntaje->count() > 0)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                            🎁 Premios por Puntaje
                        </h3>
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @foreach($premiosPuntaje as $premio)
                                <div class="border {{ $premio->alcanzado ? 'border-green-500 bg-green-50' : 'border-gray-200' }} rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <div class="flex items-center space-x-3">
                                        @if($premio->articulo->url_foto)
                                            <img src="{{ asset('storage/' . $premio->articulo->url_foto) }}" alt="{{ $premio->articulo->nombre }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800">{{ $premio->articulo->nombre }}</p>
                                            <p class="text-sm text-gray-600">
                                                Requiere: <span class="font-semibold">{{ $premio->puntaje_requerido }} puntos</span>
                                            </p>
                                            @if(!$premio->alcanzado)
                                                @php
                                                    $faltan = $premio->puntaje_requerido - $participante->puntaje_total;
                                                @endphp
                                                <p class="text-xs text-orange-600 mt-1">
                                                    Te faltan {{ $faltan }} puntos
                                                </p>
                                            @endif
                                        </div>
                                        <div>
                                            @if($premio->alcanzado)
                                                <span class="px-3 py-1 bg-green-500 text-white rounded-full text-xs font-semibold">
                                                    ✓ Alcanzado
                                                </span>
                                            @else
                                                <span class="px-3 py-1 bg-gray-200 text-gray-600 rounded-full text-xs font-semibold">
                                                    No disponible
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                            🎁 Premios por Puntaje
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-gray-600">No hay premios por puntaje disponibles en este momento.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Línea de Tiempo Visual de Recompensas -->
        @if($premiosPuntaje->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Línea de Tiempo de Recompensas
                </h2>

                @if($siguientePremio)
                    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-4 mb-6 text-center">
                        <p class="text-lg font-semibold text-gray-800">
                            Puntaje actual: <span class="text-[#34A853] text-2xl">{{ number_format($participante->puntaje_total, 0) }}</span> puntos
                        </p>
                        <p class="text-gray-700 mt-2">
                            Faltan <span class="font-bold text-[#34A853]">{{ $faltanPuntos }}</span> puntos para tu próximo premio 🎯
                        </p>
                    </div>
                @endif

                <div class="relative">
                    @foreach($premiosPuntaje as $index => $premio)
                        <div class="timeline-item {{ $premio->alcanzado ? 'alcanzado' : '' }} mb-8 last:mb-0">
                            <div class="flex items-center {{ $index % 2 === 0 ? 'flex-row' : 'flex-row-reverse' }}">
                                <div class="w-1/2 {{ $index % 2 === 0 ? 'pr-8 text-right' : 'pl-8 text-left' }}">
                                    <div class="inline-block max-w-xs">
                                        <div class="bg-white border-2 {{ $premio->alcanzado ? 'border-green-500' : ($premio->esSiguiente ? 'border-yellow-400 shadow-lg' : 'border-gray-300') }} rounded-lg p-4 {{ $premio->esSiguiente ? 'animate-pulse' : '' }}">
                                            @if($premio->articulo->url_foto)
                                                <img src="{{ asset('storage/' . $premio->articulo->url_foto) }}" alt="{{ $premio->articulo->nombre }}" class="w-20 h-20 object-cover rounded mx-auto mb-2">
                                            @else
                                                <div class="w-20 h-20 bg-gray-200 rounded mx-auto mb-2 flex items-center justify-center">
                                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <h4 class="font-semibold text-gray-800 mb-1">{{ $premio->articulo->nombre }}</h4>
                                            <p class="text-sm text-gray-600">{{ $premio->puntaje_requerido }} puntos</p>
                                            @if($premio->alcanzado)
                                                <span class="inline-block mt-2 px-2 py-1 bg-green-500 text-white text-xs rounded">✓ Alcanzado</span>
                                            @elseif($premio->esSiguiente)
                                                <span class="inline-block mt-2 px-2 py-1 bg-yellow-400 text-gray-800 text-xs rounded font-semibold">Próximo</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/2 flex justify-center">
                                    <div class="relative">
                                        <div class="w-12 h-12 rounded-full border-4 {{ $premio->alcanzado ? 'border-green-500 bg-green-500' : ($premio->esSiguiente ? 'border-yellow-400 bg-yellow-400 animate-pulse' : 'border-gray-300 bg-white') }} flex items-center justify-center z-10">
                                            @if($premio->alcanzado)
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                <span class="text-xs font-bold {{ $premio->esSiguiente ? 'text-gray-800' : 'text-gray-500' }}">{{ $premio->puntaje_requerido }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="w-1/2 {{ $index % 2 === 0 ? 'pl-8 text-left' : 'pr-8 text-right' }}">
                                    <!-- Espacio vacío para mantener el layout -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

@push('scripts')
<script>
    // Animación suave al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.timeline-item');
        items.forEach((item, index) => {
            setTimeout(() => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 100);
            }, index * 100);
        });
    });
</script>
@endpush
@endsection

