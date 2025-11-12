@extends('layouts.admin')

@section('title', 'Detalles del Canje - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Detalles del Canje
            </h2>
            <p class="text-gray-600 mt-1">Información completa del canje de premio</p>
        </div>
        <a 
            href="{{ route('admin.canjes.index') }}" 
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

    <!-- Canje Info Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Participante Info -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Participante
                </h3>
                <div class="space-y-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nombre Completo</p>
                        <p class="text-gray-900">{{ $canje->participante->persona->nombres }} {{ $canje->participante->persona->apellidos }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">DNI</p>
                        <p class="text-gray-900">{{ $canje->participante->persona->dni }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Institución</p>
                        <p class="text-gray-900">{{ $canje->participante->institucionProyecto->institucion->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Proyecto</p>
                        <p class="text-gray-900">{{ $canje->participante->institucionProyecto->proyecto->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Puntaje Total</p>
                        <p class="text-gray-900 font-semibold">{{ number_format($canje->participante->puntaje_total, 0) }} pts</p>
                    </div>
                </div>
            </div>

            <!-- Premio Info -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    Premio
                </h3>
                <div class="space-y-2">
                    @if($canje->premio->articulo->url_foto)
                        <div class="mb-3">
                            <img 
                                src="{{ asset('storage/' . $canje->premio->articulo->url_foto) }}" 
                                alt="{{ $canje->premio->articulo->nombre }}" 
                                class="w-24 h-24 object-cover rounded-lg"
                            >
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500">Artículo</p>
                        <p class="text-gray-900 font-semibold">{{ $canje->premio->articulo->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tipo de Canje</p>
                        <p class="text-gray-900">{{ $canje->premio->tipo }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">
                            @if($canje->premio->tipo === 'Canje por puntaje')
                                Puntaje Requerido
                            @else
                                Posición Requerida
                            @endif
                        </p>
                        <p class="text-gray-900 font-semibold">
                            @if($canje->premio->tipo === 'Canje por puntaje')
                                {{ number_format($canje->premio->puntaje_requerido ?? 0, 0) }} pts
                            @else
                                Posición #{{ $canje->premio->posicion_requerida ?? 'N/A' }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Fecha de Solicitud</p>
                        <p class="text-gray-900">{{ $canje->fecha_solicitud_canje->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Estado</p>
                        @php
                            $estadoColors = [
                                'Pendiente' => 'bg-yellow-100 text-yellow-800',
                                'Programado' => 'bg-purple-100 text-purple-800',
                                'Entregado' => 'bg-green-100 text-green-800',
                            ];
                            $color = $estadoColors[$canje->estado] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $color }}">
                            {{ $canje->estado }}
                        </span>
                    </div>
                    @if($canje->fecha_entrega)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Fecha de Entrega</p>
                            <p class="text-gray-900">{{ $canje->fecha_entrega->format('d/m/Y H:i') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Respuesta/Programación -->
        @if($canje->respuesta)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Información de Entrega Programada
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Lugar</p>
                        <p class="text-gray-900">{{ $canje->respuesta->lugar }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Fecha Programada</p>
                        <p class="text-gray-900">{{ $canje->respuesta->fecha_programada->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Hora</p>
                        <p class="text-gray-900">{{ $canje->respuesta->hora }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Action Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Acciones</h3>
        
        @if($canje->estado === 'Pendiente')
            <!-- Formulario para Programar Entrega -->
            <form action="{{ route('admin.canjes.update', $canje) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="estado" value="Programado">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="lugar" class="block text-sm font-medium text-gray-700 mb-2">
                            Lugar de Entrega <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="lugar" 
                            name="lugar" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                            placeholder="Ej: Oficina Principal"
                        >
                    </div>
                    <div>
                        <label for="fecha_programada" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha Programada <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            id="fecha_programada" 
                            name="fecha_programada" 
                            required
                            min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                    </div>
                    <div>
                        <label for="hora" class="block text-sm font-medium text-gray-700 mb-2">
                            Hora <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="time" 
                            id="hora" 
                            name="hora" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors"
                >
                    Programar Entrega
                </button>
            </form>
        @elseif($canje->estado === 'Programado')
            <!-- Botón para Marcar como Entregado -->
            <form action="{{ route('admin.canjes.update', $canje) }}" method="POST" onsubmit="return confirm('¿Confirmas que el premio ha sido entregado?');">
                @csrf
                @method('PUT')
                <input type="hidden" name="estado" value="Entregado">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors"
                >
                    Marcar como Entregado
                </button>
            </form>
        @else
            <p class="text-gray-600">Este canje ya ha sido completado y entregado.</p>
        @endif
    </div>
</div>
@endsection

