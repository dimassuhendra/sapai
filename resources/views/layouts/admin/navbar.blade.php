<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-light border" id="menu-toggle"><i class="fas fa-bars"></i></button>
        
        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/user.png') }}" width="30" height="30" class="rounded-circle me-2">
                    {{ auth()->user()->nama_lengkap ?? 'Admin' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>