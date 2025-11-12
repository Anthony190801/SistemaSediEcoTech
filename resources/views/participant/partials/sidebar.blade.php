<aside 
    x-data="{ mobileOpen: false }"
    @toggle-sidebar.window="mobileOpen = !mobileOpen"
    class="bg-[#34A853] text-white w-64 flex-shrink-0 flex flex-col fixed md:relative h-full z-40 transition-transform duration-300 ease-in-out"
    :class="{ '-translate-x-full md:translate-x-0': !mobileOpen }"
    x-init="mobileOpen = false"
>
    <!-- Logo y Header -->
    <div class="flex items-center justify-between h-16 px-6 border-b border-green-600">
        <a href="{{ route('participant.dashboard') }}" class="flex items-center">
            <span class="text-xl font-['Roca_One'] text-white">SEDIECOTECH</span>
            <span class="ml-2 text-sm text-green-100">Rewards</span>
        </a>
        <button 
            @click="mobileOpen = false"
            class="md:hidden text-white hover:text-green-100"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a 
            href="{{ route('participant.dashboard') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('participant.dashboard') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <a 
            href="{{ route('participant.profile.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('participant.profile.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="font-medium">Mi Perfil</span>
        </a>

        <a 
            href="{{ route('participant.ranking') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('participant.ranking') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
            </svg>
            <span class="font-medium">Ranking</span>
        </a>

        <a 
            href="{{ route('participant.premios') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('participant.premios') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
            <span class="font-medium">Premios</span>
        </a>

        <a 
            href="{{ route('participant.canjes') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('participant.canjes') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <span class="font-medium">Mis Canjes</span>
        </a>

        <a 
            href="{{ route('participant.anuncios.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('participant.anuncios.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
            </svg>
            <span class="font-medium">Anuncios</span>
        </a>
    </nav>

    <!-- Logout Button -->
    <div class="mt-auto px-4 py-4 border-t border-green-600">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button 
                type="submit"
                class="w-full flex items-center px-4 py-3 rounded-lg text-green-100 hover:bg-red-600 hover:text-white transition-colors"
            >
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="font-medium">Cerrar Sesión</span>
            </button>
        </form>
    </div>
</aside>

