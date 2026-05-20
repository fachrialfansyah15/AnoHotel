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

    {{-- NAVIGATION --}}
    <nav class="sidebar-nav">

        {{-- DASHBOARD --}}
        <a href="/dashboard"
           class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">

            <i class="fas fa-chart-line"></i>

            Dashboard

        </a>

        {{-- ROOMS --}}
        <a href="/rooms"
           class="sidebar-link {{ request()->is('rooms*') ? 'active' : '' }}">

            <i class="fas fa-door-open"></i>

            Rooms

        </a>

        {{-- RESERVATIONS --}}
        <a href="/my-reservations"
           class="sidebar-link {{ request()->is('my-reservations*') ? 'active' : '' }}">

            <i class="fas fa-calendar-check"></i>

            My Reservations

        </a>

        {{-- PAYMENTS --}}
        <a href="/my-payments"
           class="sidebar-link {{ request()->is('my-payments*') ? 'active' : '' }}">

            <i class="fas fa-credit-card"></i>

            My Payments

        </a>

        {{-- AI CONCIERGE --}}
        <a href="{{ route('ai.tamu.index') }}"
           class="sidebar-link {{ request()->is('ai/*') ? 'active' : '' }}">

            <i class="fas fa-robot"></i>

            AI Concierge

        </a>

    </nav>

    <div class="nav-divider"></div>

    {{-- LOGOUT --}}
    <div class="sidebar-bottom">

        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button type="submit"
                    class="logout-btn">

                <i class="fas fa-arrow-right-from-bracket"></i>

                Sign Out

            </button>

        </form>

    </div>

</aside>

<style>

.sidebar{
    width:260px;

    background:#030d20;

    border-right:
    1px solid rgba(255,255,255,.08);

    position:fixed;

    top:0;
    left:0;

    height:100vh;

    padding:28px 18px;

    display:flex;
    flex-direction:column;

    z-index:100;
}

/* LOGO */

.logo-wrap{
    display:flex;
    align-items:center;
    gap:14px;

    margin-bottom:26px;
}

.logo-icon{
    width:48px;
    height:48px;

    border-radius:14px;

    background:
    linear-gradient(
        135deg,
        #c99a2e,
        #d4af37
    );

    display:flex;
    align-items:center;
    justify-content:center;

    color:#041026;

    font-size:18px;

    box-shadow:
    0 10px 25px rgba(212,175,55,.18);
}

.logo-text h2{
    color:#d4af37;

    font-size:31px;
    font-weight:700;

    margin-bottom:2px;
}

.logo-text p{
    color:#8ea3c0;

    font-size:12px;

    letter-spacing:2px;

    text-transform:uppercase;
}

/* DIVIDER */

.nav-divider{
    height:1px;

    background:
    rgba(255,255,255,.06);

    margin:24px 0;
}

/* LABEL */

.nav-label{
    color:#d4af37;

    font-size:11px;

    letter-spacing:3px;

    text-transform:uppercase;

    opacity:.85;

    margin-bottom:14px;

    padding-left:10px;
}

/* NAV */

.sidebar-nav{
    display:flex;
    flex-direction:column;
    gap:8px;
}

.sidebar-link{
    display:flex;
    align-items:center;
    gap:14px;

    padding:14px 16px;

    border-radius:14px;

    color:#c7d2e3;

    text-decoration:none;

    font-size:15px;
    font-weight:500;

    transition:.25s;
}

.sidebar-link i{
    width:18px;
    text-align:center;
}

/* HOVER */

.sidebar-link:hover{

    background:
    rgba(255,255,255,.05);

    color:white;

    transform:translateX(3px);
}

/* ACTIVE */

.sidebar-link.active{

    background:
    linear-gradient(
        90deg,
        rgba(212,175,55,.18),
        rgba(212,175,55,.04)
    );

    border:
    1px solid rgba(212,175,55,.18);

    color:#f3e5ab;

    box-shadow:
    inset 0 0 20px rgba(212,175,55,.04);
}

.sidebar-link.active i{
    color:#d4af37;
}

/* BOTTOM */

.sidebar-bottom{
    margin-top:auto;
}

/* LOGOUT */

.logout-btn{
    width:100%;

    background:transparent;

    border:
    1px solid rgba(255,255,255,.08);

    color:#c7d2e3;

    padding:14px;

    border-radius:14px;

    cursor:pointer;

    transition:.25s;

    font-size:15px;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
}

.logout-btn:hover{

    background:
    rgba(255,255,255,.05);

    color:white;
}

/* MOBILE */

@media(max-width:768px){

    .sidebar{
        transform:translateX(-100%);
    }
}

</style>