@extends('layouts.student.master')

@section('title', 'Materi Belajar')

@section('content')
<div class="container-fluid">

    @if($isLocked)
    {{-- Tampilan Terkunci (Sesuai kode Anda sebelumnya) --}}
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 text-center">
            <i class="fas fa-lock fa-5x text-light mb-4"></i>
            <h4 class="fw-bold text-muted">Akses Materi Terkunci</h4>
            <p class="text-muted">Selesaikan pembayaran Anda untuk membuka materi.</p>
            <a href="{{ route('student.program') }}" class="btn btn-primary rounded-pill px-4">Ke Pembayaran</a>
        </div>
    </div>
    @elseif(isset($material))
    {{-- TAMPILAN DETAIL MATERI --}}
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('student.material.index') }}" class="btn btn-sm btn-light rounded-pill mb-3 shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h4 class="fw-bold text-primary">{{ $material->judul }}</h4>
                <hr class="opacity-10">

                {{-- Bagian Konten dengan styling khusus agar paragraf rapi --}}
                <div class="material-content mb-4" style="
                            line-height: 1.8; 
                            white-space: pre-wrap; 
                            text-align: justify; 
                            color: #4a4a4a;
                            font-size: 1.05rem;">
                    {!! $material->konten !!}
                </div>

                @if($material->file_path)
                <div class="p-3 bg-light rounded-4 d-flex align-items-center mb-4 border">
                    <div class="bg-white p-2 rounded-3 shadow-sm me-3">
                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Lampiran Materi:</small>
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="fw-bold text-decoration-none text-dark">
                            Unduh Dokumen Pendukung <i class="fas fa-external-link-alt ms-1 small"></i>
                        </a>
                    </div>
                </div>
                @endif

                {{-- TOMBOL SELESAIKAN --}}
                <div class="border-top pt-4 mt-2">
                    @if($currentProgress && $currentProgress->status == 'completed')
                    <div class="alert alert-success border-0 rounded-pill text-center py-3 shadow-sm">
                        <i class="fas fa-check-circle me-2"></i> Materi ini sudah selesai dipelajari.
                    </div>
                    @else
                    <form action="{{ route('student.material.complete', $material->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 rounded-pill py-3 fw-bold shadow-sm hover-lift">
                            <i class="fas fa-check me-2"></i> Tandai Selesai & Lanjutkan
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- SIDEBAR KURIKULUM --}}
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <h6 class="fw-bold mb-3 px-2">Daftar Kurikulum</h6>
                <div class="list-group list-group-flush scroll-container" style="max-height: 500px; overflow-y: auto;">
                    @foreach($materials as $index => $m)
                    <a href="{{ route('student.material.show', $m->id) }}"
                        class="list-group-item list-group-item-action border-0 rounded-3 mb-2 p-3 {{ $m->id == $material->id ? 'bg-primary text-white' : 'bg-light' }}">
                        <div class="d-flex align-items-center">
                            <div class="me-3 opacity-50 fw-bold">{{ sprintf('%02d', $index + 1) }}</div>
                            <span class="small fw-bold">{{ $m->judul }}</span>
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
    @else
    {{-- TAMPILAN KATALOG --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 class="fw-bold">Katalog Materi</h4>
            <p class="text-muted">Program: {{ $enrollment->nama_program }}</p>
        </div>
        {{-- PROGRESS BAR --}}
        <div class="col-md-4 text-end">
            <small class="fw-bold d-block mb-1">Total Progres: {{ $progressPercent }}%</small>
            <div class="progress(rounded-pill)" style="height: 10px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progressPercent }}%"></div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse($materials as $index => $materi)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-soft-primary text-primary rounded-pill">Materi {{ $index + 1 }}</span>
                        @if(in_array($materi->id, $completedMaterials))
                        <span class="text-success small"><i class="fas fa-check-circle"></i> Selesai</span>
                        @endif
                    </div>
                    <h5 class="fw-bold mb-3">{{ $materi->judul }}</h5>
                    <a href="{{ route('student.material.show', $materi->id) }}" class="btn btn-primary w-100 rounded-pill mt-auto">Mulai Belajar</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Belum ada materi.</p>
        @endforelse
    </div>
    @endif
</div>
@endsection