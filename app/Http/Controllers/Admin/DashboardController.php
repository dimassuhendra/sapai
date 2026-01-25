<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Program;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Ringkasan
        $stats = [
            'total_siswa' => User::where('role', 'pendaftar')->count(),
            'total_program' => Program::count(),
            'pendaftaran_baru' => Enrollment::where('status_bayar', 'pending')->count(),
            // Hitung total harga dari pendaftaran yang sudah lunas
            'total_omzet' => Enrollment::where('status_bayar', 'lunas')
                ->join('programs', 'enrollments.program_id', '=', 'programs.id')
                ->sum('programs.harga')
        ];

        // 2. Data Grafik (Pendaftaran 6 bulan terakhir)
        $chartData = Enrollment::select(
            DB::raw('MONTHNAME(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('bulan')
            ->orderBy('created_at', 'ASC')
            ->take(6)
            ->get();

        // 3. Program Terpopuler (Berdasarkan jumlah siswa terbanyak)
        $popular_programs = Program::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        // 4. Pendaftaran Terbaru (dengan relasi user dan program)
        $recent_enrollments = Enrollment::with(['user', 'program'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'popular_programs', 'recent_enrollments', 'chartData'));
    }
}
