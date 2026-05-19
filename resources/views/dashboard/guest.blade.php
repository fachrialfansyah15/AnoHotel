@include('layouts.sidebar-guest')

{{-- resources/views/dashboard/guest.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Dashboard - AnoHotel Luxury</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --gold-dark: #aa8625;
            --gold-dim: rgba(212, 175, 55, 0.08);
            --gold-border: rgba(212, 175, 55, 0.15);

            --bg-gradient: linear-gradient(135deg, #041026 0%, #08172f 50%, #0d2347 100%);
            --sidebar-bg: #030d20;
            --surface: rgba(255, 255, 255, 0.03);
            --surface-hover: rgba(255, 255, 255, 0.06);
            --border-light: rgba(255, 255, 255, 0.08);

            --text-primary: #ffffff;
            --text-secondary: #90a0b7;
            --text-muted: #536685;
            --success: #10b981;

            --r-sm: 8px;
            --r-md: 12px;
            --r-lg: 20px;
        }

        /* PERBAIKAN: Melekatkan gradasi di element HTML agar tidak putus saat di-scroll */
        html {
            background: var(--bg-gradient);
            background-attachment: fixed;
            min-height: 100%;
        }

        body {
            color: var(--text-primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            min-height: 100vh;
            letter-spacing: 0.02em;
            background: transparent; /* Diubah menjadi transparan karena background sudah diatur di HTML */
        }

        /* ── SIDEBAR (Sesuai Layout Dashboard Utama) ── */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--gold-border);
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.2);
        }

        .logo-text .logo-name {
            font-family: 'Cinzel', serif;
            font-size: 1.2rem; font-weight: 700;
            color: var(--gold);
            line-height: 1;
        }

        .logo-text .logo-sub {
            font-size: 0.65rem;
            color: var(--text-muted);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 2px;
        }

        .nav-divider {
            height: 1px;
            background: var(--gold-border);
            opacity: 0.5;
            margin: 1rem 0.75rem;
        }

        .nav-section-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--gold);
            opacity: 0.7;
            padding: 0 0.75rem;
            margin: 1.5rem 0 0.5rem;
            font-weight: 700;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 0.85rem;
            border-radius: var(--r-sm);
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 0.88rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }

        .nav-link .nav-icon { width: 18px; text-align: center; font-size: 0.9rem; color: var(--text-muted); }

        .nav-link:hover {
            background: var(--surface-hover);
            color: #fff;
            border-color: rgba(255,255,255,0.05);
        }
        .nav-link:hover .nav-icon { color: var(--gold); }

        .nav-link.active {
            background: var(--gold-dim);
            color: var(--gold-light);
            font-weight: 600;
            border-color: var(--gold-border);
        }
        .nav-link.active .nav-icon { color: var(--gold); }

        .nav-spacer { flex: 1; }

        .nav-logout {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.5rem;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-logout:hover { color: #ff6b6b; }

        /* ── MAIN CONTENT AREA ── */
        .main {
    margin-left: 260px;
    flex: 1;
    padding: 2rem 2rem 2rem 1.5rem;
    min-height: 100vh;
}

        /* Pembungkus agar konten terpusat dengan max-width yang rapi dan seimbang */
       .dashboard-container {
    width: 100%;
    max-width: 1400px;
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

        /* ── TOPBAR ── */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 1.5rem;
        }

        .topbar-left h1 {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem; font-weight: 600;
            color: #fff;
        }

        .topbar-left p {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin-top: 0.3rem;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notif-btn {
            position: relative;
            width: 42px; height: 42px;
            border-radius: var(--r-sm);
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-light);
            display: grid; place-items: center;
            cursor: pointer; font-size: 1rem;
            color: var(--gold);
            transition: all 0.2s;
        }
        .notif-btn:hover { border-color: var(--gold); background: var(--surface-hover); }

        .notif-badge {
            position: absolute;
            top: -4px; right: -4px;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: #041026;
            font-size: 9px; font-weight: 700;
            width: 16px; height: 16px;
            border-radius: 50%;
            display: grid; place-items: center;
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-light);
            padding: 0.5rem 1rem;
            border-radius: var(--r-sm);
            font-size: 0.85rem;
        }

        .role-badge {
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            color: var(--gold-light);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
        }

        /* ── HERO BANNER ── */
        .hero {
            position: relative;
            border-radius: var(--r-lg);
            overflow: hidden;
            min-height: 380px;
            display: flex;
            justify-content: space-between;
            border: 1px solid var(--gold-border);
            background: #030d20;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .hero-bg {
            position: absolute; inset: 0;
            background-image: url('{{ asset('images/Dashboard.png') }}');
            background-size: cover;
            background-position: center;
        }

        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(105deg,
                rgba(4,16,38,0.95) 0%,
                rgba(4,16,38,0.80) 50%,
                rgba(4,16,38,0.30) 100%);
        }

        .hero-body {
            position: relative;
            z-index: 2;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }

        .hero-eyebrow {
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold-light);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }
        .hero-eyebrow::after {
            content: '';
            display: inline-block;
            width: 40px; height: 1px;
            background: var(--gold);
        }

        .hero h2 {
            font-family: 'Cinzel', serif;
            font-size: 2.2rem; font-weight: 600;
            line-height: 1.2;
            margin-bottom: 1rem;
            color: #fff;
        }

        .hero p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.6;
            max-width: 400px;
            margin-bottom: 2rem;
        }

        .hero-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: #041026;
            padding: 0.65rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15);
            transition: all 0.2s;
        }
        .btn-gold:hover { opacity: 0.95; transform: translateY(-1px); }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-light);
            color: var(--text-secondary);
            padding: 0.65rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
        }
        .btn-outline:hover { border-color: var(--gold); color: #fff; background: var(--surface); }

        /* Floating Panel Kanan Dalam Banner */
        .hero-side {
            position: relative;
            z-index: 2;
            width: 320px;
            flex-shrink: 0;
            padding: 2rem 2.5rem 2rem 0;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            justify-content: center;
        }

        .hero-card {
            background: rgba(3, 13, 32, 0.85);
            border: 1px solid var(--gold-border);
            border-radius: var(--r-md);
            padding: 1.25rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .hc-label {
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .hc-title { font-size: 1rem; font-weight: 600; color: #fff; margin-bottom: 2px; }
        .hc-sub { font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 1rem; }

        .hc-dates {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 1rem;
            border-top: 1px solid rgba(255,255,255,0.05);
            padding-top: 0.75rem;
        }

        .hc-date-item .hcd-label { font-size: 0.65rem; color: var(--text-muted); margin-bottom: 2px; }
        .hc-date-item .hcd-val { font-size: 0.8rem; font-weight: 600; color: var(--gold-light); }
        .hc-date-item .hcd-time { font-size: 0.7rem; color: var(--text-secondary); }

        .hc-link {
            display: flex; align-items: center; justify-content: space-between;
            color: var(--gold); font-size: 0.8rem; font-weight: 600; text-decoration: none;
            transition: color 0.2s;
        }
        .hc-link:hover { color: var(--gold-light); }

        .status-dot {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.75rem; color: var(--success); font-weight: 600;
        }
        .status-dot::before {
            content: ''; width: 6px; height: 6px; border-radius: 50%;
            background: var(--success); box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        /* ── STAT CARDS GRID ── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            width: 100%;
        }

        .stat-card {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-md);
            padding: 1.5rem;
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.3s ease;
            display: flex; flex-direction: column;
        }

        .stat-card:hover {
            border-color: var(--gold);
            background: var(--surface-hover);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }

        .sc-top {
            display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;
        }

        .sc-icon-wrap {
            width: 42px; height: 42px;
            border-radius: 8px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-light);
            display: grid; place-items: center;
            font-size: 1.1rem; color: var(--gold);
        }

        .sc-arrow { color: var(--text-muted); font-size: 1.1rem; transition: transform 0.2s; }
        .stat-card:hover .sc-arrow { color: var(--gold); transform: translateX(3px); }

        .sc-val {
            font-family: 'Cinzel', serif;
            font-size: 2.2rem; font-weight: 700;
            line-height: 1; margin-bottom: 0.3rem;
            color: #fff;
        }

        .sc-label { color: var(--text-secondary); font-size: 0.75rem; font-weight: 500; }

        .sc-footer {
            display: flex; align-items: center; gap: 6px;
            margin-top: 1rem; padding-top: 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.04);
            color: var(--gold-light); font-size: 0.75rem; font-weight: 500;
        }

        /* ── BOTTOM GRID LAYOUT ── */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 1.25rem;
            width: 100%;
        }

        /* Services Panel Card */
        .services-card {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-lg);
            padding: 1.75rem;
        }

        .card-header {
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-family: 'Cinzel', serif;
            font-size: 1.25rem; color: #fff; font-weight: 600;
        }

        .card-sub { color: var(--text-secondary); font-size: 0.75rem; margin-top: 0.2rem; }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.85rem;
        }

        .svc-btn {
            display: flex; flex-direction: column; align-items: center;
            gap: 0.75rem; padding: 1.5rem 1rem;
            border-radius: var(--r-md);
            background: rgba(0,0,0,0.15);
            border: 1px solid var(--border-light);
            text-decoration: none; color: var(--text-secondary);
            transition: all 0.2s; cursor: pointer;
        }

        .svc-btn:hover {
            border-color: var(--gold);
            background: var(--gold-dim);
            color: #fff;
            transform: scale(1.02);
        }

        .svc-icon { font-size: 1.5rem; color: var(--gold); }
        .svc-label { font-size: 0.8rem; font-weight: 500; text-align: center; }

        /* Information Stack Panel Card */
        .info-stack { display: flex; flex-direction: column; gap: 1.25rem; }

        .info-card {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-lg);
            padding: 1.5rem;
        }

        .info-title {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem; color: #fff; font-weight: 600;
            margin-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 0.5rem;
        }

        .info-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 0.75rem 0; border-bottom: 1px solid rgba(255,255,255,0.04);
            font-size: 0.85rem; color: var(--text-secondary);
        }

        .info-row:last-child { border-bottom: none; }
        .info-row-label { display: flex; align-items: center; gap: 8px; }
        .info-row-val { font-weight: 600; color: #fff; }

        .avail-badge {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
            font-size: 0.7rem; font-weight: 700;
            text-transform: uppercase; padding: 2px 8px; border-radius: 4px;
        }

        /* RESPONSIVE LAYOUT BREAKPOINTS */
        @media (max-width: 1200px) {
            .cards-grid { grid-template-columns: repeat(2, 1fr); }
            .bottom-grid { grid-template-columns: 1fr; }
            .hero { flex-direction: column; min-height: auto; }
            .hero-side { width: 100%; padding: 0 2.5rem 2.5rem 2.5rem; }
        }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 1.5rem; }
            .topbar { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .cards-grid { grid-template-columns: 1fr; }
            .services-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>

<body>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar">
    <div class="logo-wrap">
        <div class="logo-icon"><i class="fas fa-hotel text-[#041026] text-xs"></i></div>
        <div class="logo-text">
            <div class="logo-name">AnoHotel</div>
            <div class="logo-sub">Luxury &amp; Comfort</div>
        </div>
    </div>

    <div class="nav-divider"></div>
    <div class="nav-section-label">Main Console</div>

    <a href="/dashboard" class="nav-link active">
        <span class="nav-icon"><i class="fas fa-chart-line"></i></span> Dashboard
    </a>
    <a href="/rooms" class="nav-link">
        <span class="nav-icon"><i class="fas fa-door-open"></i></span> Rooms
    </a>
    <a href="/my-reservations" class="nav-link">
        <span class="nav-icon"><i class="fas fa-calendar-check"></i></span> My Reservations
    </a>
    <a href="/my-payments" class="nav-link">
        <span class="nav-icon"><i class="fas fa-credit-card"></i></span> My Payments
    </a>

    <div class="nav-divider"></div>
    <div class="nav-section-label">Support Services</div>

    <a href="#" class="nav-link">
        <span class="nav-icon"><i class="fas fa-concierge-bell"></i></span> Services
    </a>
    <a href="#" class="nav-link">
        <span class="nav-icon"><i class="fas fa-comments"></i></span> Messages
    </a>
    <a href="#" class="nav-link">
        <span class="nav-icon"><i class="fas fa-user"></i></span> Profile
    </a>

    <div class="nav-spacer"></div>

    <a href="/logout" class="nav-logout"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="nav-icon"><i class="fas fa-arrow-right-from-bracket"></i></span> Sign Out
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</aside>

{{-- ── MAIN CONTENT AREA ── --}}
<main class="main">
    <div class="dashboard-container">

        {{-- TOPBAR --}}
        <div class="topbar">
            <div class="topbar-left">
                <h1>Welcome, {{ auth()->user()->name }} 👋</h1>
                <p>Enjoy your stay and let us take care of the rest.</p>
            </div>

            <div class="topbar-right">
                <div class="notif-btn" title="Notifications">
                    <i class="fas fa-bell"></i>
                    <div class="notif-badge">3</div>
                </div>

                <div class="user-pill">
                    <div class="w-6 h-6 rounded-full bg-[#d4af37]/10 border border-[#d4af37]/30 flex items-center justify-center mr-1">
                        <i class="fas fa-user text-[#d4af37] text-[10px]"></i>
                    </div>
                    <span class="user-name font-semibold text-white mr-1">{{ auth()->user()->name }}</span>
                </div>

                <div class="role-badge">Guest</div>
            </div>
        </div>

        {{-- HERO BANNER --}}
        <div class="hero">
            <div class="hero-bg"></div>
            <div class="hero-overlay"></div>

            <div class="hero-body">
                <div class="hero-eyebrow">Good Evening</div>
                <h2>Have a comfortable<br>and pleasant stay!</h2>
                <p>Need something? Our professional staff is ready to assist you 24/7.</p>
                <div class="hero-actions">
                    <a href="#" class="btn-gold"><i class="fas fa-concierge-bell"></i> Contact Concierge</a>
                    <a href="/my-reservations" class="btn-outline"><i class="fas fa-calendar"></i> My Reservations</a>
                </div>
            </div>

            {{-- Floating Cards Kanan --}}
            <div class="hero-side">
                <div class="hero-card">
                    <div class="hc-label">Next Reservation</div>
                    <div class="hc-title">Deluxe Room</div>
                    <div class="hc-sub">2 Nights &middot; 2 Guests</div>
                    <div class="hc-dates">
                        <div class="hc-date-item">
                            <div class="hcd-label">Check-in</div>
                            <div class="hcd-val">May 31, 2026</div>
                            <div class="hcd-time">15:00</div>
                        </div>
                        <div class="hc-date-item">
                            <div class="hcd-label">Check-out</div>
                            <div class="hcd-val">Jun 02, 2026</div>
                            <div class="hcd-time">12:00</div>
                        </div>
                    </div>
                    <a href="/my-reservations" class="hc-link">
                        View Reservation <span><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="hero-card">
                    <div class="flex justify-between items-center mb-3">
                        <div class="hc-label mb-0">Room Status</div>
                        <div class="status-dot">Staying Now</div>
                    </div>
                    <div class="hc-title">Deluxe Room</div>
                    <div class="font-luxury text-3xl font-bold text-white my-1">1208</div>
                    <a href="#" class="hc-link">View Room Details <span><i class="fas fa-arrow-right"></i></span></a>
                </div>
            </div>
        </div>

        {{-- STAT CARDS ──}}
        <div class="cards-grid">
            <a href="/my-reservations" class="stat-card">
                <div class="sc-top">
                    <div class="sc-icon-wrap"><i class="fas fa-calendar-alt"></i></div>
                    <span class="sc-arrow"><i class="fas fa-arrow-right"></i></span>
                </div>
                <div class="sc-val">{{ $myReservations }}</div>
                <div class="sc-label">My Reservations</div>
                <div class="sc-footer">Upcoming Stay</div>
            </a>

            <a href="/my-payments" class="stat-card">
                <div class="sc-top">
                    <div class="sc-icon-wrap"><i class="fas fa-credit-card"></i></div>
                    <span class="sc-arrow"><i class="fas fa-arrow-right"></i></span>
                </div>
                <div class="sc-val">{{ $myPayments }}</div>
                <div class="sc-label">My Payments</div>
                <div class="sc-footer">Payment History</div>
            </a>

            <a href="#" class="stat-card">
                <div class="sc-top">
                    <div class="sc-icon-wrap"><i class="fas fa-envelope"></i></div>
                    <span class="sc-arrow"><i class="fas fa-arrow-right"></i></span>
                </div>
                <div class="sc-val">2</div>
                <div class="sc-label">Messages</div>
                <div class="sc-footer">Unread Messages</div>
            </a>

            <a href="/rooms" class="stat-card">
                <div class="sc-top">
                    <div class="sc-icon-wrap"><i class="fas fa-star"></i></div>
                    <span class="sc-arrow"><i class="fas fa-arrow-right"></i></span>
                </div>
                <div class="sc-val">{{ $availableRooms }}</div>
                <div class="sc-label">Available Rooms</div>
                <div class="sc-footer">Browse Rooms</div>
            </a>
        </div>

        {{-- BOTTOM GRID SECTION --}}
        <div class="bottom-grid">
            {{-- Hotel Services --}}
            <div class="services-card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Hotel Services</div>
                        <div class="card-sub">Enhance your stay with our premium services</div>
                    </div>
                </div>

                <div class="services-grid">
                    <a href="#" class="svc-btn">
                        <span class="svc-icon"><i class="fas fa-utensils"></i></span>
                        <span class="svc-label">Room Service</span>
                    </a>
                    <a href="#" class="svc-btn">
                        <span class="svc-icon"><i class="fas fa-broom"></i></span>
                        <span class="svc-label">Housekeeping</span>
                    </a>
                    <a href="#" class="svc-btn">
                        <span class="svc-icon"><i class="fas fa-shirt"></i></span>
                        <span class="svc-label">Laundry</span>
                    </a>
                    <a href="#" class="svc-btn">
                        <span class="svc-icon"><i class="fas fa-spa"></i></span>
                        <span class="svc-label">Spa &amp; Wellness</span>
                    </a>
                    <a href="#" class="svc-btn">
                        <span class="svc-icon"><i class="fas fa-car"></i></span>
                        <span class="svc-label">Transport</span>
                    </a>
                    <a href="#" class="svc-btn">
                        <span class="svc-icon"><i class="fas fa-ellipsis-h"></i></span>
                        <span class="svc-label">More Services</span>
                    </a>
                </div>
            </div>

            {{-- Hotel Info Stack --}}
            <div class="info-stack">
                <div class="info-card">
                    <div class="info-title">Hotel Information</div>
                    <div class="info-row">
                        <span class="info-row-label"><i class="fas fa-clock mr-2 text-[#d4af37]"></i> Check-in Time</span>
                        <span class="info-row-val">15:00</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label"><i class="fas fa-history mr-2 text-[#d4af37]"></i> Check-out Time</span>
                        <span class="info-row-val">12:00</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label"><i class="fas fa-wifi mr-2 text-[#d4af37]"></i> Wi-Fi SSID</span>
                        <span class="info-row-val">AnoHotel_Guest</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label"><i class="fas fa-phone mr-2 text-[#d4af37]"></i> Support</span>
                        <span class="info-row-val">+62 21 1234 5678</span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-title">Availability</div>
                    <div class="info-row">
                        <span class="info-row-label"><i class="fas fa-utensils mr-2 text-[#d4af37]"></i> Room Service</span>
                        <span class="avail-badge">Available</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label"><i class="fas fa-shirt mr-2 text-[#d4af37]"></i> Laundry</span>
                        <span class="avail-badge">Available</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label"><i class="fas fa-spa mr-2 text-[#d4af37]"></i> Spa</span>
                        <span class="avail-badge">Available</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

</body>
</html>