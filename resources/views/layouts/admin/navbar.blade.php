<nav class="navbar navbar-expand-lg floating-navbar themed-navbar">
    <div class="container-fluid position-relative">

        <div class="navbar-bg-decoration">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
        </div>

        <button class="btn btn-toggle-custom shadow-sm" id="menu-toggle" type="button">
            <i class="fas fa-bars"></i>
        </button>

        <div class="ms-auto">
            <div class="dropdown">
                <button class="btn profile-dropdown-toggle border-0" type="button" id="userDropdown" data-bs-toggle="dropdown">
                    @php
                    $userNama = auth()->user()->nama_lengkap ?? 'Admin';
                    $inisial = strtoupper(substr($userNama, 0, 1));
                    // Pastikan foto_profil tidak null dan file-nya ada (opsional)
                    $hasPhoto = !empty(auth()->user()->foto_profil);
                    @endphp

                    <div class="d-flex align-items-center text-white">
                        @if($hasPhoto)
                        <img src="{{ asset('storage/avatars/' . auth()->user()->foto_profil) }}"
                            class="rounded-circle border border-2 border-white"
                            style="width: 35px; height: 35px; object-fit: cover;">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=fff&color=4f46e5&bold=true"
                            alt="Avatar" width="40" height="40" class="rounded-circle border border-2 border-white-50">
                        @endif

                        <span class="d-none d-md-inline-block fw-bold ms-2">{{ $userNama }}</span>
                        <i class="fas fa-chevron-down ms-1 small opacity-75"></i>
                    </div>
                </button>

                <ul class="dropdown-menu dropdown-menu-end custom-dropdown shadow border-0" aria-labelledby="userDropdown">
                    <li class="px-3 py-2 d-md-none border-bottom mb-2 text-center">
                        <small class="text-muted d-block">Masuk sebagai:</small>
                        <span class="fw-bold text-primary">{{ $userNama }}</span>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user-circle me-2 text-info"></i> Profil Saya</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2 text-info"></i> Ganti Password</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
                        </a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    /* NAVBAR CONTAINER */
    .floating-navbar.themed-navbar {
        margin: 15px 25px 5px 25px;
        background: linear-gradient(135deg, #2193b0, #6dd5ed);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 10px 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 30px rgba(33, 147, 176, 0.15);
        position: relative;
        z-index: 1000;
        overflow: visible;
        /* Penting agar dropdown tidak terpotong */
    }

    /* DECORATION */
    .navbar-bg-decoration {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
        border-radius: 20px;
    }

    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(30px);
        opacity: 0.2;
    }

    .blob-1 {
        width: 120px;
        height: 120px;
        background: #fff;
        top: -50px;
        left: 15%;
    }

    .blob-2 {
        width: 100px;
        height: 100px;
        background: #fff;
        bottom: -40px;
        right: 10%;
    }

    /* TOGGLE BUTTON */
    .btn-toggle-custom {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 12px;
        border: none;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .btn-toggle-custom:hover {
        background: white;
        color: #2193b0;
    }

    /* PROFILE AREA */
    .profile-dropdown-toggle {
        background: rgba(255, 255, 255, 0.1) !important;
        padding: 5px 15px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .profile-dropdown-toggle:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        transform: translateY(-2px);
    }

    .profile-container {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .profile-img,
    .avatar-initial {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .avatar-initial {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    /* DROPDOWN MENU */
    .custom-dropdown {
        border-radius: 18px;
        margin-top: 10px;
        padding: 10px;
        min-width: 220px;
    }

    .custom-dropdown .dropdown-item {
        border-radius: 10px;
        padding: 10px 15px;
        transition: 0.2s;
        font-family: 'Fredoka', sans-serif;
    }

    .custom-dropdown .dropdown-item:hover {
        background: rgba(33, 147, 176, 0.05);
        color: #2193b0;
        transform: translateX(5px);
    }

    @media (max-width: 768px) {
        .floating-navbar.themed-navbar {
            margin: 10px;
            padding: 8px 15px;
        }
    }
</style>