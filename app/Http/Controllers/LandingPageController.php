<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Material;
use App\Models\Testimonials;
use App\Models\Gallery;
use App\Models\Settings;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // 1. Ambil Pengaturan Web
        $settings = Settings::pluck('setting_value', 'setting_key')->toArray();

        // 2. Ambil Program (Semua & Grid)
        $programs = Program::orderBy('urutan', 'asc')->get();
        $programs_grid = Program::orderBy('urutan', 'asc')->limit(6)->get();

        // 3. Ambil Galeri
        $galleries = Gallery::orderBy('created_at', 'desc')->limit(8)->get();

        // 4. AMBIL TESTIMONI (Hanya yang berstatus tampil dan muat data user)
        $testimonials = Testimonials::where('status_tampil', true)
            ->with(['user.enrollments.program']) // Mengambil user, lalu pendaftarannya, lalu detail programnya
            ->orderBy('updated_at', 'desc')
            ->get();

        // 5. Ambil Materi Publik
        $materials = Material::where('is_public', true)->limit(8)->get();

        return view('landing', compact(
            'settings',
            'programs',
            'programs_grid',
            'galleries',
            'testimonials',
            'materials'
        ));
    }
}
