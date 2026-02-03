<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika sudah login sebagai siswa, langsung ke dashboard
        if (Auth::guard('web')->check()) {
            return redirect()->route('student.dashboard');
        }
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // PERBAIKAN: Gunakan guard('web') dan kunci role 'pendaftar' (atau 'siswa')
        if (Auth::guard('web')->attempt(array_merge($credentials, ['role' => 'pendaftar']))) {

            $request->session()->regenerate();
            return redirect()->intended('/dashboard-siswa');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau Anda bukan akun siswa.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        // Agar session Admin di tab lain TIDAK ikut mati, 
        // jangan gunakan $request->session()->invalidate() secara total 
        // jika Anda ingin membiarkan user login di dua role berbeda sekaligus.
        // Cukup hapus session milik guard ini saja:

        return redirect('/login-siswa')->with('success', 'Berhasil keluar.');
    }
}
