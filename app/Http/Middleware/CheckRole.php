<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Verificar que el usuario esté activo
        if ($user->status_user === 'Eliminado' || $user->status_user === 'Inactivo') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->withErrors([
                'email' => 'Tu cuenta está inactiva o ha sido eliminada.',
            ]);
        }

        // Verificar que el usuario tenga uno de los roles permitidos
        if (! in_array($user->rol, $roles)) {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }

        return $next($request);
    }
}
