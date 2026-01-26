<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        // Mengambil semua testimoni beserta data user yang memberikannya
        $testimonials = Testimonials::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.testimoni', compact('testimonials'));
    }

    public function toggleStatus($id)
    {
        $testi = Testimonials::findOrFail($id);

        // Membalikkan status (jika true jadi false, jika false jadi true)
        $testi->status_tampil = !$testi->status_tampil;
        $testi->save();

        return back()->with('success', 'Status tampilan testimoni berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $testi = Testimonials::findOrFail($id);
        $testi->delete();

        return back()->with('success', 'Testimoni berhasil dihapus!');
    }
}
