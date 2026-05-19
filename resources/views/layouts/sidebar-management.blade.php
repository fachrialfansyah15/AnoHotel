<aside class="sidebar">

    {{-- LOGO --}}
    <div class="logo-wrap">

        <div class="logo-icon">
            <i class="fas fa-hotel"></i>
        </div>

        <div class="logo-text">
            <h2>AnoHotel</h2>
            <p>Luxury & Comfort</p>
        </div>

    </div>

    <div class="nav-divider"></div>

    {{-- LABEL --}}
    <div class="nav-label">
        Main Console
    </div>

    {{-- MENU --}}
    <nav class="sidebar-nav">

        <a href="/dashboard"
           class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">

            <i class="fas fa-chart-line"></i>
            Dashboard

        </a>

        <a href="/rooms"
           class="sidebar-link {{ request()->is('rooms*') ? 'active' : '' }}">

            <i class="fas fa-door-open"></i>
            Rooms

        </a>

        <a href="/reservations"
           class="sidebar-link {{ request()->is('reservations*') ? 'active' : '' }}">

            <i class="fas fa-calendar-check"></i>
            Reservations

        </a>

        <a href="/payments"
           class="sidebar-link {{ request()->is('payments*') ? 'active' : '' }}">

            <i class="fas fa-credit-card"></i>
            Payments

        </a>

        <a href="/users"
           class="sidebar-link {{ request()->is('users*') ? 'active' : '' }}">

            <i class="fas fa-users"></i>
            Users

        </a>

        <a href="/reports"
           class="sidebar-link {{ request()->is('reports*') ? 'active' : '' }}">

            <i class="fas fa-chart-pie"></i>
            Reports

        </a>

        <a href="/ai/chat"
           class="sidebar-link {{ request()->is('ai/*') ? 'active' : '' }}">

            <i class="fas fa-robot"></i>
            AI Concierge

        </a>

    </nav>

    {{-- LOGOUT --}}
    <div class="sidebar-bottom">

        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button type="submit" class="logout-btn">

                <i class="fas fa-arrow-right-from-bracket"></i>

                Logout

            </button>

        </form>

    </div>

</aside>

<style>

.sidebar{
    position:fixed;
    left:0;
    top:0;

    width:260px;
    height:100vh;

    background:#030d20;

    border-right:1px solid rgba(255,255,255,.08);

    padding:28px 18px;

    display:flex;
    flex-direction:column;

    z-index:999;
}

/* LOGO */

.logo-wrap{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:26px;
}

.logo-icon{
    width:52px;
    height:52px;

    border-radius:16px;

    background:linear-gradient(
        135deg,
        #c99a2e,
        #d4af37
    );

    display:flex;
    align-items:center;
    justify-content:center;

    color:#041026;
    font-size:20px;
}

.logo-text h2{
    font-size:18px;
    font-weight:800;
    color:#d4af37;
    margin-bottom:2px;
}

.logo-text p{
    font-size:11px;
    color:#8ea3c0;
    letter-spacing:2px;
    text-transform:uppercase;
}

/* DIVIDER */

.nav-divider{
    height:1px;
    background:rgba(255,255,255,.06);
    margin:22px 0;
}

/* LABEL */

.nav-label{
    color:#d4af37;
    font-size:11px;
    letter-spacing:3px;
    text-transform:uppercase;
    margin-bottom:14px;
    padding-left:10px;
    opacity:.8;
}

/* NAV */

.sidebar-nav{
    display:flex;
    flex-direction:column;
    gap:8px;
}

/* LINK */

.sidebar-link{
    display:flex;
    align-items:center;
    gap:14px;

    padding:14px 16px;

    border-radius:16px;

    color:#c7d2e3;
    text-decoration:none;

    transition:.25s;

    font-size:15px;
    font-weight:600;
}

.sidebar-link i{
    width:18px;
    font-size:16px;
}

.sidebar-link:hover{
    background:rgba(255,255,255,.05);
    color:white;
}

.sidebar-link.active{

    background:
    linear-gradient(
        90deg,
        rgba(212,175,55,.18),
        rgba(212,175,55,.04)
    );

    border:1px solid rgba(212,175,55,.18);

    color:#f3e5ab;
}

/* BOTTOM */

.sidebar-bottom{
    margin-top:auto;
}

/* LOGOUT */

.logout-btn{
    width:100%;

    background:transparent;

    border:1px solid rgba(255,255,255,.08);

    color:#c7d2e3;

    padding:14px;

    border-radius:14px;

    cursor:pointer;

    transition:.25s;

    font-size:15px;
    font-weight:600;
}

.logout-btn:hover{
    background:rgba(255,255,255,.05);
}

/* RESPONSIVE */

@media(max-width:900px){

    .sidebar{
        transform:translateX(-100%);
    }

}

</style>