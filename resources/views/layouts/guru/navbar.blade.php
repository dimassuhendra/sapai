<nav class="navbar navbar-expand-lg border-0 px-3 mx-4 mt-3 shadow-lg"
    style="background: linear-gradient(135deg, #0d9488 0%, #10b981 100%); border-radius: 20px;">
    <div class="container-fluid">
        <span class="navbar-text fw-bold text-white" style="font-family: 'Domine', serif; font-size: 1.1rem;">
            Halo, {{ Auth::user()->nama_lengkap }} 👋
        </span>

        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle profile-trigger-light" data-bs-toggle="dropdown">
                    <div class="me-2 text-end d-none d-md-block">
                        <small class="d-block fw-bold text-white" style="line-height: 1;">{{ Auth::user()->nama_lengkap }}</small>
                        <small class="text-white-50" style="font-size: 0.7rem;">Pengajar SAPAI</small>
                    </div>
                    <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                        class="rounded-circle border border-2 border-white-50"
                        width="40" height="40" style="object-fit: cover;">
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 p-2 rounded-4">
                    <li class="px-3 py-2 d-md-none border-bottom mb-2">
                        <small class="fw-bold d-block">{{ Auth::user()->nama_lengkap }}</small>
                        <small class="text-muted">Pengajar</small>
                    </li>
                    <li>
                        <a class="dropdown-item rounded-3 py-2" href="#">
                            <i class="fas fa-user-circle me-2 text-success"></i> Profil Saya
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="#" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item rounded-3 py-2 text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    .profile-trigger-light {
        background: rgba(255, 255, 255, 0.15);
        padding: 5px 12px;
        border-radius: 50px;
        transition: 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .profile-trigger-light:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .dropdown-menu {
        font-family: 'Fredoka', sans-serif;
        min-width: 200px;
    }
</style>