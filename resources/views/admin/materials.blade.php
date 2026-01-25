@extends('layouts.admin.master')

@section('title', 'Kelola Materi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Manajemen Materi Belajar</h3>
    <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalTambahMateri">
        <i class="fas fa-plus me-2"></i>Tambah Materi
    </button>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4">Urutan</th>
                        <th>Program</th>
                        <th>Judul Materi</th>
                        <th>Pembuat (Guru)</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materials as $m)
                    <tr>
                        <td class="px-4"><span class="badge bg-secondary">{{ $m->order_index }}</span></td>
                        <td><span class="badge bg-outline-primary border text-info">{{ $m->program->nama_program }}</span></td>
                        <td>
                            <div class="fw-bold">{{ $m->judul }}</div>
                        </td>
                        <td>{{ $m->guru->nama_lengkap ?? 'Admin' }}</td>
                        <td>
                            @if($m->is_public)
                            <span class="badge bg-light-success text-success border border-success px-3">
                                <i class="fas fa-eye me-1"></i> Public
                            </span>
                            @else
                            <span class="badge bg-light-secondary text-muted border border-secondary px-3">
                                <i class="fas fa-eye-slash me-1"></i> Draft
                            </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $m->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $m->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEdit{{ $m->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('materials.update', $m->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title">Edit Materi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Judul Materi</label>
                                            <input type="text" name="judul" class="form-control" value="{{ $m->judul }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Konten / Isi Materi</label>
                                            <textarea name="konten" class="form-control" rows="5">{{ $m->konten }}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">File Materi (PDF/PPT)</label>
                                                <input type="file" name="file_path" class="form-control">
                                                @if($m->file_path) <small class="text-info">File terpasang: {{ basename($m->file_path) }}</small> @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Urutan Posisi</label>
                                                <input type="number" name="order_index" class="form-control" value="{{ $m->order_index }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 mt-2">
                                            <label class="form-label fw-bold d-block">Status Publikasi</label>
                                            <div class="form-check form-switch">
                                                <input type="hidden" name="is_public" value="0">
                                                <input class="form-check-input" type="checkbox" name="is_public" value="1" id="switchPublicEdit{{ $m->id }}" {{ $m->is_public ? 'checked' : '' }}>
                                                <label class="form-check-label" for="switchPublicEdit{{ $m->id }}">
                                                    Tampilkan ke publik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-info text-white">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalHapus{{ $m->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="fas fa-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                                    </div>
                                    <h5 class="fw-bold">Hapus Materi?</h5>
                                    <p class="text-muted">Apakah Anda yakin ingin menghapus materi <br><strong>"{{ $m->judul }}"</strong>?</p>
                                    <p class="small text-danger italic">*File materi yang terkait juga akan terhapus secara permanen.</p>

                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('materials.destroy', $m->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger px-4">Ya, Hapus!</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada materi tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahMateri" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Tambah Materi Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Pilih Program</label>
                            <select name="program_id" class="form-select" required>
                                <option value="">-- Pilih Program --</option>
                                @foreach($programs as $prog)
                                <option value="{{ $prog->id }}">{{ $prog->nama_program }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Judul Materi</label>
                            <input type="text" name="judul" class="form-control" placeholder="Contoh: Pengenalan Aljabar" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Konten</label>
                        <textarea name="konten" class="form-control" rows="4" placeholder="Tuliskan isi materi atau ringkasan di sini..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload File (PDF/PPT/DOC)</label>
                        <input type="file" name="file_path" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold d-block">Status Publikasi</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_public" value="1" id="switchPublicTambah" checked>
                            <label class="form-check-label" for="switchPublicTambah">Tampilkan materi ini ke siswa (Public)</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white px-4">Simpan Materi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorModal = new bootstrap.Modal(document.getElementById('modalError'));
        errorModal.show();
    });
</script>
<div class="modal fade" id="modalError" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-circle me-2"></i>Terjadi Kesalahan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="text-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection