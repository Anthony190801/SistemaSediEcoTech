<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-2xl font-['Roca_One'] text-[#148FA7]">SEDIECOTECH</span>
                    <span class="ml-2 text-lg text-[#7BC549]">Rewards</span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-[#148FA7] transition-colors">
                    Inicio
                </a>
                <a href="#about" class="text-sm font-medium text-gray-700 hover:text-[#148FA7] transition-colors">
                    Acerca del proyecto
                </a>
                <a href="#impact" class="text-sm font-medium text-gray-700 hover:text-[#148FA7] transition-colors">
                    Impacto ambiental
                </a>
                <a href="#contact" class="text-sm font-medium text-gray-700 hover:text-[#148FA7] transition-colors">
                    Contacto
                </a>
            </div>

            <!-- Right Side: Auth or User Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Welcome Message (Desktop) -->
                    <div class="hidden lg:block text-sm text-gray-600">
                        Bienvenido, <span class="font-semibold text-[#148FA7]">{{ auth()->user()->name }}</span>
                    </div>

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
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#7BC549] hover:text-white transition-colors">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('participant.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#7BC549] hover:text-white transition-colors">
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
                        class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#148FA7] to-[#7BC549] hover:from-[#7BC549] hover:to-[#4FB36E] rounded-lg transition-all duration-200 shadow-md hover:shadow-lg"
                    >
                        Iniciar sesión
                    </a>
                @endauth
            </div>
        </div>
    </nav>
</header>

