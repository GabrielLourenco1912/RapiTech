<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create_dev(): View
    {
        return view('auth.register_dev');
    }
    public function create_cliente(): View
    {
        return view('auth.register_cliente');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->routeIs('register_dev_post')) {
            $data['role_id'] = '2';
        } elseif ($request->routeIs('register_cliente_post')) {
            $data['role_id'] = '3';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $data['role_id'],
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($request->routeIs('register_dev_post')) {
            return redirect(route('dashboard_dev', absolute: false));
        } elseif ($request->routeIs('register_cliente_post')) {
            return redirect(route('dashboard_cliente', absolute: false));
        }
        return redirect(route('welcome', absolute: false));
    }
}
