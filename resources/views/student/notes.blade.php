@extends('layouts.student.master')

@section('title', 'Catatan Saya')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 class="fw-bold">Catatan Belajar</h4>
            <p class="text-muted">Simpan poin-poin penting dari materi yang telah Anda pelajari.</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                <i class="fas fa-plus me-2"></i>Tambah Catatan
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        @forelse($notes as $note)
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                            {{ $note->judul_materi }}
                        </span>
                        <form action="{{ route('student.notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Hapus catatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger p-0"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <p class="card-text text-dark" style="white-space: pre-line;">{{ $note->konten }}</p>
                    <hr class="opacity-10">
                    <small class="text-muted">Dibuat pada: {{ date('d M Y, H:i', strtotime($note->created_at)) }}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 120px; height: 120px;">
                    <i class="fas fa-sticky-note fa-4x text-muted opacity-50"></i>
                </div>
            </div>
            <h5 class="fw-bold text-muted">Belum Ada Catatan</h5>
            <p class="text-muted">Sepertinya Anda belum menulis rangkuman materi. <br> Mulailah mencatat poin penting agar belajar lebih efektif!</p>
            <button class="btn btn-outline-primary rounded-pill mt-3 px-4" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                <i class="fas fa-plus me-2"></i>Buat Catatan Pertama
            </button>
        </div>
        @endforelse
    </div>
</div>

<div class="modal fade" id="addNoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="{{ route('student.notes.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-bold mb-0">Tambah Catatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pilih Materi</label>
                        <select name="material_id" class="form-select rounded-3" required>
                            <option value="" disabled selected>Pilih materi...</option>
                            @foreach($materials as $m)
                            <option value="{{ $m->id }}">{{ $m->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Isi Catatan</label>
                        <textarea name="konten" class="form-control rounded-3" rows="5" placeholder="Tulis rangkuman atau poin penting di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection