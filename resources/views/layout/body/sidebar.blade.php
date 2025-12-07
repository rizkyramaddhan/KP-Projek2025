<!-- Sidebar -->
<aside class="sidebar collapsed" id="sidebar">
    <ul class="sidebar-menu">
        <li>
            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="/pengguna" class="{{ request()->is('pengguna*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Pengguna</span>
            </a>
        </li>

        <li>
            <a href="/gas" class="{{ request()->is('gas*') ? 'active' : '' }}">
                <i class="fas fa-box"></i>
                <span>Produk</span>
            </a>
        </li>

        <li>
            <a href="#" class="{{ request()->is('transaksi*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <li>
            <a href="#" class="{{ request()->is('laporan*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>
        </li>

        <li>
            <a href="/logActivity" class="{{ request()->is('logActivity*') ? 'active' : '' }}">
                <i class="fas fa-clock"></i>
                <span>Log Activity</span>
            </a>
        </li>

        <div class="menu-divider"></div>

        <li>
            <a href="/pengaturan" class="{{ request()->is('pengaturan*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </li>

        <li>
            <a href="#" class="{{ request()->is('bantuan*') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i>
                <span>Bantuan</span>
            </a>
        </li>
    </ul>
</aside>
