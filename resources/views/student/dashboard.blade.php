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

                            {{-- Label Status Pembayaran & Verifikasi --}}
                            @if($enrollment->status_bayar == 'lunas')
                            <span class="badge bg-success px-3 py-2 rounded-pill small">
                                <i class="fas fa-check-circle me-1"></i> Aktif / Lunas
                            </span>
                            @elseif($enrollment->bukti_transfer && $enrollment->status_bayar == 'pending')
                            <span class="badge bg-info text-white px-3 py-2 rounded-pill small">
                                <i class="fas fa-history me-1"></i> Sedang Diverifikasi Admin
                            </span>
                            @else
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill small">
                                <i class="fas fa-clock me-1"></i> Menunggu Pembayaran
                            </span>
                            @endif
                        </div>

                        <div class="text-end">
                            <span class="d-block fw-bold text-primary">Rp {{ number_format($enrollment->harga, 0, ',', '.') }}</span>

                            {{-- Logika Tombol Upload/Upload Ulang --}}
                            @if($enrollment->status_bayar == 'pending')
                            @if(!$enrollment->bukti_transfer)
                            <button type="button" class="btn btn-sm btn-primary mt-2 rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalBayar">
                                <i class="fas fa-upload me-1"></i> Bayar Sekarang
                            </button>
                            @else
                            <button type="button" class="btn btn-sm btn-outline-secondary mt-2 rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalBayar">
                                <i class="fas fa-sync me-1"></i> Upload Ulang Bukti
                            </button>
                            @endif
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
                    <p class="small text-muted mt-3 mb-0" style="font-style: italic;">
                        *Selesaikan semua materi untuk mendapatkan sertifikat.
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Aksi Cepat</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('student.material.index') }}" class="btn btn-light text-start border-0 rounded-3 py-2">
                            <i class="fas fa-book-reader me-2 text-info"></i> Lanjut Belajar
                        </a>
                        <a href="{{ route('student.notes.index') }}" class="btn btn-light text-start border-0 rounded-3 py-2">
                            <i class="fas fa-sticky-note me-2 text-warning"></i> Buat Catatan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBayar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('student.upload.bukti', $enrollment->id ?? 0) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        {{-- Info Pesan jika sudah pernah upload --}}
                        @if($enrollment && $enrollment->bukti_transfer)
                        <div class="alert alert-warning rounded-3 small border-0 mb-3">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Anda sudah mengunggah bukti sebelumnya. Upload ulang akan mengganti file yang lama.
                        </div>
                        @endif

                        <div class="alert alert-info rounded-3 small border-0">
                            <h6 class="fw-bold mb-1"><i class="fas fa-university me-1"></i> Rekening Pembayaran:</h6>
                            <p class="mb-0">Bank BCA: <strong>1234-567-890</strong><br>A.N: SAPAI Indonesia</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Unggah Bukti Transfer (Gambar)</label>
                            <input type="file" name="bukti_transfer" class="form-control rounded-3" accept="image/*" required>
                            <div class="form-text mt-2" style="font-size: 0.7rem;">Format: JPG, PNG, JPEG. Max: 2MB.</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Kirim Bukti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection