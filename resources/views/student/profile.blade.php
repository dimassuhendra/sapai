@extends('layouts.student.master')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Pengaturan Profil</h4>
            <p class="text-muted">Kelola informasi pribadi dan keamanan akun Anda.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="position-relative d-inline-block mx-auto mb-3">
                    @if($user->foto_profil)
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" class="rounded-circle shadow-sm" width="150" height="150" style="object-fit: cover; border: 5px solid #f8f9fa;">
                    @else
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                        style="width:150px;height:150px;font-size:3rem;background-color: var(--student-secondary);">
                        {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                    </div>

                    @endif
                </div>
                <h5 class="fw-bold mb-1">{{ $user->nama_lengkap }}</h5>
                <p class="text-muted small mb-3">{{ $user->email }}</p>
                <span class="badge bg-primary-subtle text-primary rounded-pill px-3">Siswa Aktif</span>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h6 class="fw-bold mb-4"><i class="fas fa-user-edit me-2 text-primary"></i>Informasi Pribadi</h6>
                <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control rounded-3" value="{{ $user->nama_lengkap }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control rounded-3" value="{{ $user->email }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Nomor HP/WhatsApp</label>
                            <input type="text" name="no_hp" class="form-control rounded-3" value="{{ $user->no_hp }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Ganti Foto Profil</label>
                            <input type="file" name="foto_profil" class="form-control rounded-3">
                            <small class="text-muted" style="font-size: 0.7rem;">Format: JPG, PNG. Max: 2MB</small>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn text-white rounded-pill px-4 shadow-sm" style="background-color: var(--student-secondary);">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-bold mb-4"><i class="fas fa-lock me-2 text-warning"></i>Keamanan Akun</h6>
                <form action="{{ route('student.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label small fw-bold">Password Lama</label>
                            <input type="password" name="current_password" class="form-control rounded-3 @error('current_password') is-invalid @enderror" required>
                            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small fw-bold">Password Baru</label>
                            <input type="password" name="new_password" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label small fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control rounded-3" required>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-warning text-white rounded-pill px-4 shadow-sm">Ganti Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection