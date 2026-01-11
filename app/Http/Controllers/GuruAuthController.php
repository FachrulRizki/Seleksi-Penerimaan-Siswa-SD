<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('guru')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::guard('guru')->user()->is_active === false) {
                Auth::guard('guru')->logout();
                return back()->withInput($request->only('username'))
                    ->withErrors(['username' => 'Akun guru nonaktif.']);
            }

            return redirect()->route('guru.dashboard');
        }

        return back()->withInput($request->only('username'))
            ->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('guru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
