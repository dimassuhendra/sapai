<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_title'] ?? 'EduBot - Bimbingan Belajar' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .navbar {
            transition: all 0.3s ease;
            border-bottom: 1px solid #eee;
        }

        .hero-section {
            padding: 100px 0;
            background-color: #f8f9fa;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .section-padding {
            padding: 80px 0;
        }

        .gallery-img {
            cursor: pointer;
            transition: 0.3s;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }

        .gallery-img:hover {
            transform: scale(1.05);
        }

        footer {
            background: #212529;
            color: white;
            padding: 50px 0 20px;
        }

        .mega-menu {
            min-width: 300px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <img src="{{ asset($settings['site_logo'] ?? 'assets/img/logo.png') }}" alt="Logo" height="40"
                    class="me-2">
                {{ $settings['site_name'] ?? 'EduBot' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Fitur</a></li>
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
                    <li class="nav-item"><a class="nav-link" href="#materi">Materi Umum</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="/login" class="btn btn-outline-primary px-4">Login</a>
                        <a href="/register" class="btn btn-primary px-4">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">
                        {{ $settings['hero_title'] ?? 'Belajar Lebih Mudah & Menyenangkan' }}
                    </h1>
                    <p class="lead mb-4 text-secondary">
                        {{ $settings['hero_subtitle'] ?? 'Platform bimbingan belajar online dengan materi terupdate dan mentor berpengalaman.' }}
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#program" class="btn btn-primary btn-lg px-4">Lihat Program</a>
                        <a href="#materi" class="btn btn-light btn-lg px-4 border">Materi Gratis</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset($settings['hero_image'] ?? 'assets/img/hero.gif') }}" alt="Hero"
                        class="img-fluid rounded shadow-sm">
                </div>
            </div>
        </div>
    </section>

    <section id="program" class="section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Program Unggulan</h2>
                <p class="text-muted">Pilih program belajar yang sesuai dengan jenjang Anda</p>
            </div>
            <div class="row g-4">
                @forelse($programs_grid as $pg)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm transition">
                            <img src="{{ asset($pg->thumbnail ?? 'assets/img/default-prog.png') }}" class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $pg->nama_program }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($pg->deskripsi, 100) }}</p>
                                <a href="#" class="btn btn-outline-primary w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">Data program belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="galeri" class="section-padding bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Galeri Kegiatan</h2>
            <div class="row g-3">
                @forelse($galleries as $g)
                    <div class="col-md-3">
                        <img src="{{ asset($g->file_foto) }}" class="img-fluid gallery-img w-100"
                            alt="{{ $g->judul_foto }}">
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">Belum ada foto kegiatan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Apa Kata Siswa Kami</h2>
            <div class="row g-4">
                @forelse($testimonials as $t)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 bg-light p-3">
                            <div class="card-body">
                                <p class="fst-italic text-secondary">"{{ $t->isi_testimoni }}"</p>
                                <div class="d-flex align-items-center mt-4">
                                    <img src="{{ asset($t->user->foto_profil ?? 'assets/img/user.png') }}"
                                        class="rounded-circle me-3" width="50" height="50">
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $t->user->nama_lengkap }}</h6>
                                        <small class="text-muted">Siswa Aktif</small>
                                    </div>
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
                <div class="col-lg-2 mb-4">
                    <h6>Tautan Pintar</h6>
                    <ul class="list-unstyled small mt-3">
                        <li><a href="#" class="text-muted text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6>Hubungi Kami</h6>
                    <p class="small text-muted mt-3">
                        <i class="fab fa-whatsapp me-2"></i> {{ $settings['wa_number'] ?? '0812xxxxxx' }}<br>
                        <i class="fas fa-envelope me-2"></i> {{ $settings['email'] ?? 'info@bimbel.com' }}
                    </p>
                </div>
            </div>
            <hr class="mt-4 border-secondary">
            <div class="text-center small text-muted">
                {{ $settings['footer_text'] ?? '© 2024 Bimbel EduBot. All Rights Reserved.' }}
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>