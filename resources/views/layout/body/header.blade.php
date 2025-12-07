<!-- Header -->
<header class="header">
    <div class="header-left">
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
        <a href="#" class="logo">
            <i class="fas fa-chart-line"></i>
            <span class="logo-text ms-2">Pangkalan LPG</span>
        </a>
    </div>
    <div class="header-right">
        <div class="dropdown">
            <button class="btn btn-link text-secondary dropdown-toggle d-flex align-items-center" type="button"
                data-bs-toggle="dropdown">
                <i class="fas fa-user-circle fa-2x me-2"></i>
                <div class="text-start d-none d-md-block">
                    <div class="fw-semibold">{{ auth()->user()->username }}</div>
                    <small class="text-muted">{{ auth()->user()->role ?? 'User' }}</small>
                </div>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                {{-- <li>
                    <a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a>
                </li> --}}
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>

                </li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
            </ul>
        </div>
    </div>
</header>
