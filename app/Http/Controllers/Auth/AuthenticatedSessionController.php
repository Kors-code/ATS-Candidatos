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
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validar que vengan los campos básicos
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->input('login');

        // Si es email, usamos la columna "email", si no, "username"
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        // Intentamos autenticar
        if (Auth::attempt([$fieldType => $login, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirigimos al home (ruta "/"), que definiste como 'home'
            return redirect()->intended(route('home'));
        }

        // En caso de fallo, volvemos atrás con errores y dejamos el campo 'login' relleno
        return back()
            ->withErrors([
                'login' => __('auth.failed'),
            ])
            ->onlyInput('login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
