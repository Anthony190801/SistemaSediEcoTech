@extends('layouts.app')

@section('title', 'Iniciar Sesión - Administrador')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#148FA7] to-[#7BC549] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white rounded-2xl shadow-xl p-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-['Roca_One'] text-[#148FA7]">
                Iniciar Sesión
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Accede al panel de administración
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('admin.login') }}" method="POST">
            @csrf

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Correo electrónico
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        required
                        value="{{ old('email') }}"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="admin@sediecotech.com"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Contraseña
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="••••••••"
                    >
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 text-[#148FA7] focus:ring-[#148FA7] border-gray-300 rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Recordarme
                    </label>
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-[#148FA7] to-[#7BC549] hover:from-[#7BC549] hover:to-[#4FB36E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#148FA7] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                >
                    Iniciar Sesión
                </button>
            </div>

            <div class="text-center space-y-2">
                <p class="text-sm text-gray-600">
                    ¿No tienes cuenta?
                    <a href="{{ route('admin.register') }}" class="font-medium text-[#148FA7] hover:text-[#7BC549] transition-colors">
                        Regístrate aquí
                    </a>
                </p>
                <p class="text-sm text-gray-600">
                    ¿Eres participante?
                    <a href="{{ route('login') }}" class="font-medium text-[#148FA7] hover:text-[#7BC549] transition-colors">
                        Inicia sesión aquí
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection

