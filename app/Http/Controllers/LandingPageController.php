<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Material;
use App\Models\Testimonials;
use App\Models\Galleries;
use App\Models\Settings;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil settings dan ubah jadi key-value array
        $settings = Settings::pluck('setting_value', 'setting_key')->toArray();

        // Ambil data lainnya sesuai urutan
        $programs = Program::orderBy('id', 'asc')->get();
        $programs_grid = Program::limit(6)->get();
        $galleries = Galleries::latest()->limit(4)->get();
        $testimonials = Testimonials::where('status_tampil', true)->with('user')->get();

        // Materi yang diset PUBLIC untuk umum
        $materials = Material::where('is_public', true)->limit(8)->get();

        return view('landing', compact('settings', 'programs', 'programs_grid', 'galleries', 'testimonials', 'materials'));
    }
}