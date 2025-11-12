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
</div>

@push('scripts')
<script>
    // Datos para las gráficas
    const materialesData = @json($graficaMateriales);
    const mensualData = @json($graficaMensual);

    // Gráfica de barras - Materiales más reciclados
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
</script>
@endpush
@endsection

