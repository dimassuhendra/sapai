@extends('layouts.student.master')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Program Belajar Anda</h5>

                    @if($enrollment)
                    <div class="d-flex align-items-start border p-3 rounded-4 mb-3">
                        <div class="bg-light p-3 rounded-3 me-3">
                            <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-1">{{ $enrollment->nama_program }}</h6>
                            <p class="text-muted small mb-2">Durasi: {{ $enrollment->durasi }}</p>

                            @if($enrollment->status_bayar == 'pending')
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill small">
                                <i class="fas fa-clock me-1"></i> Menunggu Pembayaran
                            </span>
                            @elseif($enrollment->status_bayar == 'lunas')
                            <span class="badge bg-success px-3 py-2 rounded-pill small">
                                <i class="fas fa-check-circle me-1"></i> Aktif / Lunas
                            </span>
                            @endif
                        </div>
                        <div class="text-end">
                            <span class="d-block fw-bold text-primary">Rp {{ number_format($enrollment->harga, 0, ',', '.') }}</span>
                            @if($enrollment->status_bayar == 'pending')
                            <a href="#" class="btn btn-sm btn-outline-primary mt-2 rounded-pill">Bayar Sekarang</a>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <p class="text-muted">Anda belum terdaftar di program apapun.</p>
                        <a href="/daftar" class="btn btn-primary rounded-pill">Daftar Program</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Progres Belajar</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Materi Diselesaikan</span>
                        <span class="small fw-bold">{{ $materiSelesai }} / {{ $totalMateri }}</span>
                    </div>
                    <div class="progress rounded-pill" style="height: 10px;">
                        @php
                        $persen = ($totalMateri > 0) ? ($materiSelesai / $totalMateri) * 100 : 0;
                        @endphp
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $persen }}%"></div>
                    </div>
                    <p class="small text-muted mt-3 mb-0 italic">
                        *Selesaikan semua materi untuk mendapatkan sertifikat.
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Aksi Cepat</h5>
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-light text-start border-0 rounded-3 py-2">
                            <i class="fas fa-book-reader me-2 text-info"></i> Lanjut Belajar
                        </a>
                        <a href="#" class="btn btn-light text-start border-0 rounded-3 py-2">
                            <i class="fas fa-sticky-note me-2 text-warning"></i> Buat Catatan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection