<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        // Mengambil materi dengan relasi guru dan program
        $materials = Material::with(['guru', 'program'])->orderBy('order_index', 'asc')->get();
        $programs = Program::all();
        // Mengambil user dengan role guru untuk pilihan dropdown
        $teachers = User::where('role', 'guru')->get();

        return view('admin.materials', compact('materials', 'programs', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'file_path' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:10240', // Max 10MB
        ]);

        $data = $request->all();
        $data['is_public'] = $request->is_public;

        // Default guru_id ke user yang sedang login jika admin yang membuat
        $data['guru_id'] = Auth::user()->role == 'admin' ? ($request->guru_id ?? Auth::id()) : Auth::id();

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('materials', 'public');
        }

        // Otomatis set urutan ke paling bawah
        $data['order_index'] = Material::where('program_id', $request->program_id)->max('order_index') + 1;

        Material::create($data);
        return back()->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
        ]);

        $data = $request->all();
        $data['is_public'] = $request->is_public;
        
        if ($request->hasFile('file_path')) {
            if ($material->file_path) Storage::disk('public')->delete($material->file_path);
            $data['file_path'] = $request->file('file_path')->store('materials', 'public');
        }

        $material->update($data);
        return back()->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Material $material)
    {
        if ($material->file_path) Storage::disk('public')->delete($material->file_path);
        $material->delete();
        return back()->with('success', 'Materi berhasil dihapus!');
    }
}
