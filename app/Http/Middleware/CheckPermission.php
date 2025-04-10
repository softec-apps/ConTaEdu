<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            if ($user->role != $role || !$user->est) {
                abort(401);
                exit;
            }
        } else {
            abort(403);
            exit;
        }

        return $next($request);
    }
}
