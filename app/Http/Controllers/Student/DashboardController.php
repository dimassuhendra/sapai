<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Mengambil data pendaftaran siswa saat ini join dengan tabel programs
        $enrollment = DB::table('enrollments')
            ->join('programs', 'enrollments.program_id', '=', 'programs.id')
            ->where('enrollments.user_id', $userId)
            ->select('enrollments.*', 'programs.nama_program', 'programs.harga', 'programs.durasi')
            ->first();

        // Mengambil statistik progres (Contoh sederhana)
        $totalMateri = DB::table('materials')
            ->where('program_id', $enrollment->program_id ?? 0)
            ->count();

        $materiSelesai = DB::table('progress')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        return view('student.dashboard', compact('enrollment', 'totalMateri', 'materiSelesai'));
    }
}
