<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - Sapai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Domine:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Fredoka', 'Domine', Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        .register-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .register-info {
            background: linear-gradient(135deg, #2193b0, #6dd5ed);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btn-register {
            background: #2193b0;
            border: none;
            border-radius: 50px;
            padding: 12px;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: #1a7a94;
            transform: translateY(-2px);
        }

        .price-display {
            background-color: #e7f3ff;
            color: #0d6efd;
            border-radius: 10px;
            padding: 10px;
            font-weight: bold;
            display: none;
            /* Hidden by default */
        }
    </style>
</head>

<body>
    @if(session('success_register'))
    <div class="modal fade" id="modalSukses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 20px;">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success fa-5x"></i>
                    </div>
                    <h4 class="fw-bold">Pendaftaran Diterima!</h4>
                    <p class="text-muted">Selamat, akun Anda berhasil dibuat. Berikut adalah rincian pendaftaran Anda:</p>

                    <div class="bg-light p-3 rounded-4 text-start mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Nama:</span>
                            <span class="fw-bold small">{{ session('success_register')['nama'] }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Program:</span>
                            <span class="fw-bold small text-primary">{{ session('success_register')['program'] }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Total Biaya:</span>
                            <span class="fw-bold text-danger">Rp {{ number_format(session('success_register')['harga'], 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <p class="small text-muted mb-4 italic text-center">
                        *Silahkan login untuk melakukan konfirmasi pembayaran di dashboard siswa.
                    </p>

                    <button type="button" class="btn btn-primary w-100 rounded-pill py-2 fw-bold" data-bs-dismiss="modal">SIAP, LOGIN SEKARANG</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card register-card">
                    <div class="row g-0">
                        <div class="col-md-4 register-info d-none d-md-flex text-center">
                            <i class="fas fa-edit fa-5x mb-4"></i>
                            <h3 class="fw-bold">Gabung Sekarang!</h3>
                            <p>Mulai perjalanan belajarmu bersama pengajar ahli dan kurikulum terbaik kami.</p>
                        </div>

                        <div class="col-md-8 p-5 bg-white">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold text-dark">Pendaftaran Siswa</h3>
                                <p class="text-muted">Lengkapi data untuk membuat akun baru</p>
                            </div>

                            @if($errors->any())
                            <div class="alert alert-danger border-0 small">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('student.register.submit') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control bg-light" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Username</label>
                                        <input type="text" name="username" class="form-control bg-light" placeholder="username_siswa" value="{{ old('username') }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Alamat Email</label>
                                    <input type="email" name="email" class="form-control bg-light" placeholder="nama@email.com" value="{{ old('email') }}" required>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Password</label>
                                        <input type="password" name="password" class="form-control bg-light" placeholder="••••••••" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control bg-light" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-info">Pilih Program Belajar</label>
                                    <select name="program_id" id="programSelect" class="form-select bg-light" required>
                                        <option value="" data-harga="0">-- Pilih Program --</option>
                                        @foreach($programs as $p)
                                        <option value="{{ $p->id }}" data-harga="{{ $p->harga }}">
                                            {{ $p->nama_program }} ({{ $p->durasi }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="priceWrapper" class="price-display text-center mb-4">
                                    <span class="small text-muted d-block">Biaya Program:</span>
                                    <span id="priceValue" class="fs-4"></span>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-register fw-bold mb-3 text-white">DAFTAR SEKARANG</button>

                                <div class="text-center">
                                    <p class="small text-muted">Sudah punya akun? <a href="{{ route('student.login') }}" class="text-decoration-none fw-bold text-info">Masuk di sini</a></p>
                                    <a href="/" class="small text-decoration-none text-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('programSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const wrapper = document.getElementById('priceWrapper');
            const display = document.getElementById('priceValue');

            if (harga > 0) {
                // Format mata uang Rupiah
                const formatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(harga);

                display.innerText = formatted;
                wrapper.style.display = 'block';
            } else {
                wrapper.style.display = 'none';
            }
        });
    </script>

</body>

</html>