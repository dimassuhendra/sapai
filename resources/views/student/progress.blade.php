@extends('layouts.student.master')

@section('title', 'Progres Belajar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Progres Belajar Anda</h4>
            <p class="text-muted">Pantau sejauh mana Anda telah menguasai program <strong>{{ $enrollment->nama_program }}</strong>.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">
                <h5 class="fw-bold mb-4">Persentase Selesai</h5>

                <div class="position-relative d-inline-block mb-4">
                    <svg width="150" height="150" viewBox="0 0 150 150">
                        <circle cx="75" cy="75" r="65" stroke="#f0f0f0" stroke-width="15" fill="none" />
                        <circle cx="75" cy="75" r="65" stroke="#0d6efd" stroke-width="15" fill="none"
                            stroke-dasharray="408.4" stroke-dashoffset="{{ 408.4 - (408.4 * $persentase) / 100 }}"
                            stroke-linecap="round" style="transition: stroke-dashoffset 1s ease-in-out;" />
                    </svg>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <h2 class="fw-bold mb-0">{{ $persentase }}%</h2>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-6 border-end">
                        <h4 class="fw-bold mb-0">{{ $totalSelesai }}</h4>
                        <small class="text-muted">Selesai</small>
                    </div>
                    <div class="col-6">
                        <h4 class="fw-bold mb-0">{{ $totalMateri }}</h4>
                        <small class="text-muted">Total Materi</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-4">Detail Kurikulum</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 px-3 py-3">No</th>
                                <th class="border-0 py-3">Judul Materi</th>
                                <th class="border-0 py-3 text-center">Status</th>
                                <th class="border-0 py-3 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allMaterials as $index => $materi)
                            <tr>
                                <td class="px-3 fw-bold text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-bold d-block text-dark">{{ $materi->judul }}</span>
                                    <small class="text-muted">Materi Video</small>
                                </td>
                                <td class="text-center">
                                    @if(in_array($materi->id, $completedIds))
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                        <i class="fas fa-check-circle me-1"></i> Selesai
                                    </span>
                                    @else
                                    <span class="badge bg-light text-muted rounded-pill px-3">
                                        <i class="fas fa-clock me-1"></i> Belum
                                    </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('student.material.show', $materi->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        {{ in_array($materi->id, $completedIds) ? 'Tonton Lagi' : 'Pelajari' }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($persentase == 100)
                <div class="alert alert-success border-0 rounded-4 mt-4 d-flex align-items-center">
                    <i class="fas fa-award fa-2x me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Selamat! Anda telah menyelesaikan semua materi.</h6>
                        <small>Sertifikat Anda akan segera diproses oleh Admin.</small>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection