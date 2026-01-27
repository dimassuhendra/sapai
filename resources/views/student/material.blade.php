@extends('layouts.student.master')

@section('title', 'Materi Belajar')

@section('content')
<div class="container-fluid">

    {{-- 1. CEK PROTEKSI: JIKA STATUS BELUM LUNAS --}}
    @if($isLocked)
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 text-center">
            <i class="fas fa-lock fa-5x text-light mb-4"></i>
            <h4 class="fw-bold text-muted">Akses Materi Terkunci</h4>
            <p class="text-muted">Selesaikan pembayaran Anda untuk membuka semua materi di program ini.</p>
            <a href="{{ route('student.program') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-credit-card me-2"></i>Ke Halaman Pembayaran
            </a>
        </div>
    </div>

    <div class="modal fade" id="lockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-lock text-warning fa-4x"></i>
                    </div>
                    <h4 class="fw-bold">Ups! Akses Terbatas</h4>
                    <p class="text-muted">Halaman materi hanya tersedia untuk siswa yang sudah melunasi pembayaran program <strong>{{ $enrollment->nama_program ?? 'pilihan' }}</strong>.</p>

                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('student.program') }}" class="btn text-white rounded-pill py-2 fw-bold shadow-sm" style="background-color: var(--student-secondary);">Selesaikan Pembayaran</a>
                        <a href="{{ route('student.dashboard') }}" class="btn btn-light rounded-pill py-2 text-muted">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. TAMPILAN DETAIL MATERI (Jika Materi sedang dibuka) --}}
    @elseif(isset($material))
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('student.material.index') }}" class="btn btn-sm btn-light rounded-pill mb-3 shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Materi
            </a>
        </div>

        <div class="col-lg-8">
            <div class="ratio ratio-16x9 shadow-sm rounded-4 overflow-hidden mb-4 border border-white">
                <iframe src="https://www.youtube.com/embed/{{ $material->video_url }}?rel=0" allowfullscreen></iframe>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h4 class="fw-bold text-primary">{{ $material->judul }}</h4>
                <hr class="opacity-10">
                <p class="text-muted" style="line-height: 1.8;">{{ $material->deskripsi }}</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 overflow-hidden">
                <h6 class="fw-bold mb-3 px-2">Daftar Kurikulum</h6>
                <div class="list-group list-group-flush scroll-container" style="max-height: 500px; overflow-y: auto;">
                    @foreach($materials as $index => $m)
                    <a href="{{ route('student.material.show', $m->id) }}"
                        class="list-group-item list-group-item-action border-0 rounded-3 mb-2 p-3 {{ $m->id == $material->id ? 'bg-primary text-white shadow-sm' : 'bg-light' }}">
                        <div class="d-flex align-items-center">
                            <div class="me-3 opacity-50 fw-bold">{{ sprintf('%02d', $index + 1) }}</div>
                            <div>
                                <small class="d-block {{ $m->id == $material->id ? 'text-white-50' : 'text-muted' }}">Materi Belajar</small>
                                <span class="small fw-bold">{{ $m->judul }}</span>
                            </div>
                            @if(in_array($m->id, $completedMaterials))
                            <i class="fas fa-check-circle ms-auto text-success"></i>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- 3. TAMPILAN DAFTAR MATERI (Default / Katalog) --}}
    @else
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Katalog Materi Belajar</h4>
            <p class="text-muted">Pilih materi untuk mulai meningkatkan skill Anda di program <strong>{{ $enrollment->nama_program }}</strong>.</p>
        </div>
    </div>

    <div class="row">
        @forelse($materials as $index => $materi)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-card">
                <div class="position-relative">
                    <img src="https://img.youtube.com/vi/{{ $materi->video_url }}/mqdefault.jpg" class="card-img-top" alt="Thumbnail">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <i class="fas fa-play-circle fa-3x text-white opacity-75"></i>
                    </div>

                    @if(in_array($materi->id, $completedMaterials))
                    <span class="position-absolute top-0 end-0 m-3 badge bg-success rounded-pill shadow-sm">
                        <i class="fas fa-check-circle me-1"></i> Selesai
                    </span>
                    @endif
                </div>

                <div class="card-body p-4 d-flex flex-column">
                    <h6 class="text-primary fw-bold mb-1">Pertemuan {{ $index + 1 }}</h6>
                    <h5 class="fw-bold mb-3 text-truncate" title="{{ $materi->judul }}">{{ $materi->judul }}</h5>
                    <p class="text-muted small mb-4">{{ Str::limit($materi->deskripsi, 70) }}</p>

                    <a href="{{ route('student.material.show', $materi->id) }}" class="btn btn-primary w-100 rounded-pill mt-auto fw-bold py-2 shadow-sm">
                        Mulai Belajar
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="p-5">
                <i class="fas fa-book-open fa-4x text-light mb-3"></i>
                <p class="text-muted">Materi belum tersedia untuk program ini.</p>
            </div>
        </div>
        @endforelse
    </div>
    @endif
</div>

@push('styles')
<style>
    .hover-card {
        transition: transform 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-10px);
    }

    .scroll-container::-webkit-scrollbar {
        width: 5px;
    }

    .scroll-container::-webkit-scrollbar-thumb {
        background: #e0e0e0;
        border-radius: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Otomatis munculkan modal jika status isLocked
        @if(isset($isLocked) && $isLocked)
        var myModal = new bootstrap.Modal(document.getElementById('lockModal'));
        myModal.show();
        @endif
    });
</script>
@endpush

@endsection