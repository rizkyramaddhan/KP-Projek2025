<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="brand">
            <i class="bi bi-fire"></i>
            <span class="brand-text">Gas LPG Pro</span>
        </div>
    </div>

    <div class="sidebar-content">
        <ul class="sidebar-menu">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <!-- Inventory Gas -->
            <li class="menu-item {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
                <a href="{{ route('gas.index') }}">
                    <i class="bi bi-box-seam"></i>
                    <span class="menu-text">Inventory Gas</span>
                </a>
            </li>

            @if (auth()->user()->role === 'administrator')
                <!-- Log Activity (Admin Only) -->
                <li class="menu-item {{ request()->routeIs('log-activity.*') ? 'active' : '' }}">
                    <a href="{{ route('logactivity.index') }}">
                        <i class="bi bi-clock-history"></i>
                        <span class="menu-text">Log Activity</span>
                    </a>
                </li>

                <!-- Management Akun (Admin Only) -->
                <li class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="">
                        <i class="bi bi-people"></i>
                        <span class="menu-text">Manajemen Akun</span>
                    </a>
                </li>

                <!-- Setting (Admin Only) -->
                <li class="menu-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <a href="">
                        <i class="bi bi-gear"></i>
                        <span class="menu-text">Setting</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <div class="sidebar-footer">
        <div class="user-info">
            <i class="bi bi-person-circle"></i>
            <div class="user-details">
                <span class="user-name">{{ auth()->user()->name }}</span>
                <span class="user-role">{{ ucfirst(auth()->user()->role) }}</span>
            </div>
        </div>
    </div>
</div>
