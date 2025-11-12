@php
    // Detectar qué guard está activo
    $adminUser = Auth::guard('admin')->user();
    $participantUser = Auth::guard('participant')->user();
    $currentUser = $adminUser ?? $participantUser;
    $isAdmin = $adminUser !== null;
    $isParticipant = $participantUser !== null;
@endphp

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
                @if($currentUser)
                    <!-- Welcome Message (Desktop) -->
                    <div class="hidden lg:block text-sm text-gray-600">
                        Bienvenido, <span class="font-semibold text-[#148FA7]">{{ $currentUser->name }}</span>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-4" x-data="{ open: false }">
                        <div class="relative">
                            <button
                                @click="open = !open"
                                class="flex items-center space-x-3 focus:outline-none focus:ring-2 focus:ring-[#34A853] focus:ring-offset-2 rounded-full"
                            >
                                @if($currentUser->profile_picture)
                                    <img
                                        src="{{ asset('storage/' . $currentUser->profile_picture) }}"
                                        alt="{{ $currentUser->name }}"
                                        class="h-10 w-10 rounded-full object-cover border-2 border-[#34A853]"
                                    >
                                @else
                                    <div class="h-10 w-10 rounded-full bg-[#34A853] flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($currentUser->name, 0, 1)) }}
                                    </div>
                                @endif
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200"
                                style="display: none;"
                            >
                                @php
                                    $isOnHomePage = request()->routeIs('home');
                                    $isOnAdminDashboard = request()->routeIs('admin.dashboard') || request()->routeIs('admin.*');
                                    $isOnParticipantDashboard = request()->routeIs('participant.dashboard') || request()->routeIs('participant.*');
                                    $isOnDashboard = $isOnAdminDashboard || $isOnParticipantDashboard;
                                @endphp

                                @if(!$isOnHomePage)
                                    <a
                                        href="{{ route('home') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                    >
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        Página principal
                                    </a>
                                @endif

                                @if($isAdmin)
                                    @if(!$isOnAdminDashboard)
                                        <a
                                            href="{{ route('admin.dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                        >
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            Dashboard
                                        </a>
                                    @endif
                                    <a
                                        href="{{ route('admin.profile.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                    >
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Mi perfil
                                    </a>
                                    <a
                                        href="{{ route('admin.settings.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                    >
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Configuración
                                    </a>
                                @else
                                    @if(!$isOnParticipantDashboard)
                                        <a
                                            href="{{ route('participant.dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                        >
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            Dashboard
                                        </a>
                                    @endif
                                    <a
                                        href="{{ route('participant.profile.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                    >
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Mi perfil
                                    </a>
                                    <a
                                        href="{{ route('participant.settings.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                    >
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Configuración
                                    </a>
                                @endif
                                <form action="{{ $isAdmin ? route('admin.logout') : route('logout') }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors"
                                    >
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-[#148FA7] to-[#7BC549] hover:from-[#7BC549] hover:to-[#4FB36E] rounded-lg transition-all duration-200 shadow-md hover:shadow-lg"
                    >
                        Iniciar sesión
                    </a>
                @endif
            </div>
        </div>
    </nav>
</header>

