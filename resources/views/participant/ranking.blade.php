@extends('layouts.participant')

@section('title', 'Ranking - SEDIECOTECH Rewards')

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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Ranking</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
            <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
            </svg>
            Ranking Institucional
        </h2>
        <p class="text-gray-600 mt-1">{{ $participante->institucionProyecto->institucion->nombre }} - {{ $participante->institucionProyecto->proyecto->nombre }}</p>
    </div>

    <!-- Filtro de Proyecto -->
    @if($proyectosParticipados->count() > 1)
        <div class="bg-white rounded-xl shadow-lg p-4">
            <form method="GET" action="{{ route('participant.ranking') }}" class="flex items-center space-x-4">
                <label for="proyecto_id" class="text-sm font-medium text-gray-700">Filtrar por proyecto:</label>
                <select 
                    name="proyecto_id" 
                    id="proyecto_id"
                    onchange="this.form.submit()"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                >
                    @foreach($proyectosParticipados as $proyecto)
                        <option value="{{ $proyecto->id }}" {{ $proyectoSeleccionado == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->nombre }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    @endif

    <!-- Posición del Usuario -->
    <div class="bg-gradient-to-r from-[#34A853] to-green-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-green-100 mb-1">Tu Posición</p>
                <p class="text-5xl font-bold">#{{ $posicion }}</p>
                <p class="text-green-100 mt-2">de {{ $ranking->count() }} participantes</p>
            </div>
            <div class="text-6xl">
                @if($posicion === 1)
                    🥇
                @elseif($posicion === 2)
                    🥈
                @elseif($posicion === 3)
                    🥉
                @elseif($posicion <= 10)
                    💪
                @else
                    🌱
                @endif
            </div>
        </div>
    </div>

    <!-- Tabla de Ranking -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Clasificación Completa</h2>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Posición</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nombre</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Puntaje</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-700">Diferencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ranking as $index => $participanteRanking)
                        @php
                            $esUsuario = $participanteRanking->persona_id === $user->persona_id;
                            $puntajeUsuario = $participante->puntaje_total;
                            $diferencia = $participanteRanking->puntaje_total - $puntajeUsuario;
                        @endphp
                        <tr class="border-b border-gray-100 {{ $esUsuario ? 'bg-green-50 font-semibold' : 'hover:bg-gray-50' }}">
                            <td class="py-4 px-4">
                                @if($index === 0)
                                    <span class="text-yellow-500 text-2xl">🥇</span>
                                @elseif($index === 1)
                                    <span class="text-gray-400 text-2xl">🥈</span>
                                @elseif($index === 2)
                                    <span class="text-orange-500 text-2xl">🥉</span>
                                @else
                                    <span class="text-gray-600 font-semibold">#{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-[#34A853] flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($participanteRanking->persona->nombres, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-gray-800 font-medium">
                                            {{ $participanteRanking->persona->nombres }} {{ $participanteRanking->persona->apellidos }}
                                        </p>
                                        @if($esUsuario)
                                            <span class="text-xs bg-[#34A853] text-white px-2 py-1 rounded">Tú</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="font-bold text-[#34A853] text-lg">{{ number_format($participanteRanking->puntaje_total, 0) }}</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if($esUsuario)
                                    <span class="text-xs text-gray-500">-</span>
                                @elseif($diferencia > 0)
                                    <span class="text-xs text-red-600 font-semibold">+{{ number_format($diferencia, 0) }}</span>
                                @else
                                    <span class="text-xs text-green-600 font-semibold">{{ number_format(abs($diferencia), 0) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

