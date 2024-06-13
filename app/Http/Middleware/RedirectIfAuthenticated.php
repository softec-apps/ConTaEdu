<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el usuario está autenticado
        if (\Auth::check()) {
            $user = \Auth::user();

            // Redirige al dashboard adecuado basado en el rol del usuario
            switch ($user->role) {
                case 1:
                    return redirect()->route('admin.dashboard');
                case 2:
                    return redirect()->route('docente.dashboard');
                case 3:
                    return redirect()->route('estudiante.dashboard');
                default:
                    return redirect('/');
            }
        }

        return $next($request);
    }
}
