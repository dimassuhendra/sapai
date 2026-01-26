<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    // Menampilkan halaman login siswa
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    // Proses login siswa
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Cek apakah yang login benar-benar pendaftar/siswa
            if (Auth::user()->role === 'pendaftar') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard-siswa');
            }

            // Jika bukan pendaftar, logout kembali
            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda bukan akun siswa.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Logout siswa
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login-siswa');
    }
}
