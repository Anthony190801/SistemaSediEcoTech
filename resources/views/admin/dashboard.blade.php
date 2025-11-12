@extends('layouts.admin')

@section('title', 'Dashboard - SEDIECOTECH Rewards')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
        <p class="text-gray-600 mt-1">Resumen general del sistema SEDIECOTECH Rewards</p>
    </div>

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <!-- Total Proyectos Activos -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border-l-4 border-[#34A853]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Proyectos Activos</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProyectos }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-[#34A853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Instituciones -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Instituciones</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalInstituciones }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Participantes -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Participantes</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalParticipantes }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kg Reciclados -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Material Reciclado</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($totalKgReciclados, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">kilogramos</p>
                </div>
                <div class="bg-orange-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Premios Disponibles -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Premios Disponibles</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPremios }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Gráfica de Materiales más Reciclados -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Materiales Más Reciclados</h3>
            <div class="h-80">
                <canvas id="materialesChart"></canvas>
            </div>
        </div>

        <!-- Gráfica de Participación Mensual -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Participación Mensual ({{ now()->year }})</h3>
            <div class="h-80">
                <canvas id="mensualChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Sección de Análisis de Recolecciones -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Análisis de Recolecciones
        </h2>

        <!-- Panel de Estadísticas de Recolecciones -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-blue-500">
                <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Materiales</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalMateriales }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-green-500">
                <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Kg Reciclados</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalKgReciclados, 2) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-yellow-500">
                <div class="flex-shrink-0 bg-yellow-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Puntos Generados</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalPuntosGenerados, 0) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-purple-500">
                <div class="flex-shrink-0 bg-purple-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Material Top</p>
                    <p class="text-lg font-bold text-gray-900">{{ $materialMasReciclado?->nombre ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-500">{{ $materialMasReciclado ? number_format($materialMasReciclado->total_kg, 2) . ' kg' : '' }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-5 flex items-center space-x-4 border-l-4 border-indigo-500">
                <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Institución Top</p>
                    <p class="text-lg font-bold text-gray-900">{{ $institucionMayorRecoleccion?->nombre ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-500">{{ $institucionMayorRecoleccion ? number_format($institucionMayorRecoleccion->total_kg, 2) . ' kg' : '' }}</p>
                </div>
            </div>
        </div>

        <!-- Gráficos de Recolecciones -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Recolección por Institución (Kg)</h3>
                <div class="h-80">
                    <canvas id="institucionesChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Materiales Reciclados</h3>
                <div class="h-80">
                    <canvas id="materialesRecicladosChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Evolución de Recolecciones (Últimos 30 días)</h3>
            <div class="h-80">
                <canvas id="evolucionChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Datos para las gráficas
    const materialesData = @json($graficaMaterialesTop);
    const mensualData = @json($graficaMensual);
    const institucionesData = @json($graficaInstituciones);
    const materialesRecicladosData = @json($graficaMateriales);
    const evolucionData = @json($graficaEvolucion);

    // Gráfica de barras - Materiales más reciclados (Top 6)
    const materialesCtx = document.getElementById('materialesChart').getContext('2d');
    new Chart(materialesCtx, {
        type: 'bar',
        data: {
            labels: materialesData.map(item => item.nombre),
            datasets: [{
                label: 'Kilogramos Reciclados',
                data: materialesData.map(item => item.total_kg),
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
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y.toFixed(2) + ' kg';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' kg';
                        }
                    }
                }
            }
        }
    });

    // Gráfica de línea - Participación mensual
    const mensualCtx = document.getElementById('mensualChart').getContext('2d');
    new Chart(mensualCtx, {
        type: 'line',
        data: {
            labels: mensualData.map(item => item.mes),
            datasets: [{
                label: 'Recolecciones Validadas',
                data: mensualData.map(item => item.total),
                borderColor: '#34A853',
                backgroundColor: 'rgba(52, 168, 83, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#34A853',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
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
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' recolecciones';
                        }
                    }
                }
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

    // Gráfica de Instituciones (Barras)
    const institucionesCtx = document.getElementById('institucionesChart').getContext('2d');
    new Chart(institucionesCtx, {
        type: 'bar',
        data: {
            labels: institucionesData.map(item => item.nombre),
            datasets: [{
                label: 'Kilogramos Reciclados',
                data: institucionesData.map(item => item.total_kg),
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
                        callback: function(value) {
                            return value + ' kg';
                        }
                    }
                }
            }
        }
    });

    // Gráfica de Materiales Reciclados (Torta)
    const materialesRecicladosCtx = document.getElementById('materialesRecicladosChart').getContext('2d');
    new Chart(materialesRecicladosCtx, {
        type: 'doughnut',
        data: {
            labels: materialesRecicladosData.map(item => item.nombre),
            datasets: [{
                data: materialesRecicladosData.map(item => item.total_kg),
                backgroundColor: [
                    '#34A853', '#2d8f47', '#1e6b33', '#0f4719',
                    '#4ade80', '#22c55e', '#16a34a', '#15803d'
                ],
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

    // Gráfica de Evolución (Línea)
    const evolucionCtx = document.getElementById('evolucionChart').getContext('2d');
    new Chart(evolucionCtx, {
        type: 'line',
        data: {
            labels: evolucionData.map(item => item.fecha),
            datasets: [{
                label: 'Kilogramos Reciclados',
                data: evolucionData.map(item => item.total_kg),
                borderColor: '#34A853',
                backgroundColor: 'rgba(52, 168, 83, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
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
                        callback: function(value) {
                            return value + ' kg';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection

