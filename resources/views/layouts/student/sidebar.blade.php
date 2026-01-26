<nav id="sidebar" class="student-sidebar">
    <div class="sidebar-header p-4 text-center">
        <div class="student-logo-box mx-auto mb-2">
            <i class="fas fa-user-graduate"></i>
        </div>
        <h4 class="fw-bold text-white mb-0">SAPAI</h4>
        <p class="small opacity-75 text-white">Panel Belajar Siswa</p>
    </div>

    <div class="list-group list-group-flush px-3 flex-grow-1">
        <a href="{{ route('student.dashboard') }}"
            class="nav-link {{ Request::is('dashboard-siswa*') ? 'active' : '' }}">
            <i class="fas fa-home"></i> <span>Dashboard</span>
        </a>

        <a href="{{ route('student.program') }}" class="nav-link {{ Request::is('student/programs*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i> <span>Program Saya</span>
        </a>

        <a href="{{ route('student.material.index') }}"
            class="nav-link {{ Request::is('materi-belajar*') ? 'active' : '' }}">
            <i class="fas fa-book-open"></i> Materi Belajar
        </a>

        <a href="{{ route('student.progress') }}" class="nav-link {{ Request::is('progres-belajar') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Progres Belajar
        </a>

        <a href="{{ route('student.notes.index') }}" class="nav-link {{ Request::is('catatan-saya') ? 'active' : '' }}">
            <i class="fas fa-sticky-note"></i> Catatan Saya
        </a>

        <div class="menu-divider my-3"></div>

        <a href="{{ route('student.testimoni.index') }}" class="nav-link {{ Request::is('testimoni') ? 'active' : '' }}">
            <i class="fas fa-star"></i> Beri Testimoni
        </a>

        <form action="{{ route('student.logout') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="nav-link logout-btn border-0 bg-transparent w-100 text-start">
                <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
            </button>
        </form>
    </div>

    <div class="sidebar-footer p-3 text-center">
        <small class="text-white-50">Versi Siswa 1.0</small>
    </div>
</nav>

<style>
    /* PALET WARNA: Indigo ke Violet (Satu palet dengan biru admin tapi beda nuansa) */
    :root {
        --student-bg: #4f46e5;
        /* Indigo */
        --student-bg-light: #7c3aed;
        /* Violet */
        --student-active: #ffffff;
        --student-hover: rgba(255, 255, 255, 0.12);
        --student-text: rgba(255, 255, 255, 0.8);
    }

    #sidebar.student-sidebar {
        min-height: 100vh;
        width: 280px;
        background: linear-gradient(180deg, var(--student-bg) 0%, var(--student-bg-light) 100%);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        color: white;
        position: fixed;
        height: 100vh;
        z-index: 1000;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
    }

    /* Logo Box Siswa */
    .student-logo-box {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    /* Styling Nav Link */
    .student-sidebar .nav-link {
        color: var(--student-text);
        padding: 12px 18px;
        border-radius: 14px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 500;
    }

    .student-sidebar .nav-link i {
        width: 30px;
        font-size: 1.1rem;
        transition: 0.3s;
    }

    /* Hover State */
    .student-sidebar .nav-link:hover:not(.active) {
        background: var(--student-hover);
        color: #ffffff;
        transform: translateX(5px);
    }

    /* Active State (Halaman Aktif) */
    .student-sidebar .nav-link.active {
        background: #ffffff !important;
        color: var(--student-bg) !important;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        font-weight: 700;
        transform: scale(1.02);
    }

    .student-sidebar .nav-link.active i {
        color: var(--student-bg);
    }

    /* Menu Divider */
    .menu-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.15);
        margin: 0 10px;
    }

    /* Logout Button Spesifik */
    .logout-btn {
        color: #ff9999 !important;
        /* Merah muda lembut agar tidak terlalu kontras gelap */
    }

    .logout-btn:hover {
        background: rgba(255, 82, 82, 0.1) !important;
        color: #ff5252 !important;
    }

    /* Responsif */
    @media (max-width: 768px) {
        #sidebar.student-sidebar {
            margin-left: -280px;
        }

        #sidebar.student-sidebar.toggled {
            margin-left: 0;
        }
    }
</style>