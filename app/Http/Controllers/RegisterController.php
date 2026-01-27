<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Mengambil semua program untuk dropdown
        $programs = DB::table('programs')->orderBy('urutan', 'asc')->get();
        return view('auth.student-register', compact('programs'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|unique:users,username|max:255',
            'email'        => 'required|email|unique:users,email',
            'no_telp'      => 'required|numeric|digits_between:10,15',
            'password'     => 'required|min:8|confirmed',
            'program_id'   => 'required|exists:programs,id',
        ]);

        $dataPendaftaran = DB::transaction(function () use ($request) {
            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'username'     => $request->username,
                'email'        => $request->email,
                'no_telp'      => $request->no_telp,
                'password'     => Hash::make($request->password),
                'role'         => 'pendaftar',
                'foto_profil'  => 'default.jpg',
            ]);

            $program = DB::table('programs')->where('id', $request->program_id)->first();

            DB::table('enrollments')->insert([
                'user_id' => $user->id,
                'program_id' => $request->program_id,
                'status_bayar' => 'pending',
                'tgl_daftar' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Kembalikan data untuk ditampilkan di Modal
            return [
                'nama' => $user->nama_lengkap,
                'email' => $user->email,
                'program' => $program->nama_program,
                'harga' => $program->harga
            ];
        });

        // Kirim data pendaftaran ke session flash
        return redirect()->route('student.login')->with('success_register', $dataPendaftaran);
    }
}
