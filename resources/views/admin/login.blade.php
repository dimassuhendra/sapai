<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - EduBot</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Domine:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-blue: #2193b0;
            --secondary-blue: #6dd5ed;
            --dark-text: #2d3436;
            --light-blue-gradient: linear-gradient(135deg, #2193b0, #6dd5ed);
        }

        body {
            background: #f4f7f6;
            font-family: 'Fredoka', 'Domine', Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 950px;
            display: flex;
            transition: all 0.3s ease;
        }

        /* Bagian Kiri (Info/Branding) */
        .login-info {
            background: var(--light-blue-gradient);
            padding: 60px 40px;
            width: 40%;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: left;
        }

        .login-info h1 {
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-top: 20px;
        }

        .login-info p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Bagian Kanan (Form) */
        .login-form-container {
            padding: 60px;
            width: 60%;
            background: white;
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 8px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group-custom i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b2bec3;
            transition: 0.3s;
        }

        .input-group-custom input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #f1f2f6;
            border-radius: 12px;
            outline: none;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .input-group-custom input:focus {
            border-color: var(--primary-blue);
            background-color: #f9fbfb;
        }

        .input-group-custom input:focus+i {
            color: var(--primary-blue);
        }

        .btn-login {
            background: var(--light-blue-gradient);
            border: none;
            border-radius: 12px;
            padding: 14px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            margin-top: 10px;
            transition: 0.4s;
            box-shadow: 0 4px 15px rgba(33, 147, 176, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(33, 147, 176, 0.4);
            color: white;
            opacity: 0.95;
        }

        .forgot-pass {
            text-align: right;
            margin-bottom: 25px;
        }

        .forgot-pass a {
            font-size: 0.85rem;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
        }

        /* Responsive Layout */
        @media (max-width: 850px) {
            .login-card {
                flex-direction: column;
                max-width: 450px;
            }

            .login-info {
                width: 100%;
                padding: 40px;
                text-align: center;
            }

            .login-info .logo-container {
                margin-bottom: 15px;
            }

            .login-form-container {
                width: 100%;
                padding: 40px 30px;
            }
        }

        .social-btn {
            width: 45px;
            height: 45px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid #eee;
            color: #555;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-btn:hover {
            background: #f8f9fa;
            border-color: #ddd;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-info">
            <div class="logo-container">
                <img src="{{ asset('img/logo.png') }}" alt="EduBot Logo" width="50" style="filter: brightness(0) invert(1);">
            </div>
            <div class="content">
                <h1>Selamat Datang Kembali!</h1>
                <p class="opacity-75">Kelola data, pantau aktivitas, dan tingkatkan performa sistem Anda dalam satu dasbor terintegrasi.</p>
            </div>
            <div class="small opacity-50">© 2026 EduBot Ecosystem</div>
        </div>

        <div class="login-form-container">
            <div class="form-header">
                <h2 class="form-title">Login Admin</h2>
                <p class="text-muted small">Silakan masuk menggunakan akun terdaftar</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger py-2 small border-0 mb-4">
                <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="input-group-custom">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Alamat Email" required value="{{ old('email') }}">
                </div>

                <div class="input-group-custom">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                </div>

                <div class="forgot-pass">
                    <a href="#">Lupa kata sandi?</a>
                </div>

                <button type="submit" class="btn btn-login w-100">MASUK SEKARANG</button>
            </form>
        </div>
    </div>

</body>

</html>