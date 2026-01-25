<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Exports\EnrollmentsExport; // Pastikan file export ini sudah dibuat
use Maatwebsite\Excel\Facades\Excel;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        $perPage = $request->get('per_page', 10);

        $query = Enrollment::with(['user', 'program'])
            ->where('status_bayar', $status)
            ->orderBy('created_at', 'desc');

        // Fitur tampilkan 10, 20, 100, atau All
        $enrollments = ($perPage == 'all') ? $query->get() : $query->paginate($perPage)->withQueryString();

        return view('admin.enrollments', compact('enrollments', 'status', 'perPage'));
    }

    public function export(Request $request)
    {
        $status = $request->get('status', 'pending');
        $limit = $request->get('limit', 10);
        $date = date('d-m-Y_Hi');

        // Menjalankan download Excel melalui class EnrollmentsExport
        // Kita mengirimkan parameter status dan limit ke constructor EnrollmentsExport
        return Excel::download(
            new EnrollmentsExport($status, $limit),
            "laporan_pendaftaran_{$status}_{$date}.xlsx"
        );
    }

    public function updateStatus(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update(['status_bayar' => $request->status_bayar]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();
        return back()->with('success', 'Data pendaftaran berhasil dihapus!');
    }
}
