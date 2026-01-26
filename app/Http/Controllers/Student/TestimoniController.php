<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Testimonials;

class TestimoniController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $myTestimoni = DB::table('testimonials')
            ->where('user_id', $userId)
            ->first();

        return view('student.testimoni', compact('myTestimoni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'testimoni' => 'required|string|max:500',
        ]);

        Testimonials::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'rating' => $request->rating,
                'testimoni' => $request->testimoni,
            ]
        );

        return back()->with('success', 'Terima kasih atas testimoni Anda!');
    }
}
