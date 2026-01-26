<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Mengambil data program yang diikuti siswa
        $myProgram = DB::table('enrollments')
            ->join('programs', 'enrollments.program_id', '=', 'programs.id')
            ->where('enrollments.user_id', $userId)
            ->select('enrollments.*', 'programs.nama_program', 'programs.harga', 'programs.durasi', 'programs.deskripsi', 'programs.thumbnail')
            ->first();

        return view('student.program', compact('myProgram'));
    }
}
