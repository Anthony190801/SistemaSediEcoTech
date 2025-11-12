@extends('layouts.participant')

@section('title', 'Anuncios - SEDIECOTECH Rewards')

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Anuncios</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
            </svg>
            Anuncios y Comunicados
        </h2>
        <p class="text-gray-600 mt-1">
            {{ $participante->institucionProyecto->institucion->nombre }} - {{ $participante->institucionProyecto->proyecto->nombre }}
        </p>
    </div>

        <!-- Anuncios Grid -->
        @if($anuncios->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($anuncios as $anuncio)
                    @php
                        $proximoExpirar = $anuncio->fecha_final && 
                                          $anuncio->fecha_final->diffInDays(now()) <= 7 && 
                                          $anuncio->fecha_final >= now();
                        $borderColor = $proximoExpirar ? 'border-yellow-400' : 'border-[#34A853]';
                    @endphp
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 {{ $borderColor }} hover:shadow-xl transition-shadow">
                        <!-- Header -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $anuncio->motivo }}</h3>
                            @if($proximoExpirar)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    ⚠️ Por expirar pronto
                                </span>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="space-y-3 text-sm text-gray-600">
                            @if($anuncio->fecha)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium">Fecha:</span>
                                    <span class="ml-2">{{ $anuncio->fecha->format('d/m/Y') }}</span>
                                </div>
                            @endif

                            @if($anuncio->hora)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">Hora:</span>
                                    <span class="ml-2">{{ strlen($anuncio->hora) > 5 ? substr($anuncio->hora, 0, 5) : $anuncio->hora }}</span>
                                </div>
                            @endif

                            @if($anuncio->lugar)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-medium">Lugar:</span>
                                    <span class="ml-2">{{ $anuncio->lugar }}</span>
                                </div>
                            @endif

                            <div class="flex items-center pt-2 border-t border-gray-200">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-xs text-gray-500">
                                    Publicado: {{ $anuncio->fecha_inicial->format('d/m/Y') }}
                                    @if($anuncio->fecha_final)
                                        - Expira: {{ $anuncio->fecha_final->format('d/m/Y') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No hay anuncios activos por el momento</h3>
                <p class="text-gray-500">Los anuncios aparecerán aquí cuando estén disponibles para tu institución y proyecto.</p>
            </div>
        @endif
</div>
@endsection

