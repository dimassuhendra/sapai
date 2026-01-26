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
        $settings = Settings::pluck('setting_value', 'setting_key')->toArray();

        $programs = Program::orderBy('id', 'asc')->get();
        $programs_grid = Program::limit(6)->get();

        // PERBAIKAN: Gunakan scopeOrdered agar urutan yang diatur admin berfungsi
        $galleries = Gallery::ordered()->limit(8)->get();

        $testimonials = Testimonials::where('status_tampil', true)->with('user')->get();
        $materials = Material::where('is_public', true)->limit(8)->get();

        return view('landing', compact('settings', 'programs', 'programs_grid', 'galleries', 'testimonials', 'materials'));
    }
}
