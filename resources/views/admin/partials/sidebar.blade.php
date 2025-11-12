<aside 
    x-data="{ mobileOpen: false }"
    @toggle-sidebar.window="mobileOpen = !mobileOpen"
    class="bg-[#34A853] text-white w-64 flex-shrink-0 flex flex-col fixed md:relative h-full z-40 transition-transform duration-300 ease-in-out"
    :class="{ '-translate-x-full md:translate-x-0': !mobileOpen }"
    x-init="mobileOpen = false"
>
    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-6 border-b border-green-600">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
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
            href="{{ route('admin.dashboard') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <a 
            href="{{ route('admin.proyectos.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.proyectos.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <span class="font-medium">Proyectos</span>
        </a>

        <a 
            href="{{ route('admin.users.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span class="font-medium">Usuarios</span>
        </a>

        <a 
            href="{{ route('admin.participantes.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.participantes.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <span class="font-medium">Participantes</span>
        </a>

        <a 
            href="{{ route('admin.materiales.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.materiales.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <span class="font-medium">Materiales</span>
        </a>

        <a 
            href="{{ route('admin.premios.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.premios.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
            <span class="font-medium">Premios</span>
        </a>

        <a 
            href="{{ route('admin.recolecciones.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.recolecciones.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <span class="font-medium">Recolecciones</span>
        </a>

        <a 
            href="{{ route('admin.canjes.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.canjes.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
            <span class="font-medium">Canjes</span>
        </a>

        <a 
            href="{{ route('admin.anuncios.index') }}" 
            class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.anuncios.*') ? 'bg-green-600 text-white' : 'text-green-100 hover:bg-green-600 hover:text-white' }}"
        >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
            </svg>
            <span class="font-medium">Anuncios</span>
        </a>

    </nav>

    <!-- Logout Button -->
    <div class="px-4 py-4 border-t border-green-600">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button 
                type="submit"
                class="w-full flex items-center px-4 py-3 rounded-lg text-green-100 hover:bg-red-600 hover:text-white transition-colors"
            >
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="font-medium">Cerrar sesión</span>
            </button>
        </form>
    </div>
</aside>

