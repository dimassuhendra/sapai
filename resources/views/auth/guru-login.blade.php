<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengajar - SAPAI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            /* Palette Guru: Teal ke Emerald */
            --primary-teal: #0d9488;
            --primary-emerald: #10b981;
            --soft-bg: #f0fdfa;
        }

        body {
            background-color: var(--soft-bg);
            font-family: 'Fredoka', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            /* Pola background halus */
            background-image: radial-gradient(circle at top right, rgba(13, 148, 136, 0.05), transparent),
                radial-gradient(circle at bottom left, rgba(16, 185, 129, 0.05), transparent);
        }

        .login-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(13, 148, 136, 0.1);
            overflow: hidden;
            background: #fff;
        }

        /* Panel Info Kiri (Sama dengan Siswa, hanya beda warna) */
        .login-info {
            background: linear-gradient(135deg, var(--primary-teal), var(--primary-emerald));
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .icon-circle {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            backdrop-filter: blur(5px);
        }

        /* Form Styling */
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .form-control:focus {
            border-color: var(--primary-teal);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
            background-color: #fff;
        }

        .input-group-text {
            border-radius: 12px;
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: var(--primary-teal);
        }

        /* Button Styling */
        .btn-teacher {
            background: linear-gradient(135deg, var(--primary-teal), var(--primary-emerald));
            border: none;
            border-radius: 14px;
            padding: 14px;
            color: white;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(13, 148, 136, 0.2);
        }

        .btn-teacher:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(13, 148, 136, 0.3);
            color: white;
            opacity: 0.95;
        }

        .text-teal {
            color: var(--primary-teal);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card login-card">
                    <div class="row g-0">
                        <div class="col-md-5 login-info d-none d-md-flex text-center">
                            <div class="icon-circle">
                                <i class="fas fa-chalkboard-teacher fa-3x"></i>
                            </div>
                            <h2 class="fw-bold mb-3">Portal Guru</h2>
                            <p class="opacity-75 fs-6">Dedikasi Anda membentuk masa depan. Masuk untuk mengelola materi dan berinteraksi dengan siswa.</p>

                            <div class="mt-auto">
                                <small class="opacity-50">Sistem Akademik SAPAI</small>
                            </div>
                        </div>

                        <div class="col-md-7 p-4 p-lg-5 bg-white">
                            <div class="mb-5 text-center text-md-start">
                                <h3 class="fw-bold text-dark mb-2">Selamat Datang, Pengajar!</h3>
                                <p class="text-muted small">Gunakan akun resmi pengajar Anda.</p>
                            </div>

                            @if($errors->any())
                            <div class="alert alert-danger border-0 small rounded-3 d-flex align-items-center mb-4">
                                <i class="fas fa-exclamation-circle me-3"></i>
                                <div>{{ $errors->first() }}</div>
                            </div>
                            @endif

                            <form action="{{ route('guru.login.submit') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-dark">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-end-0"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" class="form-control border-start-0"
                                            placeholder="guru@sapai.com" value="{{ old('email') }}" required autofocus>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-dark">Kata Sandi</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-end-0"><i class="fas fa-lock"></i></span>
                                        <input type="password" name="password" class="form-control border-start-0"
                                            placeholder="••••••••" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-teacher w-100 mb-4 text-white">
                                    MASUK KE DASHBOARD <i class="fas fa-sign-in-alt ms-2"></i>
                                </button>

                                <div class="text-center">
                                    <a href="/" class="small text-decoration-none text-muted">
                                        <i class="fas fa-house me-1"></i> Kembali ke Beranda
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>