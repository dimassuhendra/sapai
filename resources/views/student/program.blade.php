@extends('layouts.student.master')

@section('title', 'Program Saya')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Rincian Program Belajar</h4>
            <p class="text-muted">Informasi lengkap mengenai program yang Anda ikuti.</p>
        </div>
    </div>

    <div class="row">
        @if($myProgram)
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $myProgram->thumbnail) }}" class="img-fluid h-100 object-fit-cover" alt="Thumbnail Program">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h3 class="fw-bold text-primary mb-0">{{ $myProgram->nama_program }}</h3>
                                @if($myProgram->status_bayar == 'lunas')
                                <span class="badge bg-success rounded-pill px-3">Aktif</span>
                                @else
                                <span class="badge bg-warning text-dark rounded-pill px-3">Menunggu Pembayaran</span>
                                @endif
                            </div>
                            <p class="text-muted">{{ $myProgram->deskripsi }}</p>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <small class="text-muted d-block">Durasi Program</small>
                                    <span class="fw-bold"><i class="fas fa-calendar-alt me-1"></i> {{ $myProgram->durasi }}</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Tanggal Daftar</small>
                                    <span class="fw-bold"><i class="fas fa-clock me-1"></i> {{ date('d M Y', strtotime($myProgram->tgl_daftar)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Apa yang Anda dapatkan?</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Akses penuh ke semua materi video dan teks.</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Konsultasi langsung dengan pengajar (Guru).</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Sertifikat penyelesaian program (setelah lulus).</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Forum diskusi antar siswa.</li>
                </ul>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Status Pembayaran</h5>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span>Biaya Kursus:</span>
                    <span class="fw-bold text-dark">Rp {{ number_format($myProgram->harga, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span>Status:</span>
                    <span class="fw-bold {{ $myProgram->status_bayar == 'lunas' ? 'text-success' : 'text-danger' }}">
                        {{ strtoupper($myProgram->status_bayar) }}
                    </span>
                </div>

                @if($myProgram->status_bayar == 'pending')
                <div class="alert alert-info small border-0">
                    <i class="fas fa-info-circle me-1"></i> Silahkan lakukan pembayaran untuk mengaktifkan akses materi.
                </div>
                <button class="btn btn-primary w-100 rounded-pill fw-bold py-2">
                    <i class="fas fa-upload me-2"></i> Konfirmasi Pembayaran
                </button>
                @else
                <button class="btn btn-outline-success w-100 rounded-pill fw-bold py-2" disabled>
                    <i class="fas fa-check me-2"></i> Pembayaran Selesai
                </button>
                @endif
            </div>
        </div>
        @else
        <div class="col-12 text-center py-5">
            <i class="fas fa-folder-open fa-5x text-light mb-3"></i>
            <h4 class="text-muted">Anda belum memiliki program aktif.</h4>
            <a href="/daftar" class="btn btn-primary rounded-pill mt-3">Cari Program Sekarang</a>
        </div>
        @endif
    </div>
</div>
@endsection