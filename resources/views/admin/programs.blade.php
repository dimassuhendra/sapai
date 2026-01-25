@extends('layouts.admin.master')

@section('title', 'Kelola Program')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-dark">Manajemen Program</h3>
    <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus me-2"></i>Tambah Program
    </button>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4" width="80">Posisi</th>
                        <th>Thumbnail</th>
                        <th>Program</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $p)
                    <tr>
                        <td class="px-4 text-center"><span class="badge bg-secondary">{{ $p->urutan }}</span></td>
                        <td>
                            <img src="{{ asset('storage/'.$p->thumbnail) }}" class="rounded" width="70" height="45" style="object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold">{{ $p->nama_program }}</div>
                            <small class="text-muted">{{ Str::limit($p->deskripsi, 150) }}</small>
                        </td>
                        <td class="fw-bold text-secondary">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $p->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $p->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('programs.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title">Edit Program</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="row">
                                            <div class="col-md-8 mb-3">
                                                <label class="form-label small fw-bold">Nama Program</label>
                                                <input type="text" name="nama_program" class="form-control" value="{{ $p->nama_program }}" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label small fw-bold">Harga</label>
                                                <input type="number" name="harga" class="form-control" value="{{ $p->harga }}" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label small fw-bold">Thumbnail (Kosongkan jika tidak diganti)</label>
                                                <input type="file" name="thumbnail" class="form-control">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label small fw-bold">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="3">{{ $p->deskripsi }}</textarea>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label small fw-bold">Urutan Tampil</label>
                                                <input type="number" name="urutan" class="form-control" value="{{ $p->urutan }}">
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

                    <div class="modal fade" id="modalHapus{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center p-4">
                                    <i class="fas fa-exclamation-triangle text-danger display-4 mb-3"></i>
                                    <h5>Hapus Program?</h5>
                                    <p class="text-muted">Anda akan menghapus <strong>{{ $p->nama_program }}</strong>. Tindakan ini tidak dapat dibatalkan.</p>
                                    <div class="d-flex justify-content-center gap-2 mt-4">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('programs.destroy', $p->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Data program belum tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Tambah Program Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label small fw-bold">Nama Program</label>
                            <input type="text" name="nama_program" class="form-control" placeholder="Contoh: Program SD" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small fw-bold">Harga</label>
                            <input type="number" name="harga" class="form-control" placeholder="300000" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label small fw-bold">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label small fw-bold">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan secara singkat mengenai program ini..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info px-4 text-white">Simpan Program</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection