@extends('layouts.admin.master')

@section('title', 'Manajemen Testimoni')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Manajemen Testimoni</h4>
            <p class="text-muted">Kelola testimoni siswa yang akan ditampilkan di halaman utama.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Siswa</th>
                            <th>Rating</th>
                            <th>Isi Testimoni</th>
                            <th>Status Tampil</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testi)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        {{ substr($testi->user->nama_lengkap, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="fw-bold d-block">{{ $testi->user->nama_lengkap }}</span>
                                        <small class="text-muted">{{ $testi->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testi->rating ? 'text-warning' : 'text-light' }}"></i>
                                    @endfor
                            </td>
                            <td>
                                <p class="small mb-0 text-muted">{{ Str::limit($testi->testimoni, 100) }}</p>
                            </td>
                            <td>
                                @if($testi->status_tampil)
                                <span class="badge bg-success-subtle text-success rounded-pill px-3">Published</span>
                                @else
                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">Draft</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <form action="{{ route('admin.testimoni.toggle', $testi->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $testi->status_tampil ? 'btn-outline-warning' : 'btn-outline-success' }} rounded-pill px-3">
                                            {{ $testi->status_tampil ? 'Sembunyikan' : 'Tampilkan' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.testimoni.destroy', $testi->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada testimoni masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection