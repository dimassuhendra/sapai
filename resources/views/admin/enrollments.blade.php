@extends('layouts.admin.master')

@section('title', 'Manajemen Pendaftaran')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-dark">Data Pendaftaran & Pembayaran</h3>
    <p class="text-muted">Kelola siswa yang mendaftar program les di sini.</p>
</div>

<div class="d-flex justify-content-center mb-4">
    <div class="btn-group p-1 bg-white shadow-sm rounded-pill">
        <a href="{{ route('enrollments.index', ['status' => 'pending']) }}" class="btn {{ $status == 'pending' ? 'btn-warning' : 'btn-light' }} rounded-pill px-4">Pending</a>
        <a href="{{ route('enrollments.index', ['status' => 'lunas']) }}" class="btn {{ $status == 'lunas' ? 'btn-success' : 'btn-light' }} rounded-pill px-4">Siswa Aktif</a>
        <a href="{{ route('enrollments.index', ['status' => 'selesai']) }}" class="btn {{ $status == 'selesai' ? 'btn-secondary' : 'btn-light' }} rounded-pill px-4">Selesai</a>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('enrollments.index') }}" method="GET" class="d-flex align-items-center gap-2">
        <input type="hidden" name="status" value="{{ $status }}">
        <label class="small fw-bold">Tampilkan:</label>
        <select name="per_page" onchange="this.form.submit()" class="form-select form-select-sm" style="width: 80px;">
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
            <option value="all" {{ $perPage == 'all' ? 'selected' : '' }}>All</option>
        </select>
    </form>

    <div class="btn-group">
        <a href="{{ route('enrollments.export', ['status' => $status, 'limit' => $perPage]) }}" class="btn btn-outline-success btn-sm">
            <i class="fas fa-file-excel me-1"></i> Export ke Excel ({{ strtoupper($perPage) }})
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm mb-4">
    {{ session('success') }}
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4">Tgl Daftar</th>
                        <th>Nama Siswa</th>
                        <th>Program Yang Diambil</th>
                        <th>WhatsApp</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $e)
                    <tr>
                        <td class="px-4 small">{{ \Carbon\Carbon::parse($e->tgl_daftar)->format('d/m/Y') }}</td>
                        <td>
                            <div class="fw-bold">{{ $e->user->nama_lengkap }}</div>
                            <small class="text-muted">{{ $e->user->email }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info text-white">{{ $e->program->nama_program }}</span>
                            <div class="small text-muted">Rp {{ number_format($e->program->harga, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            @php
                            // Asumsi nomor WA ada di field username atau buat field baru di users.
                            // Jika belum ada, ganti $e->user->username dengan field no_hp Anda.
                            $phone = preg_replace('/[^0-9]/', '', $e->user->username);
                            if(str_starts_with($phone, '0')) $phone = '62' . substr($phone, 1);

                            $pesan = "Halo {$e->user->nama_lengkap}, kami dari Admin Sapai. Terkait pendaftaran Anda di {$e->program->nama_program}, mohon segera melakukan pembayaran...";
                            $waUrl = "https://wa.me/{$phone}?text=" . urlencode($pesan);
                            @endphp
                            <a href="{{ $waUrl }}" target="_blank" class="btn btn-sm btn-outline-success">
                                <i class="fab fa-whatsapp me-1"></i> Hubungi WA
                            </a>
                        </td>
                        <td class="text-center">
                            @if($status == 'pending')
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalLunas{{ $e->id }}">
                                Konfirmasi Lunas
                            </button>
                            @endif
                            @if($status == 'lunas')
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalSelesai{{ $e->id }}">
                                Selesaikan
                            </button>
                            @endif
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $e->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalLunas{{ $e->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center p-4">
                                <form action="{{ route('enrollments.updateStatus', $e->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status_bayar" value="lunas">
                                    <h5 class="fw-bold">Konfirmasi Pembayaran?</h5>
                                    <p>Apakah benar <strong>{{ $e->user->nama_lengkap }}</strong> telah melunasi pembayaran untuk program <strong>{{ $e->program->nama_program }}</strong>?</p>
                                    <div class="d-flex justify-content-center gap-2 mt-3">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Ya, Sudah Lunas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalHapus{{ $e->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center p-4">
                                <form action="{{ route('enrollments.destroy', $e->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <h5 class="fw-bold">Hapus Data Pendaftaran?</h5>
                                    <p class="text-muted">Tindakan ini tidak bisa dibatalkan.</p>
                                    <div class="d-flex justify-content-center gap-2 mt-3">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Data pendaftaran tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection