@extends('layouts.admin')

@section('title', 'Crear Usuario - SEDIECOTECH Rewards')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Breadcrumbs -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#34A853]">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('admin.users.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#34A853] md:ml-2">Usuarios</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Crear</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-7 h-7 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Crear Nuevo Usuario
            </h2>
            <p class="text-gray-600 mt-1">Registra un nuevo usuario y su información personal</p>
        </div>
        <a 
            href="{{ route('admin.users.index') }}" 
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Volver</span>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-6" x-data="{ usarPersonaExistente: 'nueva' }">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Selección de Persona -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-center space-x-4">
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="radio" 
                            name="tipo_persona" 
                            value="nueva" 
                            x-model="usarPersonaExistente"
                            checked
                            class="mr-2"
                        >
                        <span class="font-medium text-gray-700">Crear nueva persona</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input 
                            type="radio" 
                            name="tipo_persona" 
                            value="existente" 
                            x-model="usarPersonaExistente"
                            class="mr-2"
                        >
                        <span class="font-medium text-gray-700">Usar persona existente</span>
                    </label>
                </div>
            </div>

            <!-- Selección de Persona Existente -->
            <div x-show="usarPersonaExistente === 'existente'" x-cloak>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Seleccionar Persona Existente
                </h3>
                <div>
                    <label for="persona_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Persona <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="persona_id" 
                        name="persona_id" 
                        x-bind:required="usarPersonaExistente === 'existente'"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('persona_id') border-red-500 @enderror"
                    >
                        <option value="">Seleccione una persona</option>
                        @foreach($personasDisponibles as $persona)
                            <option value="{{ $persona->id }}" {{ old('persona_id') == $persona->id ? 'selected' : '' }}>
                                {{ $persona->nombres }} {{ $persona->apellidos }} - DNI: {{ $persona->dni }} ({{ $persona->sexo }})
                            </option>
                        @endforeach
                    </select>
                    @error('persona_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @if($personasDisponibles->isEmpty())
                        <p class="mt-2 text-sm text-yellow-600 bg-yellow-50 p-3 rounded-lg">
                            ⚠️ No hay personas disponibles sin usuario. Debe crear una nueva persona.
                        </p>
                    @endif
                </div>
            </div>

            <!-- Información Personal (Nueva Persona) -->
            <div x-show="usarPersonaExistente === 'nueva'" x-cloak>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Información Personal
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="dni" class="block text-sm font-medium text-gray-700 mb-2">
                            DNI <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="dni" 
                            name="dni" 
                            value="{{ old('dni') }}"
                            maxlength="8"
                            x-bind:required="usarPersonaExistente === 'nueva'"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('dni') border-red-500 @enderror"
                            placeholder="12345678"
                        >
                        @error('dni')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sexo" class="block text-sm font-medium text-gray-700 mb-2">
                            Sexo <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="sexo" 
                            name="sexo" 
                            x-bind:required="usarPersonaExistente === 'nueva'"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('sexo') border-red-500 @enderror"
                        >
                            <option value="">Seleccione...</option>
                            <option value="Masculino" {{ old('sexo') === 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('sexo') === 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('sexo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nombres" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombres <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nombres" 
                            name="nombres" 
                            value="{{ old('nombres') }}"
                            x-bind:required="usarPersonaExistente === 'nueva'"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('nombres') border-red-500 @enderror"
                            placeholder="Juan"
                        >
                        @error('nombres')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-2">
                            Apellidos <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="apellidos" 
                            name="apellidos" 
                            value="{{ old('apellidos') }}"
                            x-bind:required="usarPersonaExistente === 'nueva'"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('apellidos') border-red-500 @enderror"
                            placeholder="Pérez"
                        >
                        @error('apellidos')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Información de Usuario -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-[#34A853] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Información de Usuario
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de Usuario <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('name') border-red-500 @enderror"
                            placeholder="juan.perez"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="juan.perez@example.com"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Contraseña <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('password') border-red-500 @enderror"
                            placeholder="Mínimo 8 caracteres"
                        >
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirmar Contraseña <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent"
                        >
                    </div>

                    <div>
                        <label for="rol" class="block text-sm font-medium text-gray-700 mb-2">
                            Rol <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="rol" 
                            name="rol" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('rol') border-red-500 @enderror"
                        >
                            <option value="">Seleccione un rol</option>
                            <option value="Administrador" {{ old('rol') === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="Usuario" {{ old('rol') === 'Usuario' ? 'selected' : '' }}>Usuario</option>
                        </select>
                        @error('rol')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status_user" class="block text-sm font-medium text-gray-700 mb-2">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="status_user" 
                            name="status_user" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('status_user') border-red-500 @enderror"
                        >
                            <option value="Activo" {{ old('status_user', 'Activo') === 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('status_user') === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="Eliminado" {{ old('status_user') === 'Eliminado' ? 'selected' : '' }}>Eliminado</option>
                        </select>
                        @error('status_user')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">
                            Foto de Perfil (Opcional)
                        </label>
                        <input 
                            type="file" 
                            id="profile_picture" 
                            name="profile_picture" 
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#34A853] focus:border-transparent @error('profile_picture') border-red-500 @enderror"
                        >
                        @error('profile_picture')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Formatos permitidos: JPEG, PNG, JPG, GIF, WEBP. Tamaño máximo: 2MB</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a 
                    href="{{ route('admin.users.index') }}" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                >
                    Cancelar
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-[#34A853] text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg"
                >
                    Crear Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

