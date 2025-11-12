@extends('layouts.participant')

@section('title', 'Premios - SEDIECOTECH Rewards')

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
<div class="space-y-6">
    <!-- Breadcrumbs -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('participant.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#34A853]">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Premios</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
            Premios Disponibles
        </h2>
        <p class="text-gray-600 mt-1">Premios por ranking y por puntaje acumulado</p>
    </div>

    <!-- Resumen de Puntaje -->
    @if($siguientePremio)
        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Puntaje Actual</p>
                    <p class="text-3xl font-bold text-[#34A853]">{{ number_format($participante->puntaje_total, 0) }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 mb-1">Próximo Premio</p>
                    <p class="text-xl font-bold text-gray-800">{{ $siguientePremio->articulo->nombre }}</p>
                    <p class="text-sm text-gray-600 mt-1">Faltan <span class="font-bold text-[#34A853]">{{ $faltanPuntos }}</span> puntos</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Premios por Ranking -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                🏆 Premios por Ranking
            </h2>

            @if($premiosRanking->count() > 0)
                <div class="space-y-4">
                    @foreach($premiosRanking as $premio)
                        <div class="border-2 border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-4">
                                @if($premio->articulo->url_foto)
                                    <img src="{{ asset('storage/' . $premio->articulo->url_foto) }}" alt="{{ $premio->articulo->nombre }}" class="w-20 h-20 object-cover rounded">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-800 text-lg">{{ $premio->articulo->nombre }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Requiere: <span class="font-semibold">Posición #{{ $premio->posicion_requerida ?? 'N/A' }}</span>
                                    </p>
                                </div>
                                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                                    Disponible
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <p class="text-gray-600">No hay premios por ranking disponibles en este momento.</p>
                </div>
            @endif
        </div>

        <!-- Premios por Puntaje (Lista) -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
                🎁 Premios por Puntaje
            </h2>

            @if($premiosPuntaje->count() > 0)
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @foreach($premiosPuntaje as $premio)
                        <div class="border-2 {{ $premio->alcanzado ? 'border-green-500 bg-green-50' : ($premio->esSiguiente ? 'border-yellow-400 bg-yellow-50' : 'border-gray-200') }} rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-4">
                                @if($premio->articulo->url_foto)
                                    <img src="{{ asset('storage/' . $premio->articulo->url_foto) }}" alt="{{ $premio->articulo->nombre }}" class="w-20 h-20 object-cover rounded">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-800 text-lg">{{ $premio->articulo->nombre }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Requiere: <span class="font-semibold">{{ $premio->puntaje_requerido }} puntos</span>
                                    </p>
                                    @if(!$premio->alcanzado)
                                        <p class="text-xs text-orange-600 mt-2 font-semibold">
                                            Te faltan {{ $premio->faltanPuntos }} puntos
                                        </p>
                                    @endif
                                </div>
                                <div>
                                    @if($premio->alcanzado)
                                        <span class="px-4 py-2 bg-green-500 text-white rounded-full text-sm font-semibold">
                                            ✓ Alcanzado
                                        </span>
                                    @elseif($premio->esSiguiente)
                                        <span class="px-4 py-2 bg-yellow-400 text-gray-800 rounded-full text-sm font-semibold">
                                            Próximo
                                        </span>
                                    @else
                                        <span class="px-4 py-2 bg-gray-200 text-gray-600 rounded-full text-sm font-semibold">
                                            No disponible
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <p class="text-gray-600">No hay premios por puntaje disponibles en este momento.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Línea de Tiempo Visual -->
    @if($premiosPuntaje->count() > 0)
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Línea de Tiempo de Recompensas
            </h2>

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
                            <div class="w-1/2 {{ $index % 2 === 0 ? 'pl-8 text-left' : 'pr-8 text-right' }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

