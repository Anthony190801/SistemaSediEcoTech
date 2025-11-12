<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ParticipantLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ParticipantLoginController extends Controller
{
    /**
     * Show the participant login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.participant-login');
    }

    /**
     * Handle a participant login request.
     */
    public function login(ParticipantLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::guard('participant')->attempt($credentials)) {
            $user = Auth::guard('participant')->user();

            // Verificar que el usuario esté activo y no eliminado
            if ($user->status_user === 'Eliminado' || $user->status_user === 'Inactivo') {
                Auth::guard('participant')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Tu cuenta está inactiva o ha sido eliminada.',
                ])->onlyInput('email');
            }

            // Verificar que sea usuario (participante)
            if ($user->rol !== 'Usuario') {
                Auth::guard('participant')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'No tienes permisos para acceder como participante.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->intended('/dashboard/participant');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }

    /**
     * Log the participant out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('participant')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
