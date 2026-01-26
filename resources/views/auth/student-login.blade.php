<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - Sapai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Domine:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Fredoka', 'Domine', Roboto, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-info {
            background: linear-gradient(135deg, #2193b0, #6dd5ed);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btn-login {
            background: #2193b0;
            border: none;
            border-radius: 50px;
            padding: 12px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #1a7a94;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card login-card">
                    <div class="row g-0">
                        <div class="col-md-5 login-info d-none d-md-flex text-center">
                            <i class="fas fa-user-graduate fa-5x mb-4"></i>
                            <h3 class="fw-bold">Halo Siswa!</h3>
                            <p>Silahkan masuk untuk melanjutkan belajar dan mengakses materi program Anda.</p>
                        </div>

                        <div class="col-md-7 p-5 bg-white">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold text-dark">Masuk Akun</h3>
                                <p class="text-muted">Gunakan email terdaftar Anda</p>
                            </div>

                            @if($errors->any())
                            <div class="alert alert-danger border-0 small">
                                <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
                            </div>
                            @endif

                            <form action="{{ route('student.login.submit') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                        <input type="email" name="email" class="form-control bg-light border-start-0" placeholder="nama@email.com" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                        <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 btn-login fw-bold mb-3">MASUK SEKARANG</button>

                                <div class="text-center">
                                    <p class="small text-muted">Belum punya akun? <a href="{{ route('student.register') }}" class="text-decoration-none fw-bold text-info">Daftar Program</a></p>
                                    <a href="/" class="small text-decoration-none text-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
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
        @if(session('success_register'))
        var myModal = new bootstrap.Modal(document.getElementById('modalSukses'));
        myModal.show();
        @endif
    </script>

</body>

</html>