<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order_index', 'asc')->get();
        return view('admin.galleries', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        // Otomatis taruh di urutan terakhir
        $data['order_index'] = Gallery::max('order_index') + 1;

        Gallery::create($data);
        return back()->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'keterangan' => 'nullable|string', // Pastikan divalidasi
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'order_index' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada upload foto baru
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return back()->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path) Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('success', 'Foto dihapus dari galeri!');
    }
}
