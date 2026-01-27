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

        $isLocked = (!$enrollment || $enrollment->status_bayar !== 'lunas');

        $materials = [];
        $completedMaterials = [];
        $progressPercent = 0;

        if (!$isLocked) {
            $materials = DB::table('materials')
                ->where('program_id', $enrollment->program_id)
                ->orderBy('order_index', 'asc')
                ->get();

            $completedMaterials = DB::table('progress')
                ->where('user_id', $userId)
                ->where('status', 'completed')
                ->pluck('material_id')
                ->toArray();

            // Hitung Persentase Progres
            $totalMateri = $materials->count();
            $totalSelesai = count($completedMaterials);
            $progressPercent = ($totalMateri > 0) ? round(($totalSelesai / $totalMateri) * 100) : 0;
        }

        return view('student.material', compact('materials', 'enrollment', 'completedMaterials', 'isLocked', 'progressPercent'));
    }

    public function show($id)
    {
        $userId = Auth::id();
        $material = DB::table('materials')->where('id', $id)->first();

        if (!$material) {
            abort(404);
        }

        $enrollment = DB::table('enrollments')
            ->join('programs', 'enrollments.program_id', '=', 'programs.id')
            ->where('enrollments.user_id', $userId)
            ->where('enrollments.program_id', $material->program_id)
            ->select('enrollments.*', 'programs.nama_program')
            ->first();

        $isLocked = (!$enrollment || $enrollment->status_bayar !== 'lunas');
        if ($isLocked) {
            return redirect()->route('student.material.index')->with('error', 'Akses terkunci.');
        }

        // Catat progres awal jika belum ada
        $exists = DB::table('progress')->where('user_id', $userId)->where('material_id', $id)->exists();
        if (!$exists) {
            DB::table('progress')->insert([
                'user_id' => $userId,
                'material_id' => $id,
                'status' => 'not_started',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $materials = DB::table('materials')->where('program_id', $material->program_id)->orderBy('order_index', 'asc')->get();
        $completedMaterials = DB::table('progress')->where('user_id', $userId)->where('status', 'completed')->pluck('material_id')->toArray();

        // Ambil status progres materi ini
        $currentProgress = DB::table('progress')->where('user_id', $userId)->where('material_id', $id)->first();

        return view('student.material', compact('material', 'materials', 'completedMaterials', 'enrollment', 'isLocked', 'currentProgress'));
    }

    public function markAsComplete($id)
    {
        DB::table('progress')
            ->where('user_id', Auth::id())
            ->where('material_id', $id)
            ->update([
                'status' => 'completed',
                'completed_at' => now(),
                'updated_at' => now()
            ]);

        return back()->with('success', 'Materi berhasil diselesaikan!');
    }
}
