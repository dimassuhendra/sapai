<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Program;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa' => User::where('role', 'pendaftar')->count(),
            'total_program' => Program::count(),
            'pendaftaran_baru' => Enrollment::where('status_bayar', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}