<div id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <i class="fas fa-graduation-cap me-2"></i>EDUBOT ADMIN
    </div>
    <div class="list-group list-group-flush mt-3">
        <a href="{{ route('admin.dashboard') }}" class="list-group-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        
        <div class="text-muted small fw-bold text-uppercase px-3 mt-4 mb-1">Akademik</div>
        <a href="{{ route('admin.programs') }}" class="list-group-item {{ request()->is('admin/programs*') ? 'active' : '' }}">
            <i class="fas fa-book me-2"></i> Program Belajar
        </a>
        <a href="{{ route('admin.materials') }}" class="list-group-item">
            <i class="fas fa-file-video me-2"></i> Materi
        </a>
        <a href="#" class="list-group-item"><i class="fas fa-user-plus me-2"></i> Pendaftaran</a>

        <div class="text-muted small fw-bold text-uppercase px-3 mt-4 mb-1">Konten</div>
        <a href="#" class="list-group-item"><i class="fas fa-images me-2"></i> Galeri</a>
        <a href="{{ route('admin.settings') }}" class="list-group-item">
            <i class="fas fa-cogs me-2"></i> Pengaturan Web
        </a>
        
        <a href="/" class="list-group-item mt-5 text-warning"><i class="fas fa-external-link-alt me-2"></i> Lihat Website</a>
    </div>
</div>