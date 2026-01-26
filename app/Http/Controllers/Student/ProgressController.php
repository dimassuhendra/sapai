<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil info program pendaftar
        $enrollment = DB::table('enrollments')
            ->join('programs', 'enrollments.program_id', '=', 'programs.id')
            ->where('enrollments.user_id', $userId)
            ->select('enrollments.program_id', 'programs.nama_program')
            ->first();

        if (!$enrollment) {
            return redirect()->route('student.dashboard')->with('error', 'Anda belum terdaftar di program apapun.');
        }

        // 2. Ambil semua materi untuk program tersebut
        $allMaterials = DB::table('materials')
            ->where('program_id', $enrollment->program_id)
            ->get();

        // 3. Ambil progress siswa (materi mana saja yang sudah selesai)
        $completedIds = DB::table('progress')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->pluck('material_id')
            ->toArray();

        // 4. Hitung Statistik
        $totalMateri = $allMaterials->count();
        $totalSelesai = count($completedIds);
        $persentase = $totalMateri > 0 ? round(($totalSelesai / $totalMateri) * 100) : 0;

        return view('student.progress', compact(
            'allMaterials',
            'completedIds',
            'enrollment',
            'persentase',
            'totalMateri',
            'totalSelesai'
        ));
    }
}
