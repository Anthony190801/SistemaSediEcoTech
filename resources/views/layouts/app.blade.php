<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SEDIECOTECH Rewards')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roca+One&family=Alice&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FFFFFD] font-[Alice]">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-['Roca_One'] text-[#148FA7]">SEDIECOTECH</span>
                        <span class="ml-2 text-lg text-[#7BC549]">Rewards</span>
                    </a>
                </div>

                <!-- Navigation -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:ring-offset-2 rounded-full"
                            >
                                @if(auth()->user()->profile_picture)
                                    <img
                                        src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                        alt="{{ auth()->user()->name }}"
                                        class="h-10 w-10 rounded-full object-cover border-2 border-[#148FA7]"
                                    >
                                @else
                                    <div class="h-10 w-10 rounded-full bg-[#148FA7] flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                x-show="open"
                                @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-200"
                                style="display: none;"
                            >
                                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#7BC549] hover:text-white transition-colors">
                                    Página principal
                                </a>
                                @if(auth()->user()->rol === 'Administrador')
                                    <a href="{{ route('dashboard.admin') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#7BC549] hover:text-white transition-colors">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('dashboard.participant') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#7BC549] hover:text-white transition-colors">
                                        Dashboard
                                    </a>
                                @endif
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#7BC549] hover:text-white transition-colors">
                                    Mi perfil
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#7BC549] hover:text-white transition-colors">
                                    Ajustes
                                </a>
                                <hr class="my-1 border-gray-200">
                                <form method="POST" action="{{ auth()->user()->rol === 'Administrador' ? route('admin.logout') : route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-[#148FA7] hover:text-[#7BC549] transition-colors"
                        >
                            Iniciar sesión
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} SEDIECOTECH Rewards - SEDIPRO UNT
            </p>
        </div>
    </footer>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>

