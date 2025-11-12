@extends('layouts.app')

@section('title', 'Dashboard - Participante')

@section('content')
<div class="min-h-screen bg-[#FFFFFD] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-['Roca_One'] text-[#148FA7] mb-4">
                Bienvenido, {{ auth()->user()->name }}
            </h1>
            <p class="text-gray-600 mb-6">
                Este es tu panel de participante. Aquí podrás ver tus puntos, premios y más.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-[#148FA7] to-[#7BC549] rounded-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Puntos Totales</h3>
                    <p class="text-3xl font-bold">0</p>
                </div>
                <div class="bg-gradient-to-br from-[#7BC549] to-[#4FB36E] rounded-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Premios Disponibles</h3>
                    <p class="text-3xl font-bold">0</p>
                </div>
                <div class="bg-gradient-to-br from-[#4FB36E] to-[#29A493] rounded-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Mi Ranking</h3>
                    <p class="text-3xl font-bold">#0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

