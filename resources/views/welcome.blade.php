@extends('layouts.app')

@section('title', 'SEDIECOTECH Rewards - Transforma tus acciones en recompensas')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-[#148FA7] via-[#7BC549] to-[#4FB36E] text-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">
            @php
                use Illuminate\Support\Facades\Auth;
                $adminUser = Auth::guard('admin')->user();
                $participantUser = Auth::guard('participant')->user();
                $currentUser = $adminUser ?? $participantUser;
                $isAdmin = $adminUser !== null;
            @endphp

            @if($currentUser)
                <div class="mb-6">
                    <p class="text-lg text-white/90 mb-2">Bienvenido de nuevo,</p>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-['Roca_One'] mb-4">
                        {{ $currentUser->name }}
                    </h1>
                </div>
            @else
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-['Roca_One'] mb-6">
                    Transforma tus acciones en recompensas
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto">
                    Únete a SEDIECOTECH Rewards y convierte el reciclaje en puntos, premios y un futuro más sostenible.
                </p>
            @endif

            <p class="text-lg md:text-xl text-white/80 mb-10 max-w-3xl mx-auto">
                Un sistema que impulsa el reciclaje y la sostenibilidad mediante tecnología e incentivos.
            </p>

            @if(!$currentUser)
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                    >
                        Comienza ahora
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a
                        href="#about"
                        class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white/30 hover:border-white/50 rounded-lg transition-all duration-200"
                    >
                        Conoce más
                    </a>
                </div>
            @else
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if($isAdmin)
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                        >
                            Ir al Dashboard
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a
                            href="{{ route('participant.dashboard') }}"
                            class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
                        >
                            Ver mi Dashboard
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-12 text-[#FFFFFD]" fill="currentColor" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
        </svg>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-[#FFFFFD]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-['Roca_One'] text-[#148FA7] mb-4">
                Acerca del Proyecto
            </h2>
            <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed">
                SEDIECOTECH Rewards es un sistema web desarrollado por <strong>SEDIPRO UNT</strong> que promueve la recolección de materiales reciclables en instituciones educativas, recompensando a los estudiantes por sus contribuciones al cuidado del medio ambiente.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1: Conciencia ambiental -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="text-5xl mb-4 text-center">🌱</div>
                <h3 class="text-xl font-['Roca_One'] text-[#148FA7] mb-3 text-center">
                    Conciencia Ambiental
                </h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Fomentamos la responsabilidad ecológica y el cuidado del planeta mediante acciones concretas de reciclaje.
                </p>
            </div>

            <!-- Card 2: Innovación tecnológica -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="text-5xl mb-4 text-center">🧠</div>
                <h3 class="text-xl font-['Roca_One'] text-[#148FA7] mb-3 text-center">
                    Innovación Tecnológica
                </h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Utilizamos tecnología moderna para gestionar, rastrear y optimizar el proceso de reciclaje y recompensas.
                </p>
            </div>

            <!-- Card 3: Participación estudiantil -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="text-5xl mb-4 text-center">🏫</div>
                <h3 class="text-xl font-['Roca_One'] text-[#148FA7] mb-3 text-center">
                    Participación Estudiantil
                </h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Involucramos activamente a estudiantes de diferentes niveles educativos en proyectos de sostenibilidad.
                </p>
            </div>

            <!-- Card 4: Recompensas sostenibles -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="text-5xl mb-4 text-center">🎁</div>
                <h3 class="text-xl font-['Roca_One'] text-[#148FA7] mb-3 text-center">
                    Recompensas Sostenibles
                </h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Sistema de puntos y premios que motiva la participación continua en actividades de reciclaje.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Impact/Statistics Section -->
<section id="impact" class="py-20 bg-gradient-to-br from-[#7BC549] to-[#4FB36E] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-['Roca_One'] mb-4">
                Impacto Ambiental
            </h2>
            <p class="text-lg text-white/90 max-w-3xl mx-auto">
                Nuestro compromiso con la sostenibilidad se refleja en números que crecen día a día.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Stat 1: Kilos reciclados -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center border border-white/20">
                <div class="text-4xl mb-4">♻️</div>
                <div class="text-4xl md:text-5xl font-['Roca_One'] mb-2" x-data="{ count: 0, target: {{ $totalKg }} }" x-init="setInterval(() => { if (count < target) count += Math.max(1, Math.floor(target / 50)) }, 20)">
                    <span x-text="Math.min(count, target).toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })">0</span> kg
                </div>
                <p class="text-white/90 text-lg">Materiales Reciclados</p>
            </div>

            <!-- Stat 2: Participantes -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center border border-white/20">
                <div class="text-4xl mb-4">👥</div>
                <div class="text-4xl md:text-5xl font-['Roca_One'] mb-2" x-data="{ count: 0, target: {{ $totalParticipantes }} }" x-init="setInterval(() => { if (count < target) count += Math.max(1, Math.floor(target / 50)) }, 30)">
                    <span x-text="Math.min(count, target).toLocaleString('es-PE')">0</span>
                </div>
                <p class="text-white/90 text-lg">Participantes Activos</p>
            </div>

            <!-- Stat 3: Instituciones -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center border border-white/20">
                <div class="text-4xl mb-4">🏛️</div>
                <div class="text-4xl md:text-5xl font-['Roca_One'] mb-2" x-data="{ count: 0, target: {{ $totalInstituciones }} }" x-init="setInterval(() => { if (count < target) count += 1 }, 100)">
                    <span x-text="Math.min(count, target)">0</span>
                </div>
                <p class="text-white/90 text-lg">Instituciones</p>
            </div>

            <!-- Stat 4: Proyectos -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 text-center border border-white/20">
                <div class="text-4xl mb-4">🚀</div>
                <div class="text-4xl md:text-5xl font-['Roca_One'] mb-2" x-data="{ count: 0, target: {{ $totalProyectos }} }" x-init="setInterval(() => { if (count < target) count += 1 }, 100)">
                    <span x-text="Math.min(count, target)">0</span>
                </div>
                <p class="text-white/90 text-lg">Proyectos Activos</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-[#FFFFFD]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-['Roca_One'] text-[#148FA7] mb-4">
                    Contacto
                </h2>
                <p class="text-lg text-gray-700">
                    ¿Tienes preguntas o quieres saber más sobre SEDIECOTECH Rewards?
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-center p-6 bg-gradient-to-br from-[#148FA7] to-[#7BC549] rounded-lg text-white">
                    <div class="text-3xl mb-3">📧</div>
                    <h3 class="font-semibold mb-2">Email</h3>
                    <p class="text-sm text-white/90">contacto@sediecotech.com</p>
                </div>

                <div class="text-center p-6 bg-gradient-to-br from-[#7BC549] to-[#4FB36E] rounded-lg text-white">
                    <div class="text-3xl mb-3">🏛️</div>
                    <h3 class="font-semibold mb-2">Institución</h3>
                    <p class="text-sm text-white/90">SEDIPRO UNT</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Smooth scroll para los enlaces de ancla
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
