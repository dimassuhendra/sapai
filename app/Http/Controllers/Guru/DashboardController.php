<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Notes;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();

        // 1. Statistik Utama
        $totalMateri = Material::where('guru_id', $guruId)->count(); 
        
        // 2. Hitung Catatan yang masuk ke materi milik guru ini
        $notesQuery = Notes::whereHas('material', function($q) use ($guruId) {
            $q->where('guru_id', $guruId);
        });
        
        $totalCatatan = $notesQuery->count();
        
        // 3. Catatan yang BELUM dibalas (feedback_guru masih null)
        $pendingFeedback = $notesQuery->whereNull('feedback_guru')->count();

        // 4. Ambil 5 Catatan Terbaru untuk ditampilkan di tabel
        $recentNotes = Notes::whereHas('material', function($q) use ($guruId) {
                $q->where('guru_id', $guruId);
            })
            ->with(['user', 'material'])
            ->latest()
            ->limit(5)
            ->get();

        // 5. Hitung estimasi jumlah siswa yang diajar (Siswa yang mengambil program yang diisi guru ini)
        $totalSiswa = User::whereHas('enrollments.program.materials', function($q) use ($guruId) {
            $q->where('guru_id', $guruId);
        })->distinct()->count();

        return view('guru.dashboard', compact(
            'totalMateri', 
            'totalCatatan', 
            'pendingFeedback', 
            'totalSiswa',
            'recentNotes'
        ));
    }
}