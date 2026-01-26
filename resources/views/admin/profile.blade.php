@extends('layouts.admin.master')

@section('title', 'Profil Admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold">Pengaturan Profil</h3>
        <p class="text-muted">Kelola informasi akun dan keamanan password Anda.</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
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

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h5 class="fw-bold mb-3">Informasi Pribadi</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold mb-3 text-danger">Ganti Password</h5>
                        <p class="small text-muted mb-4">Kosongkan kolom di bawah ini jika Anda tidak ingin mengubah password.</p>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-check-double"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-info text-white px-4">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="card-body">
                    {{-- Mengambil huruf pertama dari nama dan menambahkan parameter length=1 --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama_lengkap) }}&background=2193b0&color=fff&size=128&length=1"
                        class="rounded-circle shadow-sm mb-3"
                        alt="Avatar">

                    <h5 class="fw-bold mb-0">{{ $user->nama_lengkap }}</h5>
                    <p class="badge bg-info text-white mt-2">Administrator</p>
                    <hr>
                    <small class="text-muted d-block">Terdaftar sejak:</small>
                    <small class="fw-bold">{{ $user->created_at->format('d M Y') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection