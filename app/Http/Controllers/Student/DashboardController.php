<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $enrollment = DB::table('enrollments')->where('id', $id)->first();

        if (!$enrollment) {
            return back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . Auth::id() . '.' . $file->getClientOriginalExtension();

            // 1. CEK & BUAT FOLDER OTOMATIS
            // Laravel storeAs pada disk 'public' akan otomatis membuat folder jika belum ada
            if (!Storage::disk('public')->exists('bukti_transfer')) {
                Storage::disk('public')->makeDirectory('bukti_transfer');
            }

            // 2. HAPUS FILE LAMA (Jika ada)
            if ($enrollment->bukti_transfer) {
                // Pastikan path hapus sama dengan path simpan
                Storage::disk('public')->delete('bukti_transfer/' . $enrollment->bukti_transfer);
            }

            // 3. SIMPAN FILE BARU
            // Simpan ke: storage/app/public/bukti_transfer
            $file->storeAs('bukti_transfer', $filename, 'public');

            // 4. UPDATE DATABASE
            DB::table('enrollments')->where('id', $id)->update([
                'bukti_transfer' => $filename, // Hanya simpan nama filenya saja
                'status_bayar' => 'pending',
                'updated_at' => now()
            ]);

            return back()->with('success', 'Bukti transfer berhasil diunggah. Mohon tunggu validasi admin.');
        }

        return back()->with('error', 'Gagal mengunggah gambar.');
    }
}
