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
    public function create_admin(): View
    {
        return view('auth.login_admin');
    }
    public function create_dev(): View
    {
        return view('auth.login_dev');
    }
    public function create_cliente(): View
    {
        return view('auth.login_cliente');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();


        if(auth()->user()->role_id == '1') {
            return redirect()->intended(route('dashboard_admin', absolute: false));
        } elseif (auth()->user()->role_id == '2') {
            return redirect()->intended(route('dashboard_dev', absolute: false));
        } else {
            return redirect()->intended(route('dashboard_cliente', absolute: false));
        }
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
