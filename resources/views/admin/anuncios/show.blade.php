@extends('layouts.admin')

@section('title', 'Ver Anuncio - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Detalles del Anuncio
            </h2>
            <p class="text-gray-600 mt-1">Información completa del anuncio</p>
        </div>
        <div class="flex items-center space-x-2">
            <a 
                href="{{ route('admin.anuncios.edit', $anuncio) }}" 
                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors flex items-center space-x-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Editar</span>
            </a>
            <a 
                href="{{ route('admin.anuncios.index') }}" 
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Volver</span>
            </a>
        </div>
    </div>

    <!-- Anuncio Details -->
    <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
        <!-- Header -->
        <div class="border-b border-gray-200 pb-4">
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $anuncio->motivo }}</h3>
            @php
                $estaActivo = $anuncio->estado === 'Activo' && 
                              $anuncio->fecha_inicial <= now() && 
                              ($anuncio->fecha_final === null || $anuncio->fecha_final >= now());
                $proximoExpirar = $anuncio->fecha_final && 
                                  $anuncio->fecha_final->diffInDays(now()) <= 7 && 
                                  $anuncio->fecha_final >= now();
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                {{ $estaActivo ? 'bg-green-100 text-green-800' : 
                   ($proximoExpirar ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                {{ $estaActivo ? 'Activo' : ($proximoExpirar ? 'Por expirar' : 'Inactivo') }}
            </span>
        </div>

        <!-- Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Proyecto</p>
                <p class="text-base font-semibold text-gray-900">{{ $anuncio->institucionProyecto->proyecto->nombre }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Institución</p>
                <p class="text-base font-semibold text-gray-900">{{ $anuncio->institucionProyecto->institucion->nombre }}</p>
            </div>

            @if($anuncio->fecha)
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Fecha del Evento</p>
                    <p class="text-base font-semibold text-gray-900">{{ $anuncio->fecha->format('d/m/Y') }}</p>
                </div>
            @endif

            @if($anuncio->hora)
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Hora del Evento</p>
                    <p class="text-base font-semibold text-gray-900">{{ strlen($anuncio->hora) > 5 ? substr($anuncio->hora, 0, 5) : $anuncio->hora }}</p>
                </div>
            @endif

            @if($anuncio->lugar)
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Lugar</p>
                    <p class="text-base font-semibold text-gray-900">{{ $anuncio->lugar }}</p>
                </div>
            @endif

            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Estado</p>
                <p class="text-base font-semibold text-gray-900">{{ $anuncio->estado }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Fecha Inicial de Publicación</p>
                <p class="text-base font-semibold text-gray-900">{{ $anuncio->fecha_inicial->format('d/m/Y H:i') }}</p>
            </div>

            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Fecha Final de Publicación</p>
                <p class="text-base font-semibold text-gray-900">
                    {{ $anuncio->fecha_final ? $anuncio->fecha_final->format('d/m/Y H:i') : 'Sin límite' }}
                </p>
            </div>
        </div>

        <!-- Created/Updated Info -->
        <div class="border-t border-gray-200 pt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500">
                <div>
                    <span class="font-medium">Creado:</span> {{ $anuncio->created_at->format('d/m/Y H:i') }}
                </div>
                <div>
                    <span class="font-medium">Última actualización:</span> {{ $anuncio->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

