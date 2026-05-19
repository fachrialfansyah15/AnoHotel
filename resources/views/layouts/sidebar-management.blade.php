<aside class="management-sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">
            <i class="fas fa-hotel"></i>
        </div>

        <div>
            <div class="logo-name">AnoHotel</div>
            <div class="logo-sub">Luxury &amp; Comfort</div>
        </div>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-label">Main Console</div>

    <nav class="sidebar-nav">
        <a href="/dashboard" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            Dashboard
        </a>

        <a href="/rooms" class="sidebar-link {{ request()->is('rooms*') ? 'active' : '' }}">
            <i class="fas fa-door-open"></i>
            Rooms
        </a>

        <a href="/reservations" class="sidebar-link {{ request()->is('reservations*') ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i>
            Reservations
        </a>

        <a href="/payments" class="sidebar-link {{ request()->is('payments*') ? 'active' : '' }}">
            <i class="fas fa-credit-card"></i>
            Payments
        </a>

        @if(auth()->user()->role === 'admin')
            <a href="/users" class="sidebar-link {{ request()->is('users*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                Users
            </a>
        @endif

        <a href="/reports" class="sidebar-link {{ request()->is('reports*') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i>
            Reports
        </a>

        <a href="{{ route('ai.chat') }}" class="sidebar-link {{ request()->is('ai/*') ? 'active' : '' }}">
            <i class="fas fa-robot"></i>
            AI Concierge
        </a>
    </nav>

    <div class="sidebar-spacer"></div>

    <a href="/logout"
       class="sidebar-logout"
       onclick="event.preventDefault(); document.getElementById('logout-form-management').submit();">
        <i class="fas fa-arrow-right-from-bracket"></i>
        Logout
    </a>

    <form id="logout-form-management" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</aside>