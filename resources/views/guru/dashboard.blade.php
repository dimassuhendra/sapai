@extends('layouts.guru.master')
@section('title', 'Dashboard Guru')

@section('content')
<div class="container-fluid px-4 py-4" style="font-family: 'Fredoka', sans-serif;">

    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-1" style="font-family: 'Domine', serif; color: #0d9488;">
                Selamat Datang, {{ Auth::user()->nama_lengkap }}! 👋
            </h3>
            <p class="text-muted">Berikut adalah ringkasan aktivitas pengajaran Anda hari ini.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white hover-up">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 rounded-4 p-3" style="background-color: #f0fdfa; color: #0d9488;">
                        <i class="fas fa-book-open fa-2x"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted small mb-1">Total Materi</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalMateri }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white hover-up">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 rounded-4 p-3" style="background-color: #ecfdf5; color: #10b981;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted small mb-1">Total Siswa</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalSiswa }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white hover-up">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 rounded-4 p-3" style="background-color: #fffbeb; color: #f59e0b;">
                        <i class="fas fa-comments fa-2x"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted small mb-1">Total Catatan</h6>
                        <h4 class="fw-bold mb-0 text-dark">{{ $totalCatatan }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-white shadow-lg" style="background: linear-gradient(135deg, #0d9488, #10b981);">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-white bg-opacity-25 rounded-4 p-3">
                        <i class="fas fa-exclamation-circle fa-2x text-white"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="small mb-1 opacity-75 text-white">Butuh Balasan</h6>
                        <h4 class="fw-bold mb-0">{{ $pendingFeedback }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0" style="color: #0d9488;"><i class="fas fa-history me-2"></i>Catatan & Pertanyaan Terbaru</h6>
                    <a href="#" class="btn btn-sm text-success fw-bold">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background-color: #f8fafc;">
                                <tr>
                                    <th class="ps-4 border-0">Siswa</th>
                                    <th class="border-0">Materi</th>
                                    <th class="border-0">Status</th>
                                    <th class="text-end pe-4 border-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentNotes as $note)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user text-muted" style="font-size: 0.8rem;"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold d-block text-dark small">{{ $note->user->nama_lengkap }}</span>
                                                <small class="text-muted" style="font-size: 0.7rem;">{{ $note->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill fw-normal px-3" style="background-color: #f0fdfa; color: #0d9488;">
                                            {{ Str::limit($note->material->judul_materi, 20) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($note->feedback_guru)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Selesai</span>
                                        @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Tertunda</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="#" class="btn btn-sm btn-light rounded-pill px-3 fw-bold" style="color: #0d9488;">Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                        <p class="mb-0">Belum ada catatan masuk hari ini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 text-white overflow-hidden mb-4" style="background: linear-gradient(135deg, #0d9488, #10b981);">
                <div class="card-body p-4 position-relative">
                    <i class="fas fa-lightbulb position-absolute top-0 end-0 m-4 fa-4x opacity-25"></i>
                    <h5 class="fw-bold mb-3">Tips Mengajar ✨</h5>
                    <p class="small opacity-90 mb-4">Feedback cepat meningkatkan semangat belajar siswa hingga 40%. Luangkan waktu sejenak untuk membalas pertanyaan mereka.</p>
                    <div class="d-flex align-items-center bg-white bg-opacity-25 rounded-3 p-3 mt-auto">
                        <i class="fas fa-info-circle me-3"></i>
                        <span class="small fw-bold">Pastikan materi Anda sudah terupdate!</span>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h6 class="fw-bold text-dark mb-3">Bantuan Cepat</h6>
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-outline-success border-0 text-start rounded-3 bg-light px-3">
                        <i class="fas fa-question-circle me-2"></i> Cara upload materi
                    </a>
                    <a href="#" class="btn btn-outline-success border-0 text-start rounded-3 bg-light px-3">
                        <i class="fas fa-headset me-2"></i> Hubungi IT Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Efek hover untuk kartu statistik */
    .hover-up {
        transition: all 0.3s ease;
    }

    .hover-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(13, 148, 136, 0.1) !important;
    }

    /* Styling Table */
    .table thead th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge {
        font-size: 0.75rem;
        padding: 6px 12px;
    }
</style>
@endsection