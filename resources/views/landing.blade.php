<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_title'] ?? 'EduBot - Bimbingan Belajar' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Courier+Prime:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Acme', sans-serif;
            scroll-behavior: smooth;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Variabel Warna */
        .bg-blue-custom {
            background-color: #3b82f6;
            color: white;
        }

        .bg-light-custom {
            background-color: #f8faff;
            color: #333;
        }

        .section-padding {
            padding-top: 80px;
            padding-bottom: 0;
        }

        /* Wave Styling */
        .wave-divider {
            display: block;
            width: 100%;
            height: 100px;
            /* Tinggi wave diperbesar */
            margin: 0;
        }

        /* Navbar Custom */
        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            padding-top: 80px;
            padding-bottom: 0;
            /* Biar wave menempel di bawah */
        }

        .card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .gallery-img {
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            transition: 0.3s;
        }

        footer {
            background: #212529;
            color: white;
            padding: 60px 0 30px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <img src="{{ asset($settings['site_logo'] ?? 'img/logo.png') }}" alt="Logo" height="40" class="me-2">
                {{ $settings['site_name'] ?? 'EduBot' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Program</a>
                        <div class="dropdown-menu mega-menu border-0 shadow">
                            <div class="row">
                                @forelse($programs as $prog)
                                <div class="col-12 mb-2">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <img src="{{ asset($prog->thumbnail ?? 'assets/img/default-prog.png') }}"
                                            width="40" class="rounded me-2">
                                        <div>
                                            <div class="fw-bold">{{ $prog->nama_program }}</div>
                                            <small class="text-muted">{{ Str::limit($prog->deskripsi, 30) }}</small>
                                        </div>
                                    </a>
                                </div>
                                @empty
                                <div class="px-3">Belum ada program</div>
                                @endforelse
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="/login" class="btn btn-outline-primary px-4">Login</a>
                        <a href="/register" class="btn btn-primary px-4">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section bg-blue-custom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">
                        {{ $settings['hero_title'] ?? 'Belajar Lebih Mudah & Menyenangkan' }}
                    </h1>
                    <p class="lead mb-4 opacity-90">
                        {{ $settings['hero_subtitle'] ?? 'Platform bimbingan belajar online dengan materi terupdate dan mentor berpengalaman.' }}
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#program" class="btn btn-warning btn-lg px-4 fw-bold shadow">Lihat Program</a>
                        <a href="#materi" class="btn btn-light btn-lg px-4 border shadow-sm">Materi Gratis</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <img src="{{ asset($settings['hero_image'] ?? 'img/hero.gif') }}" alt="Hero" class="img-fluid rounded">
                </div>
            </div>
        </div>
        <svg class="wave-divider" viewBox="0 0 1440 320" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#f8faff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z"></path>
        </svg>
    </section>

    <section id="program" class="hero-padding bg-light-custom">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Program Unggulan</h2>
                <p class="text-muted">Pilih program belajar yang sesuai dengan jenjang Anda</p>
            </div>
            <div class="row g-4">
                @forelse($programs_grid as $pg)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($pg->thumbnail ?? 'assets/img/default-prog.png') }}" class="card-img-top" style="border-radius: 20px 20px 0 0;">
                        <div class="card-body p-4 text-center">
                            <h5 class="card-title fw-bold text-primary">{{ $pg->nama_program }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($pg->deskripsi, 100) }}</p>
                            <a href="#" class="btn btn-outline-primary rounded-pill px-4">Detail Program</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Data program belum tersedia.</div>
                @endforelse
            </div>
        </div>
        <svg class="wave-divider" viewBox="0 0 1440 320" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#3b82f6" fill-opacity="1" d="M0,160L60,176C120,192,240,224,360,208C480,192,600,128,720,122.7C840,117,960,171,1080,186.7C1200,203,1320,181,1380,170.7L1440,160V320H1380C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320H0V160Z"></path>
        </svg>
    </section>

    <section id="galeri" class="section-padding bg-blue-custom">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">Galeri Kegiatan</h2>
            <div class="row g-3">
                @forelse($galleries as $g)
                <div class="col-6 col-md-3">
                    <img src="{{ asset($g->file_foto) }}" class="img-fluid gallery-img w-100 shadow" alt="{{ $g->judul_foto }}">
                </div>
                @empty
                <div class="col-12 text-center opacity-75">Belum ada foto kegiatan.</div>
                @endforelse
            </div>
        </div>
        <svg class="wave-divider" viewBox="0 0 1440 320" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#f8faff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z"></path>
        </svg>
    </section>

    <section id="testimoni" class="section-padding bg-light-custom">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Apa Kata Siswa Kami</h2>
            <div class="row g-4">
                @forelse($testimonials as $t)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm p-4 text-center">
                        <div class="card-body">
                            <i class="fas fa-quote-left text-primary mb-3" style="font-size: 1.5rem; opacity: 0.3;"></i>
                            <p class="fst-italic text-secondary">"{{ $t->isi_testimoni }}"</p>
                            <div class="mt-4">
                                <img src="{{ asset($t->user->foto_profil ?? 'assets/img/user.png') }}"
                                    class="rounded-circle mb-2" width="60" height="60" style="object-fit: cover; border: 3px solid #3b82f6;">
                                <h6 class="mb-0 fw-bold">{{ $t->user->nama_lengkap }}</h6>
                                <small class="text-primary">Siswa Aktif</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Belum ada testimoni.</div>
                @endforelse
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold text-primary mb-3">{{ $settings['site_name'] ?? 'EduBot' }}</h5>
                    <p class="text-muted small">
                        {{ $settings['footer_about'] ?? 'Bimbingan belajar terpercaya untuk masa depan yang lebih cerah.' }}
                    </p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6>Tautan Pintar</h6>
                    <ul class="list-unstyled small mt-3">
                        <li><a href="#" class="text-muted text-decoration-none">Program Kami</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4 text-lg-end">
                    <h6>Hubungi Kami</h6>
                    <p class="small text-muted mt-3">
                        <i class="fab fa-whatsapp me-2"></i> {{ $settings['wa_number'] ?? '0812xxxxxx' }}<br>
                        <i class="fas fa-envelope me-2"></i> {{ $settings['email'] ?? 'info@bimbel.com' }}
                    </p>
                </div>
            </div>
            <hr class="mt-4 border-secondary">
            <div class="text-center small text-muted opacity-50">
                {{ $settings['footer_text'] ?? '© 2026 Bimbel EduBot. All Rights Reserved.' }}
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>