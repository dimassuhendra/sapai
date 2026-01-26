<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - SAPAI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-indigo: #4f46e5;
            --primary-violet: #7c3aed;
            --soft-bg: #f8fafc;
        }

        body {
            background-color: var(--soft-bg);
            font-family: 'Fredoka', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 0;
            background-image: radial-gradient(circle at top left, rgba(79, 70, 229, 0.05), transparent);
        }

        .register-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(79, 70, 229, 0.1);
            overflow: hidden;
            background: #fff;
        }

        .register-info {
            background: linear-gradient(135deg, var(--primary-indigo), var(--primary-violet));
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            backdrop-filter: blur(5px);
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-indigo);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            background-color: #fff;
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-indigo), var(--primary-violet));
            border: none;
            border-radius: 14px;
            padding: 14px;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(79, 70, 229, 0.3);
            opacity: 0.95;
        }

        .price-display {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            color: #166534;
            border: 1px dashed #86efac;
            border-radius: 15px;
            padding: 15px;
            display: none;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .text-indigo {
            color: var(--primary-indigo);
        }
    </style>
</head>

<body>
    @if(session('success_register'))
    <div class="modal fade" id="modalSukses" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success fa-5x"></i>
                    </div>
                    <h4 class="fw-bold">Pendaftaran Diterima!</h4>
                    <p class="text-muted small">Akun berhasil dibuat. Silahkan konfirmasi pembayaran di Dashboard.</p>

                    <div class="bg-light p-3 rounded-4 text-start mb-4 border">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Program:</span>
                            <span class="fw-bold small text-indigo">{{ session('success_register')['program'] }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Total Biaya:</span>
                            <span class="fw-bold text-danger">Rp {{ number_format(session('success_register')['harga'], 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="button" class="btn btn-register w-100 text-white fw-bold" data-bs-dismiss="modal">SIAP, LOGIN SEKARANG</button>
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
                            <div class="icon-circle">
                                <i class="fas fa-edit fa-2x"></i>
                            </div>
                            <h3 class="fw-bold">Mulai Sekarang!</h3>
                            <p class="opacity-75 small">Lengkapi formulir untuk mendapatkan akses ke ribuan materi belajar berkualitas.</p>

                            <div class="mt-auto opacity-50 small">
                                SAPAI &copy; 2026
                            </div>
                        </div>

                        <div class="col-md-8 p-4 p-lg-5 bg-white">
                            <div class="mb-4">
                                <h3 class="fw-bold text-dark">Buat Akun Siswa</h3>
                                <p class="text-muted small">Silahkan lengkapi data diri Anda secara benar.</p>
                            </div>

                            @if($errors->any())
                            <div class="alert alert-danger border-0 small rounded-3">
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
                                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Budi Santoso" value="{{ old('nama_lengkap') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="budisnt" value="{{ old('username') }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Alamat Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="budi@example.com" value="{{ old('email') }}" required>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label small fw-bold">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-indigo">Pilih Program Belajar</label>
                                    <select name="program_id" id="programSelect" class="form-select" required>
                                        <option value="" data-harga="0">-- Pilih Program --</option>
                                        @foreach($programs as $p)
                                        <option value="{{ $p->id }}" data-harga="{{ $p->harga }}">
                                            {{ $p->nama_program }} ({{ $p->durasi }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="priceWrapper" class="price-display text-center mb-4">
                                    <span class="small opacity-75 d-block">Investasi Belajar:</span>
                                    <span id="priceValue" class="fs-4 fw-bold"></span>
                                </div>

                                <button type="submit" class="btn btn-register btn-primary w-100 fw-bold text-white mb-3">
                                    DAFTAR SEKARANG <i class="fas fa-rocket ms-2"></i>
                                </button>

                                <div class="text-center">
                                    <p class="small text-muted mb-2">Sudah punya akun? <a href="{{ route('student.login') }}" class="text-decoration-none fw-bold text-indigo">Masuk di sini</a></p>
                                    <a href="/" class="small text-decoration-none text-muted"><i class="fas fa-arrow-left me-1"></i> Beranda</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Trigger modal jika sukses
        @if(session('success_register'))
        new bootstrap.Modal(document.getElementById('modalSukses')).show();
        @endif

        // Price Display Logic
        document.getElementById('programSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const wrapper = document.getElementById('priceWrapper');
            const display = document.getElementById('priceValue');

            if (harga > 0) {
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