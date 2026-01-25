<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        // Status diambil dari tabel enrollments (pending, lunas, batal)
        $status = $request->get('status', 'pending');

        $enrollments = Enrollment::with(['user', 'program'])
            ->where('status_bayar', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.enrollments', compact('enrollments', 'status'));
    }

    public function updateStatus(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update(['status_bayar' => $request->status_bayar]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();
        return back()->with('success', 'Data pendaftaran berhasil dihapus!');
    }
}
