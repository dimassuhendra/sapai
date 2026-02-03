<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // PERBAIKAN: Gunakan check() bukan attempt() untuk mengecek apakah sudah login
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // PERBAIKAN: Gunakan guard('admin') dan masukkan syarat 'role' => 'admin'
        // Ini memastikan session yang dibuat terpisah dari guard 'web' (siswa)
        if (Auth::guard('admin')->attempt(array_merge($credentials, ['role' => 'admin']))) {

            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau Anda bukan administrator.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // PERBAIKAN: Logout hanya untuk guard admin
        Auth::guard('admin')->logout();

        // Jangan invalidate total jika ingin session guard lain (siswa) tetap aman
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar.');
    }
}
