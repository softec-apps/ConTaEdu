<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public function store(Request $request)
     {
         $request->validate(['email' => 'required|email']);
     
         $response = Password::sendResetLink($request->only('email'));
     
         if ($response == Password::RESET_LINK_SENT) {
             return response()->json(['success' => true, 'message' => 'Se ha enviado el enlace de restablecimiento de contraseña.']);
         } else {
             return response()->json([
                 'success' => false, 
                 'errors' => ['email' => [__($response)]]
             ]);
         }
     }
    public function showResetForm(Request $request)
    {
        return view('auth.reset-password-form', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }
    public function storePass(Request $request)
    {
        Log::info('Datos del formulario: ', $request->all());
        //dd($request->all()); // Imprime todos los datos de la solicitud para verificar el token
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
                Auth::login($user);
            }
        );

        // Registra el resultado
        if ($status === Password::PASSWORD_RESET) {
            Log::info('Password reset successfully for user with email: ' . $request->email);
            return redirect('/')->with('status', __($status)); // Redirige a la raíz
        } else {
            Log::error('Password reset failed for user with email: ' . $request->email . ' - Status: ' . $status);
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
