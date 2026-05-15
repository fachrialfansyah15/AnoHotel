<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public const ROLES = [
        'admin',
        'manager',
        'receptionist',
        'housekeeping',
        'guest',
    ];

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register', [
            'roles' => self::ROLES,
        ]);
    }

    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:' . implode(',', self::ROLES),
        ]);

        User::create([
            'name'     => $attributes['name'],
            'email'    => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'role'     => $attributes['role'],
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau password tidak valid.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
