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
                <a 
                    href="mailto:sedipro@unitru.edu.pe"
                    class="text-center p-6 bg-gradient-to-br from-[#148FA7] to-[#7BC549] rounded-lg text-white hover:from-[#7BC549] hover:to-[#4FB36E] transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#34A853] focus:ring-offset-2"
                    aria-label="Enviar correo a SEDIPRO UNT"
                >
                    <div class="text-3xl mb-3">📧</div>
                    <h3 class="font-semibold mb-2">Email</h3>
                    <p class="text-sm text-white/90">sedipro@unitru.edu.pe</p>
                </a>

                <div class="text-center p-6 bg-gradient-to-br from-[#7BC549] to-[#4FB36E] rounded-lg text-white">
                    <div class="text-3xl mb-3">🏛️</div>
                    <h3 class="font-semibold mb-2">Institución</h3>
                    <p class="text-sm text-white/90">SEDIPRO UNT</p>
                </div>
            </div>

            <!-- Redes Sociales -->
            <div class="mt-8">
                <h3 class="text-xl font-['Roca_One'] text-[#148FA7] mb-4 text-center">Síguenos en nuestras redes</h3>
                <div class="flex justify-center space-x-6">
                    <a 
                        href="https://www.facebook.com/SediproUNT" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="w-12 h-12 bg-[#148FA7] hover:bg-[#7BC549] rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-[#34A853] focus:ring-offset-2" 
                        aria-label="Síguenos en Facebook"
                        title="Facebook de SEDIPRO UNT"
                    >
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    </a>
                    <a 
                        href="https://www.instagram.com/sedipro.unt/" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="w-12 h-12 bg-[#148FA7] hover:bg-[#7BC549] rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-[#34A853] focus:ring-offset-2" 
                        aria-label="Síguenos en Instagram"
                        title="Instagram de SEDIPRO UNT"
                    >
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    </a>
                    <a 
                        href="https://www.linkedin.com/company/sediprount/" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="w-12 h-12 bg-[#148FA7] hover:bg-[#7BC549] rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-[#34A853] focus:ring-offset-2" 
                        aria-label="Síguenos en LinkedIn"
                        title="LinkedIn de SEDIPRO UNT"
                    >
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                    </a>
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
