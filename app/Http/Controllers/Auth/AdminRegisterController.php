<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminRegisterController extends Controller
{
    /**
     * Show the admin registration form.
     */
    public function showRegistrationForm(): View
    {
        return view('auth.admin-register');
    }

    /**
     * Handle an admin registration request.
     */
    public function register(AdminRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Crear la persona primero
        $persona = Persona::create([
            'dni' => $validated['dni'],
            'nombres' => $validated['nombres'],
            'apellidos' => $validated['apellidos'],
            'sexo' => $validated['sexo'],
        ]);

        // Manejar la imagen de perfil si existe
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        // Crear el usuario administrador
        $user = User::create([
            'persona_id' => $persona->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_picture' => $profilePicturePath,
            'rol' => 'Administrador',
            'status_user' => 'Activo',
        ]);

        // Iniciar sesión automáticamente
        Auth::guard('admin')->login($user);

        $request->session()->regenerate();

        return redirect('/dashboard/admin');
    }
}
