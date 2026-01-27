<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.guru-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'guru'])) {
            $request->session()->regenerate();
            return redirect()->intended('/guru/dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak cocok dengan data pengajar kami.',
        ]);
    }
}