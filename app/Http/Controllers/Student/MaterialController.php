<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $enrollment = DB::table('enrollments')
            ->join('programs', 'enrollments.program_id', '=', 'programs.id')
            ->where('enrollments.user_id', $userId)
            ->select('enrollments.program_id', 'enrollments.status_bayar', 'programs.nama_program')
            ->first();

        // Jika belum lunas, kita tetap ke halaman materi tapi bawa pesan 'locked'
        $isLocked = (!$enrollment || $enrollment->status_bayar !== 'lunas');

        $materials = [];
        $completedMaterials = [];

        if (!$isLocked) {
            $materials = DB::table('materials')
                ->where('program_id', $enrollment->program_id)
                ->orderBy('id', 'asc')
                ->get();

            $completedMaterials = DB::table('progress')
                ->where('user_id', $userId)
                ->where('status', 'completed')
                ->pluck('material_id')
                ->toArray();
        }

        return view('student.material', compact('materials', 'enrollment', 'completedMaterials', 'isLocked'));
    }

    public function show($id)
    {
        $userId = Auth::id();

        // Ambil detail materi
        $materials = DB::table('materials')->where('program_id', $materials->program_id)->get();
        // Pastikan materi ada
        if (!$material) {
            abort(404);
        }

        // Catat progres jika belum pernah dibuka (Opsional)
        $exists = DB::table('progress')
            ->where('user_id', $userId)
            ->where('material_id', $id)
            ->exists();

        if (!$exists) {
            DB::table('progress')->insert([
                'user_id' => $userId,
                'material_id' => $id,
                'status' => 'on_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return view('student.material.show', compact('material'));
    }
}
