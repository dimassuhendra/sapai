@extends('layouts.admin.master')

@section('title', 'Manajemen Pendaftaran')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-dark">Data Pendaftaran & Pembayaran</h3>
    <p class="text-muted">Kelola siswa yang mendaftar program les di sini.</p>
</div>

@if(session('konfirmasi_sukses'))
<div class="modal fade" id="modalSuksesKonfirmasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg text-center p-5" style="border-radius: 24px;">
            <div class="modal-body">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h4 class="fw-bold">Konfirmasi Berhasil!</h4>
                <p class="text-muted">Pembayaran siswa <strong>{{ session('konfirmasi_sukses')['nama'] }}</strong> telah diverifikasi. Siswa kini berstatus Aktif.</p>
                <button type="button" class="btn btn-success rounded-pill px-5 fw-bold" data-bs-dismiss="modal">OK, MENGERTI</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="d-flex justify-content-center mb-4">
    <div class="btn-group p-1 bg-white shadow-sm rounded-pill">
        <a href="{{ route('enrollments.index', ['status' => 'pending']) }}" class="btn {{ $status == 'pending' ? 'btn-warning text-white' : 'btn-light' }} rounded-pill px-4">Pending</a>
        <a href="{{ route('enrollments.index', ['status' => 'lunas']) }}" class="btn {{ $status == 'lunas' ? 'btn-success' : 'btn-light' }} rounded-pill px-4">Siswa Aktif</a>
        <a href="{{ route('enrollments.index', ['status' => 'selesai']) }}" class="btn {{ $status == 'selesai' ? 'btn-secondary' : 'btn-light' }} rounded-pill px-4">Selesai</a>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('enrollments.index') }}" method="GET" class="d-flex align-items-center gap-2">
        <input type="hidden" name="status" value="{{ $status }}">
        <label class="small fw-bold">Tampilkan:</label>
        <select name="per_page" onchange="this.form.submit()" class="form-select form-select-sm" style="width: 80px; border-radius: 8px;">
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
            <option value="all" {{ $perPage == 'all' ? 'selected' : '' }}>All</option>
        </select>
    </form>

    <div class="btn-group">
        <a href="{{ route('enrollments.export', ['status' => $status, 'limit' => $perPage]) }}" class="btn btn-outline-success btn-sm rounded-3">
            <i class="fas fa-file-excel me-1"></i> Export Excel ({{ strtoupper($perPage) }})
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
</div>
@endif

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">Tgl Daftar</th>
                        <th>Nama Siswa</th>
                        <th>Program</th>
                        <th>Bukti Bayar</th>
                        <th>WhatsApp</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $e)
                    <tr>
                        <td class="px-4 small text-muted">{{ \Carbon\Carbon::parse($e->tgl_daftar)->format('d/m/Y') }}</td>
                        <td>
                            <div class="fw-bold">{{ $e->user->nama_lengkap }}</div>
                            <small class="text-muted">{{ $e->user->email }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info text-white rounded-pill px-3">{{ $e->program->nama_program }}</span>
                            <div class="small fw-bold mt-1 text-danger">Rp {{ number_format($e->program->harga, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            @if($e->bukti_transfer)
                            {{-- Pastikan path storage/ sudah benar --}}
                            <a href="{{ asset('storage/' . $e->bukti_transfer) }}" target="_blank">
                                <img src="{{ asset('storage/' . $e->bukti_transfer) }}"
                                    class="rounded border shadow-sm"
                                    width="45" height="45"
                                    style="object-fit: cover;"
                                    onerror="this.src='https://placehold.co/45?text=Error'"
                                    title="Klik untuk perbesar">
                            </a>
                            @else
                            <span class="badge bg-light text-muted border">Belum Ada</span>
                            @endif
                        </td>
                        <td>
                            @php
                            $phone = preg_replace('/[^0-9]/', '', $e->user->no_telp);
                            if(str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);

                            $pesan = "Halo {$e->user->nama_lengkap}, pembayaran untuk pendaftaran program {$e->program->nama_program} telah kami terima. Selamat bergabung!";
                            $waUrl = "https://wa.me/{$phone}?text=" . urlencode($pesan);
                            @endphp
                            <a href="{{ $waUrl }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                <i class="fab fa-whatsapp me-1"></i> Hubungi
                            </a>
                        </td>
                        <td class="text-center px-4">
                            <div class="d-flex justify-content-center gap-2">
                                @if($status == 'pending')
                                <button class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalLunas{{ $e->id }}">
                                    Konfirmasi Lunas
                                </button>
                                @elseif($status == 'lunas')
                                <span class="badge bg-success-subtle text-success py-2 px-3 rounded-pill border border-success">
                                    <i class="fas fa-check-circle me-1"></i> Terverifikasi
                                </span>
                                @endif

                                <button class="btn btn-sm btn-light text-danger border rounded-pill" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $e->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalLunas{{ $e->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center p-4" style="border-radius: 20px;">
                                <form action="{{ route('enrollments.updateStatus', $e->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status_bayar" value="lunas">
                                    <div class="mb-3">
                                        <i class="fas fa-question-circle text-warning fa-4x"></i>
                                    </div>
                                    <h5 class="fw-bold">Konfirmasi Pembayaran?</h5>
                                    <p class="text-muted">Siswa: <strong>{{ $e->user->nama_lengkap }}</strong><br>Program: <strong>{{ $e->program->nama_program }}</strong></p>
                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success rounded-pill px-4">Ya, Sudah Lunas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalHapus{{ $e->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center p-4" style="border-radius: 20px;">
                                <form action="{{ route('enrollments.destroy', $e->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <div class="mb-3">
                                        <i class="fas fa-exclamation-triangle text-danger fa-4x"></i>
                                    </div>
                                    <h5 class="fw-bold">Hapus Pendaftaran?</h5>
                                    <p class="text-muted">Data pendaftaran <strong>{{ $e->user->nama_lengkap }}</strong> akan dihapus permanen.</p>
                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger rounded-pill px-4">Hapus Sekarang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="https://illustrations.popsy.co/flat/empty-box.svg" width="150" class="mb-3">
                            <p class="text-muted">Tidak ada data pendaftaran dalam status ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Otomatis tampilkan modal sukses jika ada flash message
        @if(session('konfirmasi_sukses'))
        var successModal = new bootstrap.Modal(document.getElementById('modalSuksesKonfirmasi'));
        successModal.show();
        @endif
    });
</script>
@endpush