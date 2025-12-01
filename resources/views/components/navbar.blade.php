<nav class="navbar">
    <div class="navbar-content">
        <div class="navbar-left">
            <button class="btn-toggle-sidebar" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <span class="page-title">@yield('page-title', 'Dashboard')</span>
        </div>

        <div class="navbar-right">
            <!-- Notifications -->
            <div class="dropdown">
                <button class="btn-icon" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif">3</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <h6 class="dropdown-header">Notifikasi</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">
                            <i class="bi bi-box-seam text-primary"></i>
                            Stok Gas 3kg menipis
                        </a></li>
                    <li><a class="dropdown-item" href="#">
                            <i class="bi bi-exclamation-triangle text-warning"></i>
                            Peringatan: Gas 12kg <10 unit </a>
                    </li>
                    <li><a class="dropdown-item" href="#">
                            <i class="bi bi-check-circle text-success"></i>
                            Restok berhasil ditambahkan
                        </a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-center" href="#">Lihat Semua</a></li>
                </ul>
            </div>

            <!-- User Profile -->
            <div class="dropdown">
                <button class="btn-profile" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i>
                    <span class="user-name-nav">{{ auth()->user()->name }}</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="">
                            <i class="bi bi-person"></i> Profil
                        </a></li>
                    <li><a class="dropdown-item" href="">
                            <i class="bi bi-gear"></i> Pengaturan
                        </a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
