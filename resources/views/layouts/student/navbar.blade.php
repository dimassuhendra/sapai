<nav class="navbar navbar-expand-lg navbar-dark rounded-4 shadow-lg border-0 px-3 py-2"
    style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="btn btn-white-50 d-md-none me-3" id="student-sidebar-toggle">
                <i class="fas fa-bars text-white"></i>
            </button>
            <h5 class="mb-0 fw-bold text-white opacity-90">
                Selamat Datang, {{ Auth::user()->nama_lengkap }} 👋
            </h5>
        </div>

        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle profile-nav-light" data-bs-toggle="dropdown">
                    <div class="text-end me-2 d-none d-sm-block">
                        <small class="d-block fw-bold text-white">{{ Auth::user()->nama_lengkap }}</small>
                        <small class="text-white-50" style="font-size: 0.7rem;">Siswa Aktif</small>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=fff&color=4f46e5&bold=true"
                        alt="Avatar" width="40" height="40" class="rounded-circle border border-2 border-white-50">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                    <li><a class="dropdown-item py-2" href="{{ route('student.profile.index') }}"><i class="fas fa-user-edit me-2"></i> Profil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('student.logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger py-2"><i class="fas fa-sign-out-alt me-2"></i> Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    .profile-nav-light {
        background: rgba(255, 255, 255, 0.1);
        padding: 5px 12px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .profile-nav-light:hover {
        background: rgba(255, 255, 255, 0.2);
    }
</style>