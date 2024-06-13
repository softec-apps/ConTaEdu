<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        // return view('auth.login');
        if (Auth::check()) {
            return self::redirectTo(Auth::user()->role);
        }
        return view('auth.login');
    }

    /**
     * Private function with the redirection logic
     */
    private function redirectTo($role): RedirectResponse
    {
        // Check user rol to redirection
        switch ($role)
        {
            case 1:
                return redirect()->intended(route('admin.dashboard', absolute: false));
            case 2:
                return redirect()->intended(route('docente.dashboard', absolute: false));
            case 3:
                return redirect()->intended(route('estudiante.dashboard', absolute: false));
            default:
                return redirect()->intended(route('login'));
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return self::redirectTo($request->user()->role);
    }

    /**
     * Check an authenticated session.
     */
    public function redirectIfAuthenticated(Request $request): RedirectResponse
    {
        if (Auth::guard('web')->check()) {
            return self::redirectTo(Auth::user()->role);
        }
        return redirect()->route('login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
