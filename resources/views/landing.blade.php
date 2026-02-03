<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_title'] ?? 'SAPAI.ID - Les Privat Lampung' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&family=Domine:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Fredoka', sans-serif;
            scroll-behavior: smooth;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            /* Membuat teks lebih nyaman dibaca */
        }

        /* Variabel Warna */
        .bg-blue-custom {
            background-color: #2193b0;
            color: white;
        }

        .bg-light-custom {
            background-color: #f8faff;
            color: #333;
        }

        /* Padding antar section diperlebar */
        .section-padding {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        /* Wave Styling */
        .wave-divider {
            display: block;
            width: 100%;
            height: 80px;
            margin: 0;
        }

        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 15px 0;
            /* Navbar lebih tinggi sedikit */
        }

        .hero-section {
            padding-top: 120px;
            /* Jarak dari navbar */
            padding-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .gallery-img {
            height: 280px;
            object-fit: cover;
            border-radius: 20px;
            transition: 0.3s;
        }

        footer {
            background-color: #ffffff;
            padding: 80px 0 40px;
            /* Jarak footer lebih lega */
            border-top: 1px solid #eee;
        }

        .lead {
            font-size: 1.15rem;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#" style="color: #2193b0;">
                <img src="{{ asset($settings['site_logo'] ?? 'img/logo.png') }}" alt="Logo" height="40" class="me-2">
                {{ $settings['site_name'] ?? 'Les Privat Lampung' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item dropdown px-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Program</a>
                        <div class="dropdown-menu border-0 shadow-lg p-3" style="min-width: 250px;">
                            @forelse($programs as $prog)
                            <a class="dropdown-item d-flex align-items-center p-2 rounded" href="#">
                                <img src="{{ $prog->thumbnail ? asset('storage/' . $prog->thumbnail) : asset('assets/img/default-prog.png') }}"
                                    width="40" height="40" class="rounded me-3" style="object-fit: cover;">
                                <div>
                                    <div class="fw-bold small">{{ $prog->nama_program }}</div>
                                </div>
                            </a>
                            @empty
                            <div class="px-3 small">Belum ada program</div>
                            @endforelse
                        </div>
                    </li>
                    <li class="nav-item px-2"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item px-2"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="/login-siswa" class="btn btn-outline-info rounded-pill px-4 me-2">Login</a>
                        <a href="/daftar" class="btn btn-info text-white rounded-pill px-4">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section bg-blue-custom">
        <div class="container">
            <div class="row align-items-center pb-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-4">
                        {{ $settings['hero_title'] ?? 'Belajar Lebih Mudah & Menyenangkan' }}
                    </h1>
                    <p class="lead opacity-90">
                        {{ $settings['hero_subtitle'] ?? 'Platform bimbingan belajar online dengan materi terupdate dan mentor berpengalaman.' }}
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#program" class="btn btn-warning btn-lg px-5 fw-bold rounded-pill shadow">Mulai Belajar</a>
                        <a href="#materi" class="btn btn-outline-light btn-lg px-4 rounded-pill">Materi Gratis</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset($settings['hero_image'] ?? 'img/hero.gif') }}" alt="Hero" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
        <svg class="wave-divider" viewBox="0 0 1440 320" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="#f8faff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192V320H1392C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320H0Z"></path>
        </svg>
    </section>

    <section id="program" class="section-padding bg-light-custom">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-6">Program Unggulan</h2>
                <div class="bg-primary mx-auto mb-3" style="width: 60px; height: 4px; border-radius: 2px;"></div>
                <p class="text-muted">Pilih program belajar yang sesuai dengan jenjang Anda</p>
            </div>
            <div class="row g-4 mt-2">
                @forelse($programs_grid as $pg)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $pg->thumbnail ? asset('storage/' . $pg->thumbnail) : asset('assets/img/default-prog.png') }}"
                            class="card-img-top" style="height: 220px; object-fit: cover;">
                        <div class="card-body p-4 text-center">
                            <h5 class="card-title fw-bold text-dark">{{ $pg->nama_program }}</h5>
                            <p class="card-text text-muted small mb-4">{{ Str::limit($pg->deskripsi, 100) }}</p>
                            <a href="#" class="btn btn-outline-primary rounded-pill px-4">Detail Program</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Data program belum tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="galeri" class="section-padding bg-blue-custom">
        <div class="container text-center py-4">
            <h2 class="fw-bold mb-2 text-white">Galeri Kegiatan</h2>
            <p class="text-white-50 mb-5">Momen seru belajar bersama mentor kami.</p>
            <div class="row g-4">
                @forelse($galleries as $g)
                <div class="col-6 col-md-3">
                    <img src="{{ asset('storage/' . $g->image_path) }}"
                        class="img-fluid gallery-img w-100 shadow-lg"
                        alt="{{ $g->judul }}">
                </div>
                @empty
                <div class="col-12 text-center opacity-75 text-white">Belum ada foto kegiatan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="testimoni" class="section-padding bg-light-custom">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Apa Kata Siswa Kami</h2>
                <p class="text-muted">Testimoni asli dari siswa yang telah bergabung bersama kami.</p>
            </div>
            <div class="row g-4">
                @forelse($testimonials as $t)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 p-4">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="mb-3 text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $t->rating ? '' : 'text-light' }}"></i>
                                    @endfor
                            </div>
                            <p class="fst-italic text-secondary flex-grow-1 mb-4">
                                "{{ $t->testimoni }}"
                            </p>
                            <div class="mt-auto">
                                @if($t->user->foto_profil)
                                <img src="{{ asset('storage/' . $t->user->foto_profil) }}"
                                    class="rounded-circle mb-3 shadow-sm" width="70" height="70"
                                    style="object-fit: cover; border: 3px solid #2193b0;">
                                @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($t->user->nama_lengkap) }}&background=2193b0&color=fff&bold=true"
                                    alt="Avatar" width="70" height="70" class="rounded-circle border border-2 border-white-50 mb-3 shadow-sm">
                                @endif
                                <h6 class="mb-0 fw-bold">{{ $t->user->nama_lengkap }}</h6>
                                <small class="text-info fw-semibold">
                                    Lulusan {{ $t->user->enrollments->first()->program->nama_program ?? 'Program Belajar' }}
                                </small>
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
            <div class="row g-5">
                <div class="col-lg-4">
                    <h5 class="fw-bold text-primary mb-4">{{ $settings['site_name'] ?? 'Privatsapai.id' }}</h5>
                    <p class="text-muted small lh-lg">
                        {{ $settings['footer_about'] ?? 'Bimbingan belajar terpercaya untuk masa depan yang lebih cerah bersama Privatsapai.id.' }}
                    </p>
                    <div class="mt-4">
                        <a href="https://instagram.com/privatsapai.id" class="text-muted me-3 fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="https://facebook.com/privatsapai.id" class="text-muted me-3 fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com/Privatsapai.id" class="text-muted fs-5"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <h6 class="fw-bold mb-4">Tautan Pintar</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-3"><a href="#" class="text-muted text-decoration-none">Program Kami</a></li>
                        <li class="mb-3"><a href="#" class="text-muted text-decoration-none">Tentang Kami</a></li>
                        <li class="mb-3"><a href="#" class="text-muted text-decoration-none">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <h6 class="fw-bold mb-4">Hubungi Kami</h6>
                    <div class="small text-muted">
                        <p class="mb-3">
                            <i class="fab fa-whatsapp me-2 text-success fs-5"></i> 0813-6641-5914
                        </p>
                        <p class="mb-3">
                            <i class="fab fa-whatsapp me-2 text-success fs-5"></i> 0882-6828-7463
                        </p>
                        <p class="mb-3">
                            <i class="fas fa-envelope me-2 text-primary"></i> {{ $settings['email'] ?? 'info@privatsapai.id' }}
                        </p>
                        <p class="mb-0">
                            <i class="fab fa-instagram me-2 text-danger"></i> privatsapai.id
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-5 border-secondary opacity-25">
            <div class="text-center small text-muted opacity-75">
                &copy; 2026 {{ $settings['site_name'] ?? 'Privatsapai.id' }}. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>