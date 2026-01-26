<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Password hanya divalidasi jika diisi
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil dan password berhasil diperbarui!');
    }
}
