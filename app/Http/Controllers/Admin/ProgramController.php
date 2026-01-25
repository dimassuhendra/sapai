<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('urutan', 'asc')->get();
        return view('admin.programs', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:150',
            'harga' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('programs', 'public');
        }

        $data['urutan'] = Program::max('urutan') + 1;

        Program::create($data);
        return back()->with('success', 'Program berhasil ditambahkan!');
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'nama_program' => 'required|string|max:150',
            'harga' => 'required|numeric',
        ]);

        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            if ($program->thumbnail) Storage::disk('public')->delete($program->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('programs', 'public');
        }

        $program->update($data);
        return back()->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy(Program $program)
    {
        if ($program->thumbnail) Storage::disk('public')->delete($program->thumbnail);
        $program->delete();
        return back()->with('success', 'Program berhasil dihapus!');
    }
}
