@extends('layouts.app')

@section('title', 'Registro - Administrador')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#148FA7] to-[#7BC549] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8 bg-white rounded-2xl shadow-xl p-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-['Roca_One'] text-[#148FA7]">
                Registro de Administrador
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Crea una cuenta de administrador
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('admin.register') }}" method="POST" enctype="multipart/form-data">
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- DNI -->
                <div>
                    <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">
                        DNI <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="dni"
                        name="dni"
                        type="text"
                        maxlength="8"
                        required
                        value="{{ old('dni') }}"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="12345678"
                    >
                </div>

                <!-- Sexo -->
                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-700 mb-1">
                        Sexo <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="sexo"
                        name="sexo"
                        required
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                    >
                        <option value="">Seleccione...</option>
                        <option value="Masculino" {{ old('sexo') === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('sexo') === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>

                <!-- Nombres -->
                <div>
                    <label for="nombres" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombres <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="nombres"
                        name="nombres"
                        type="text"
                        required
                        value="{{ old('nombres') }}"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="Juan"
                    >
                </div>

                <!-- Apellidos -->
                <div>
                    <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-1">
                        Apellidos <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="apellidos"
                        name="apellidos"
                        type="text"
                        required
                        value="{{ old('apellidos') }}"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="Pérez"
                    >
                </div>

                <!-- Nombre de usuario -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre de usuario <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        required
                        value="{{ old('name') }}"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="juan.perez"
                    >
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Correo electrónico <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        required
                        value="{{ old('email') }}"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="admin@sediecotech.com"
                    >
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Contraseña <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="Mínimo 8 caracteres"
                    >
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirmar contraseña <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                        placeholder="Repite la contraseña"
                    >
                </div>

                <!-- Foto de perfil -->
                <div class="md:col-span-2">
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-1">
                        Foto de perfil (opcional)
                    </label>
                    <input
                        id="profile_picture"
                        name="profile_picture"
                        type="file"
                        accept="image/*"
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#148FA7] focus:border-transparent transition-colors"
                    >
                    <p class="mt-1 text-xs text-gray-500">Formatos: JPEG, PNG, JPG, GIF. Máximo 2MB.</p>
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-[#148FA7] to-[#7BC549] hover:from-[#7BC549] hover:to-[#4FB36E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#148FA7] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                >
                    Registrarse
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('admin.login') }}" class="font-medium text-[#148FA7] hover:text-[#7BC549] transition-colors">
                        Inicia sesión aquí
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection

