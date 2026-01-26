<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Mengambil catatan siswa beserta judul materinya
        $notes = DB::table('notes')
            ->join('materials', 'notes.material_id', '=', 'materials.id')
            ->where('notes.user_id', $userId)
            ->select('notes.*', 'materials.judul as judul_materi')
            ->orderBy('notes.created_at', 'desc')
            ->get();

        // Mengambil daftar materi untuk pilihan saat membuat catatan baru
        $materials = DB::table('enrollments')
            ->join('materials', 'enrollments.program_id', '=', 'materials.id')
            ->where('enrollments.user_id', $userId)
            ->where('enrollments.status_bayar', 'lunas')
            ->select('materials.id', 'materials.judul')
            ->get();

        return view('student.notes', compact('notes', 'materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required',
            'konten' => 'required'
        ]);

        DB::table('notes')->insert([
            'user_id' => Auth::id(),
            'material_id' => $request->material_id,
            'konten' => $request->konten,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Catatan berhasil disimpan!');
    }

    public function destroy($id)
    {
        DB::table('notes')->where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'Catatan berhasil dihapus!');
    }
}
