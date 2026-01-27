<div id="sidebar" class="sidebar-guru">
    <div class="sidebar-header text-center">
        <h5 class="fw-bold mb-0 text-white" style="font-family: 'Domine', serif; letter-spacing: 1px;">
            SAPAI <span style="font-weight: 400;">GURU</span>
        </h5>
    </div>

    <div class="sidebar-content mt-3">
        <a href="{{ route('guru.dashboard') }}" class="nav-link-guru {{ Request::is('guru/dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> <span>Dashboard</span>
        </a>

        <div class="section-divider">Manajemen Kelas</div>

        <a href="#" class="nav-link-guru">
            <i class="fas fa-book-open"></i> <span>Materi Belajar</span>
        </a>
        <a href="#" class="nav-link-guru">
            <i class="fas fa-user-graduate"></i> <span>Daftar Siswa</span>
        </a>
        <a href="#" class="nav-link-guru">
            <i class="fas fa-chart-bar"></i> <span>Progres Belajar</span>
        </a>

        <div class="section-divider">Interaksi</div>

        <a href="#" class="nav-link-guru">
            <i class="fas fa-comment-alt-dots"></i> <span>Diskusi Siswa</span>
        </a>
        <a href="#" class="nav-link-guru">
            <i class="fas fa-file-signature"></i> <span>Feedback & Nilai</span>
        </a>
    </div>
</div>

<style>
    .sidebar-guru {
        width: 280px;
        min-height: 100vh;
        background: linear-gradient(135deg, #0d9488 0%, #10b981 100%);
        color: white;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
        font-family: 'Fredoka', sans-serif;
    }

    .sidebar-header {
        padding: 30px 20px;
        background: rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .nav-link-guru {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        margin: 5px 15px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        border-radius: 12px;
        transition: 0.3s;
    }

    .nav-link-guru i {
        width: 30px;
        font-size: 1.2rem;
        /* Memastikan ikon terlihat */
    }

    .nav-link-guru:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .nav-link-guru.active {
        background: white;
        color: #0d9488 !important;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .section-divider {
        padding: 20px 30px 10px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: rgba(255, 255, 255, 0.6);
        font-weight: 700;
    }
</style>