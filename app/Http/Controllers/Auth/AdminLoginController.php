<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.admin-login');
    }

    /**
     * Handle an admin login request.
     */
    public function login(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            // Verificar que el usuario esté activo y no eliminado
            if ($user->status_user === 'Eliminado' || $user->status_user === 'Inactivo') {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Tu cuenta está inactiva o ha sido eliminada.',
                ])->onlyInput('email');
            }

            // Verificar que sea administrador
            if ($user->rol !== 'Administrador') {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'No tienes permisos para acceder como administrador.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->intended('/dashboard/admin');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }

    /**
     * Log the admin out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
