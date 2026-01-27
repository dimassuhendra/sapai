<div id="sidebar-wrapper">
    <div class="sidebar-heading">
        <div class="logo-box">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <span>SAPAI ADMIN</span>
    </div>

    <div class="list-group list-group-flush mt-3 px-3">
        <a href="{{ route('admin.dashboard') }}"
            class="list-group-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <div class="menu-label">Akademik</div>

        <a href="{{ route('programs.index') }}"
            class="list-group-item {{ request()->is('admin/programs*') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Program Belajar
        </a>

        <a href="{{ route('materials.index') }}"
            class="list-group-item {{ request()->is('admin/admin/materials*') || request()->is('admin/materials*') ? 'active' : '' }}">
            <i class="fas fa-file-video"></i> Materi
        </a>

        <a href="{{ route('enrollments.index') }}"
            class="list-group-item {{ request()->is('admin/enrollments*') ? 'active' : '' }}">
            <i class="fas fa-user-plus"></i> Data Siswa
        </a>

        <div class="menu-label">Konten</div>

        <a href="{{ route('galleries.index') }}"
            class="list-group-item {{ request()->is('admin/galleries*') ? 'active' : '' }}">
            <i class="fas fa-images"></i> Galeri
        </a>

        <a href="{{ route('admin.testimoni.index') }}"
            class="list-group-item {{ request()->is('admin/testimoni*') ? 'active' : '' }}">
            <i class="fas fa-comment-dots"></i> Testimoni
        </a>

        <div class="sidebar-footer mt-auto mb-4">
            <a href="{{ route('home') }}" class="list-group-item external-link">
                <i class="fas fa-external-link-alt"></i> Lihat Website
            </a>
        </div>
    </div>
</div>

<style>
    :root {
        --sidebar-bg: #2193b0;
        --sidebar-hover: rgba(255, 255, 255, 0.15);
        --sidebar-active: #ffffff;
        --sidebar-text: rgba(255, 255, 255, 0.8);
    }

    #sidebar-wrapper {
        min-height: 100vh;
        width: 280px;
        background: var(--sidebar-bg);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
    }

    /* Heading Logo */
    .sidebar-heading {
        padding: 30px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: white;
        font-weight: 800;
        letter-spacing: 1px;
        font-size: 1.1rem;
    }

    .logo-box {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 10px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Menu Label */
    .menu-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.5);
        padding: 20px 15px 10px 15px;
        letter-spacing: 1.5px;
    }

    /* List Group Items */
    #sidebar-wrapper .list-group-item {
        background: transparent;
        color: var(--sidebar-text);
        border: none;
        border-radius: 12px !important;
        padding: 12px 18px;
        margin-bottom: 5px;
        font-weight: 500;
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    #sidebar-wrapper .list-group-item i {
        width: 25px;
        font-size: 1.1rem;
        margin-right: 10px;
        transition: 0.3s;
    }

    /* Hover State */
    #sidebar-wrapper .list-group-item:hover {
        background: var(--sidebar-hover);
        color: #ffffff;
        transform: translateX(5px);
    }

    /* Active State */
    #sidebar-wrapper .list-group-item.active {
        background: #ffffff !important;
        color: var(--sidebar-bg) !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        font-weight: 700;
    }

    #sidebar-wrapper .list-group-item.active i {
        color: var(--sidebar-bg);
    }

    /* Special Link: Lihat Website */
    .external-link {
        color: #ffde59 !important;
        /* Kuning cerah agar kontras */
        border: 1px dashed rgba(255, 255, 255, 0.3) !important;
        margin-top: 20px;
    }

    .external-link:hover {
        background: #ffde59 !important;
        color: #2193b0 !important;
    }

    /* Responsive Handling */
    @media (max-width: 768px) {
        #sidebar-wrapper {
            margin-left: -280px;
            /* Sembunyikan sidebar di HP secara default */
            position: fixed;
            z-index: 1000;
        }

        #sidebar-wrapper.toggled {
            margin-left: 0;
        }
    }
</style>