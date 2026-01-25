@extends('layouts.admin.master')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Galeri Kegiatan</h3>
    <button class="btn btn-info text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-upload me-2"></i>Upload Foto
    </button>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
    @forelse($galleries as $g)
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm h-100" style="overflow: visible;">
            <img src="{{ asset('storage/' . $g->image_path) }}" class="card-img-top" style="height: 180px; object-fit: cover; border-radius: 8px 8px 0 0;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="badge bg-secondary mb-2">Urutan: {{ $g->order_index }}</span>

                    <div class="dropdown">
                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $g->id }}">
                                    <i class="fas fa-edit me-2 text-info"></i> Edit
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $g->id }}">
                                    <i class="fas fa-trash me-2"></i> Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <h6 class="fw-bold mb-1">{{ $g->judul }}</h6>
                <p class="small text-muted mb-0">{{ Str::limit($g->keterangan, 50) ?: '-' }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="text-muted">
            <i class="fas fa-images fa-3x mb-3"></i>
            <p>Belum ada koleksi foto dalam galeri.</p>
        </div>
    </div>
    @endforelse
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold bg-info text-white">Tambah Foto Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Foto</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Kegiatan Belajar" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Tulis deskripsi singkat..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Foto</label>
                        <input type="file" name="image" class="form-control" required>
                        <small class="text-muted">Format: JPG, PNG. Maksimal: 2MB</small>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white px-4">Mulai Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($galleries as $g)
<div class="modal fade" id="modalEdit{{ $g->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('galleries.update', $g->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header border-0 bg-info text-white">
                    <h5 class="modal-title fw-bold">Edit Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul</label>
                        <input type="text" name="judul" class="form-control" value="{{ $g->judul }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $g->keterangan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Urutan Tampil</label>
                        <input type="number" name="order_index" class="form-control" value="{{ $g->order_index }}">
                    </div>
                    <div class="mb-3 text-center">
                        <p class="small text-muted mb-2">Preview Foto Saat Ini:</p>
                        <img src="{{ asset('storage/' . $g->image_path) }}" class="img-thumbnail" style="height: 100px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ganti Foto</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted text-italic">*Kosongkan jika tidak ingin mengubah foto</small>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapus{{ $g->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center p-3 border-0">
            <div class="modal-body">
                <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                <h5 class="fw-bold">Hapus Foto?</h5>
                <p class="text-muted small">Foto ini akan dihapus secara permanen dari galeri.</p>
                <form action="{{ route('galleries.destroy', $g->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection