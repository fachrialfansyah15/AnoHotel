<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>

        /* ─── RESET & BASE ─── */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold:        #C9A84C;
            --gold-light:  #E8C97A;
            --gold-dim:    rgba(201,168,76,.12);
            --gold-border: rgba(201,168,76,.22);
            --bg:          #080C12;
            --surface:     #0F1520;
            --surface2:    #141C28;
            --border:      rgba(255,255,255,.06);
            --text:        #E4EAF2;
            --muted:       #6B7A90;
            --green:       #22C55E;
            --radius-sm:   12px;
            --radius-md:   18px;
            --radius-lg:   26px;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 28px 16px;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
            padding: 0 8px 24px;
            border-bottom: 1px solid var(--border);
        }

        .logo-icon {
            width: 42px; height: 42px;
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            border-radius: 10px;
            display: grid; place-items: center;
            font-size: 20px;
        }

        .logo-text { line-height: 1; }
        .logo-name  { font-family: 'Cormorant Garamond', serif; font-size: 18px; font-weight: 700; color: var(--gold-light); }
        .logo-sub   { font-size: 9px; letter-spacing: .15em; text-transform: uppercase; color: var(--muted); }

        .nav-section-label {
            font-size: 9px;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 20px 10px 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 11px;
            text-decoration: none;
            color: var(--muted);
            padding: 11px 12px;
            border-radius: var(--radius-sm);
            font-size: 13.5px;
            font-weight: 500;
            transition: .18s ease;
            margin-bottom: 2px;
        }

        .nav-link .icon { font-size: 16px; width: 20px; text-align: center; }

        .nav-link:hover  { background: var(--gold-dim); color: var(--gold-light); }
        .nav-link.active { background: var(--gold-dim); color: var(--gold-light); border-left: 2px solid var(--gold); padding-left: 10px; }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        .user-mini {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            transition: .18s;
            cursor: pointer;
        }
        .user-mini:hover { background: var(--gold-dim); }

        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            display: grid; place-items: center;
            font-size: 14px;
            font-weight: 700;
            color: #000;
            flex-shrink: 0;
        }

        .user-mini-info { flex: 1; overflow: hidden; }
        .user-mini-name { font-size: 13px; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-mini-role { font-size: 10px; color: var(--muted); }

        .logout-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            text-decoration: none;
            color: var(--muted);
            font-size: 13px;
            margin-top: 4px;
            transition: .18s;
        }
        .logout-link:hover { background: rgba(239,68,68,.1); color: #F87171; }

        /* ─── MAIN ─── */
        .main {
            flex: 1;
            margin-left: 240px;
            padding: 32px 36px;
            min-height: 100vh;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 36px;
        }

        .topbar-left h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 34px;
            font-weight: 600;
            color: var(--text);
        }

        .topbar-left p { font-size: 13px; color: var(--muted); margin-top: 4px; }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-date {
            font-size: 12px;
            color: var(--muted);
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 8px 14px;
            border-radius: 10px;
        }

        .notif-btn {
            position: relative;
            width: 40px; height: 40px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: grid; place-items: center;
            cursor: pointer;
            font-size: 18px;
            transition: .18s;
        }
        .notif-btn:hover { border-color: var(--gold-border); }

        .notif-badge {
            position: absolute;
            top: 6px; right: 6px;
            width: 8px; height: 8px;
            background: var(--gold);
            border-radius: 50%;
            border: 1.5px solid var(--bg);
        }

        .role-pill {
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            color: var(--gold-light);
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            letter-spacing: .04em;
        }

        /* ─── HERO BANNER ─── */
        .hero {
            border-radius: var(--radius-lg);
            padding: 40px 44px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            min-height: 160px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #0F1B0A 0%, #1A2E12 40%, #0D1A1F 100%);
            border: 1px solid rgba(201,168,76,.18);
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 80% at 80% 50%, rgba(201,168,76,.08) 0%, transparent 70%),
                radial-gradient(ellipse 30% 40% at 10% 80%, rgba(201,168,76,.05) 0%, transparent 60%);
        }

        .hero-content { position: relative; z-index: 1; }

        .hero-eyebrow {
            font-size: 11px;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 10px;
        }

        .hero h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 38px;
            font-weight: 600;
            line-height: 1.15;
            color: var(--text);
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 14px;
            color: var(--muted);
            max-width: 520px;
            line-height: 1.6;
        }

        .hero-badge {
            position: relative;
            z-index: 1;
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            border-radius: var(--radius-md);
            padding: 20px 28px;
            text-align: center;
            flex-shrink: 0;
        }

        .hero-badge .hb-icon { font-size: 28px; margin-bottom: 6px; }
        .hero-badge .hb-val  { font-family: 'Cormorant Garamond', serif; font-size: 30px; font-weight: 700; color: var(--gold-light); }
        .hero-badge .hb-lbl  { font-size: 11px; color: var(--muted); }

        /* ─── STAT CARDS ─── */
        .cards-grid {
            display: grid;
            gap: 20px;
            margin-bottom: 28px;
        }

        .cards-grid.cols-4 { grid-template-columns: repeat(4, 1fr); }
        .cards-grid.cols-3 { grid-template-columns: repeat(3, 1fr); }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px 26px;
            position: relative;
            overflow: hidden;
            transition: .2s ease;
        }
        .stat-card:hover { border-color: var(--gold-border); transform: translateY(-1px); }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), transparent);
            opacity: 0;
            transition: .2s;
        }
        .stat-card:hover::before { opacity: 1; }

        .sc-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
        .sc-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: grid; place-items: center;
            font-size: 18px;
        }

        .sc-icon.gold   { background: var(--gold-dim); }
        .sc-icon.green  { background: rgba(34,197,94,.1); }
        .sc-icon.blue   { background: rgba(59,130,246,.1); }
        .sc-icon.purple { background: rgba(168,85,247,.1); }

        .sc-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 6px;
            background: rgba(34,197,94,.12);
            color: var(--green);
        }

        .sc-val {
            font-family: 'Cormorant Garamond', serif;
            font-size: 42px;
            font-weight: 700;
            line-height: 1;
            color: var(--text);
            margin-bottom: 4px;
        }

        .sc-label { font-size: 12.5px; color: var(--muted); }

        /* ─── SECTION TITLE ─── */
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 16px;
        }

        /* ─── QUICK ACTIONS (Guest) ─── */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }

        .qa-btn {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 20px 14px;
            text-align: center;
            text-decoration: none;
            color: var(--muted);
            transition: .2s;
            cursor: pointer;
        }
        .qa-btn:hover { background: var(--gold-dim); border-color: var(--gold-border); color: var(--gold-light); }
        .qa-btn .qa-icon { font-size: 26px; margin-bottom: 8px; }
        .qa-btn .qa-lbl  { font-size: 12px; font-weight: 500; }

        /* ─── RESERVATION CARD (Guest) ─── */
        .reservation-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px 28px;
            margin-bottom: 20px;
        }

        .res-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .res-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--green);
            font-weight: 600;
        }
        .res-status::before {
            content: '';
            width: 7px; height: 7px;
            background: var(--green);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .4; }
        }

        .res-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .res-item-label { font-size: 11px; color: var(--muted); text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px; }
        .res-item-value { font-size: 15px; font-weight: 500; color: var(--text); }

        .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            color: #000;
            font-weight: 600;
            font-size: 13px;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: .18s;
        }
        .btn-gold:hover { filter: brightness(1.08); }

        /* ─── HOTEL INFO GRID (Guest) ─── */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
        }

        .info-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 22px 26px;
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13.5px;
        }
        .info-row:last-child { border-bottom: none; }
        .info-row .ir-label { color: var(--muted); }
        .info-row .ir-value { color: var(--text); font-weight: 500; }

        /* ─── SERVICES GRID (Guest) ─── */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
        }

        .svc-item {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px 10px;
            text-align: center;
            cursor: pointer;
            transition: .2s;
            text-decoration: none;
        }
        .svc-item:hover { border-color: var(--gold-border); background: var(--gold-dim); }
        .svc-icon { font-size: 24px; margin-bottom: 6px; }
        .svc-lbl  { font-size: 11px; color: var(--muted); }

        /* ─── ADMIN: OCCUPANCY + CHART AREA ─── */
        .admin-mid {
            display: grid;
            grid-template-columns: 280px 1fr 240px;
            gap: 20px;
            margin-bottom: 28px;
        }

        /* Donut */
        .donut-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px;
        }

        .donut-wrap {
            position: relative;
            width: 160px; height: 160px;
            margin: 20px auto 16px;
        }

        .donut-wrap svg { transform: rotate(-90deg); }
        .donut-center {
            position: absolute;
            inset: 0;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
        }
        .donut-pct  { font-family: 'Cormorant Garamond', serif; font-size: 30px; font-weight: 700; color: var(--text); }
        .donut-lbl  { font-size: 11px; color: var(--muted); }

        .donut-legend { margin-top: 8px; }
        .dl-row {
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; color: var(--muted);
            padding: 5px 0;
        }
        .dl-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
        .dl-pct { margin-left: auto; color: var(--text); font-weight: 500; }

        /* Revenue chart */
        .chart-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px;
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .chart-area {
            height: 160px;
            position: relative;
            overflow: hidden;
        }

        .chart-area canvas { width: 100% !important; height: 100% !important; }

        .chart-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        .cs-label { font-size: 11px; color: var(--muted); margin-bottom: 4px; }
        .cs-val   { font-size: 14px; font-weight: 600; color: var(--text); }

        /* AI Panel (admin) */
        .ai-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 22px;
        }

        .ai-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            color: var(--gold-light);
            font-size: 10px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .ai-val {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .ai-sub { font-size: 11px; color: var(--muted); margin-bottom: 16px; }

        .ai-sparkline { height: 40px; position: relative; overflow: hidden; }

        /* Activities (admin) */
        .activity-list { }
        .act-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }
        .act-row:last-child { border-bottom: none; }
        .act-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--green);
            flex-shrink: 0;
        }
        .act-dot.gold { background: var(--gold); }
        .act-body { flex: 1; }
        .act-title { font-size: 13px; color: var(--text); font-weight: 500; }
        .act-sub   { font-size: 11px; color: var(--muted); }
        .act-time  { font-size: 11px; color: var(--muted); white-space: nowrap; }

        /* Quick actions admin */
        .admin-actions {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .admin-bottom {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 20px;
            margin-top: 28px;
        }

        /* ─── UTIL ─── */
        .flex-between { display: flex; align-items: center; justify-content: space-between; }
        .mb-20 { margin-bottom: 20px; }
        .mb-28 { margin-bottom: 28px; }

        .tag-live {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(34,197,94,.1);
            color: var(--green);
            font-size: 10px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 20px;
        }
        .tag-live::before {
            content: '';
            width: 5px; height: 5px;
            background: var(--green);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        /* ─── RESPONSIVE basic ─── */
        @media (max-width: 1200px) {
            .cards-grid.cols-4 { grid-template-columns: repeat(2, 1fr); }
            .admin-mid { grid-template-columns: 1fr 1fr; }
            .ai-card   { grid-column: span 2; }
        }

    </style>
</head>

<body>

{{-- ═══════════════════════════════════════════
     SIDEBAR  (shared)
═══════════════════════════════════════════ --}}
<aside class="sidebar">

    <div class="logo-wrap">
        <div class="logo-icon">🏨</div>
        <div class="logo-text">
            <div class="logo-name">AnoHotel</div>
            <div class="logo-sub">Luxury & Comfort</div>
        </div>
    </div>

    <span class="nav-section-label">Main Menu</span>

    <a href="/dashboard" class="nav-link active">
        <span class="icon">⊞</span> Dashboard
    </a>

    <a href="/rooms" class="nav-link">
        <span class="icon">🛏</span> Rooms
    </a>

    @can('manage-reservations')
    <a href="/reservations" class="nav-link">
        <span class="icon">📅</span> Reservations
    </a>
    @endcan

    @can('view-own-reservations')
    <a href="/my-reservations" class="nav-link">
        <span class="icon">📅</span> My Reservations
    </a>
    @endcan

    @can('manage-users')
    <a href="/users" class="nav-link">
        <span class="icon">👥</span> Guests
    </a>
    @endcan

    @can('manage-payments')
    <a href="/payments" class="nav-link">
        <span class="icon">💳</span> Payments
    </a>
    @endcan

    @can('view-own-payments')
    <a href="/my-payments" class="nav-link">
        <span class="icon">💳</span> My Payments
    </a>
    @endcan

    @can('view-reports')
    <span class="nav-section-label">Analytics</span>
    <a href="/reports" class="nav-link">
        <span class="icon">📊</span> Reports
    </a>
    @endcan

    <div class="sidebar-footer">
        <div class="user-mini">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="user-mini-info">
                <div class="user-mini-name">{{ auth()->user()->name }}</div>
                <div class="user-mini-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <a href="/logout" class="logout-link"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span>⎋</span> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
            @csrf
        </form>
    </div>

</aside>

{{-- ═══════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════ --}}
<main class="main">

    {{-- TOPBAR --}}
    <div class="topbar">
        <div class="topbar-left">
            <h1>
                @can('admin-only') Good Evening, @endcan
                @can('view-own-reservations') Welcome, @endcan
                {{ auth()->user()->name }} 👋
            </h1>
            <p>
                @can('admin-only') Here's your hotel performance overview for today. @endcan
                @can('view-own-reservations') Enjoy your stay and let us take care of the rest. @endcan
            </p>
        </div>
        <div class="topbar-right">
            <div class="topbar-date" id="live-date"></div>
            <div class="notif-btn">🔔<div class="notif-badge"></div></div>
            <div class="role-pill">{{ auth()->user()->role }}</div>
        </div>
    </div>

    {{-- ══════════════════════════
         GUEST VIEW
    ══════════════════════════ --}}
    @can('view-own-reservations')

    {{-- Hero --}}
    <div class="hero mb-28">
        <div class="hero-content">
            <div class="hero-eyebrow">✦ Luxury Stay Experience</div>
            <h2>Have a comfortable<br>and pleasant stay!</h2>
            <p>Our staff is ready to assist you 24/7.<br>Need anything? Contact the concierge anytime.</p>
            <br>
            <a href="/my-reservations" class="btn-gold">📋 View My Reservations &rarr;</a>
        </div>
        <div class="hero-badge">
            <div class="hb-icon">⭐</div>
            <div class="hb-val">Gold</div>
            <div class="hb-lbl">Member Status</div>
        </div>
    </div>

    {{-- Guest Stat Cards --}}
    <div class="cards-grid cols-3 mb-28">

        <div class="stat-card">
            <div class="sc-header">
                <div class="sc-icon gold">📅</div>
            </div>
            <div class="sc-val">{{ $myReservations }}</div>
            <div class="sc-label">My Reservations</div>
        </div>

        <div class="stat-card">
            <div class="sc-header">
                <div class="sc-icon green">💳</div>
            </div>
            <div class="sc-val">{{ $myPayments }}</div>
            <div class="sc-label">My Payments</div>
        </div>

        <div class="stat-card">
            <div class="sc-header">
                <div class="sc-icon blue">🛏</div>
            </div>
            <div class="sc-val">{{ $availableRooms }}</div>
            <div class="sc-label">Available Rooms</div>
        </div>

    </div>

    {{-- Quick Actions --}}
    <div class="section-title mb-20">Quick Actions</div>
    <div class="quick-actions mb-28">
        <a href="/rooms"           class="qa-btn"><div class="qa-icon">🛏</div><div class="qa-lbl">Browse Rooms</div></a>
        <a href="/my-reservations" class="qa-btn"><div class="qa-icon">📅</div><div class="qa-lbl">Reservations</div></a>
        <a href="/my-payments"     class="qa-btn"><div class="qa-icon">💳</div><div class="qa-lbl">Payments</div></a>
        <a href="#"                class="qa-btn"><div class="qa-icon">🎧</div><div class="qa-lbl">Concierge</div></a>
    </div>

    {{-- Hotel Info + Services --}}
    <div class="info-grid mb-28">

        <div class="info-card">
            <div class="section-title mb-20">🏨 Hotel Information</div>
            <div class="info-row">
                <span class="ir-label">⏰ Check-in Time</span>
                <span class="ir-value">15:00</span>
            </div>
            <div class="info-row">
                <span class="ir-label">⏰ Check-out Time</span>
                <span class="ir-value">12:00</span>
            </div>
            <div class="info-row">
                <span class="ir-label">📶 Wi-Fi Network</span>
                <span class="ir-value">AnoHotel_Guest</span>
            </div>
            <div class="info-row">
                <span class="ir-label">📞 Support</span>
                <span class="ir-value">+62 21 1234 5678</span>
            </div>
        </div>

        <div class="info-card">
            <div class="section-title mb-20">🛎 Hotel Services</div>
            <div class="services-grid">
                <a href="#" class="svc-item"><div class="svc-icon">🍽</div><div class="svc-lbl">Room Service</div></a>
                <a href="#" class="svc-item"><div class="svc-icon">🧹</div><div class="svc-lbl">Housekeeping</div></a>
                <a href="#" class="svc-item"><div class="svc-icon">👕</div><div class="svc-lbl">Laundry</div></a>
                <a href="#" class="svc-item"><div class="svc-icon">💆</div><div class="svc-lbl">Spa</div></a>
                <a href="#" class="svc-item"><div class="svc-icon">🚗</div><div class="svc-lbl">Transport</div></a>
                <a href="#" class="svc-item"><div class="svc-icon">⋯</div><div class="svc-lbl">More</div></a>
            </div>
        </div>

    </div>

    @endcan


    {{-- ══════════════════════════
         ADMIN VIEW
    ══════════════════════════ --}}
    @can('manage-users')

    {{-- Hero Admin --}}
    <div class="hero mb-28">
        <div class="hero-content">
            <div class="hero-eyebrow">✦ Admin Control Panel</div>
            <h2>Hotel Management<br>Dashboard</h2>
            <p>Manage rooms, reservations, payments, users,<br>and hotel analytics in one modern platform.</p>
        </div>
        <div class="hero-badge">
            <div class="hb-icon">📊</div>
            <div class="hb-val">+22%</div>
            <div class="hb-lbl">Revenue this week</div>
        </div>
    </div>

    {{-- Admin Stat Cards --}}
    <div class="cards-grid cols-4 mb-28">

        <div class="stat-card">
            <div class="sc-header">
                <div class="sc-icon blue">🏨</div>
                <span class="sc-badge">+12%</span>
            </div>
            <div class="sc-val">{{ $totalRooms }}</div>
            <div class="sc-label">Total Rooms</div>
        </div>

        <div class="stat-card">
            <div class="sc-header">
                <div class="sc-icon gold">📅</div>
                <span class="sc-badge">+18%</span>
            </div>
            <div class="sc-val">{{ $totalReservations }}</div>
            <div class="sc-label">Reservations</div>
        </div>

        <div class="stat-card">
            <div class="sc-header">
                <div class="sc-icon purple">👥</div>
                <span class="sc-badge">+15%</span>
            </div>
            <div class="sc-val">{{ $totalUsers }}</div>
            <div class="sc-label">Total Users</div>
        </div>

        <div class="stat-card">
            <div class="sc-header">
                <div class="sc-icon green">💰</div>
                <span class="sc-badge">+22%</span>
            </div>
            <div class="sc-val">{{ $totalPayments }}</div>
            <div class="sc-label">Total Payments</div>
        </div>

    </div>

    {{-- Mid Row: Donut + Chart + AI --}}
    <div class="admin-mid mb-28">

        {{-- Occupancy Donut --}}
        <div class="donut-card">
            <div class="flex-between">
                <div class="section-title">Occupancy Rate</div>
                <span class="tag-live">Live</span>
            </div>

            <div class="donut-wrap">
                <svg viewBox="0 0 160 160" width="160" height="160">
                    {{-- track --}}
                    <circle cx="80" cy="80" r="60" fill="none" stroke="rgba(255,255,255,.06)" stroke-width="18"/>
                    {{-- occupied 85% --}}
                    <circle cx="80" cy="80" r="60" fill="none" stroke="#C9A84C" stroke-width="18"
                            stroke-dasharray="{{ round(0.85 * 2 * 3.14159 * 60) }} 1000"
                            stroke-linecap="round"/>
                    {{-- maintenance 3% --}}
                    <circle cx="80" cy="80" r="60" fill="none" stroke="rgba(239,68,68,.5)" stroke-width="18"
                            stroke-dasharray="{{ round(0.03 * 2 * 3.14159 * 60) }} 1000"
                            stroke-dashoffset="-{{ round(0.85 * 2 * 3.14159 * 60) }}"
                            stroke-linecap="round"/>
                </svg>
                <div class="donut-center">
                    <div class="donut-pct">85%</div>
                    <div class="donut-lbl">Occupied</div>
                </div>
            </div>

            <div class="donut-legend">
                <div class="dl-row"><div class="dl-dot" style="background:var(--gold)"></div> Occupied <span class="dl-pct">85%</span></div>
                <div class="dl-row"><div class="dl-dot" style="background:rgba(59,130,246,.7)"></div> Available <span class="dl-pct">12%</span></div>
                <div class="dl-row"><div class="dl-dot" style="background:rgba(239,68,68,.5)"></div> Maintenance <span class="dl-pct">3%</span></div>
            </div>
        </div>

        {{-- Weekly Revenue Chart --}}
        <div class="chart-card">
            <div class="chart-header">
                <div class="section-title">Weekly Revenue Overview</div>
            </div>
            <div class="chart-area">
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="chart-stats">
                <div>
                    <div class="cs-label">Average Daily</div>
                    <div class="cs-val">Rp 12.425.000</div>
                </div>
                <div>
                    <div class="cs-label">Highest Day</div>
                    <div class="cs-val" style="color:var(--gold)">Saturday</div>
                </div>
                <div>
                    <div class="cs-label">Total This Week</div>
                    <div class="cs-val">Rp 86.975.000</div>
                </div>
            </div>
        </div>

        {{-- AI Panel --}}
        <div class="ai-card">
            <div class="ai-badge">✦ AI Prediction</div>
            <div style="font-size:12px;color:var(--muted);margin-bottom:6px;">Expected revenue tomorrow</div>
            <div class="ai-val">Rp 12.500.000</div>
            <div class="ai-sub">↑ 14% · Based on booking trend & season</div>
            <div class="ai-sparkline" id="sparkline-wrap">
                <canvas id="sparklineChart"></canvas>
            </div>
            <br>
            <div class="ai-badge" style="margin-top:8px;">⊞ Room Recommendation</div>
            <div style="margin-top:10px;">
                <div style="font-size:13px;font-weight:600;color:var(--text)">Suite Room</div>
                <div style="font-size:11px;color:var(--muted);margin-top:2px;">High demand expected this weekend</div>
            </div>
        </div>

    </div>

    {{-- Admin Bottom: Quick Actions + Recent Activity --}}
    <div class="admin-bottom">

        <div>
            <div class="section-title mb-20">⚡ Quick Actions</div>
            <div class="admin-actions">
                <a href="/reservations/create" class="qa-btn"><div class="qa-icon">➕</div><div class="qa-lbl">New Reservation</div></a>
                <a href="/reservations"        class="qa-btn"><div class="qa-icon">🏷</div><div class="qa-lbl">Check-in Guest</div></a>
                <a href="/rooms"               class="qa-btn"><div class="qa-icon">🔒</div><div class="qa-lbl">Block Date</div></a>
                <a href="/reports"             class="qa-btn"><div class="qa-icon">📋</div><div class="qa-lbl">Generate Report</div></a>
                <a href="#"                    class="qa-btn"><div class="qa-icon">✨</div><div class="qa-lbl">AI Recommend</div></a>
            </div>
        </div>

        <div class="info-card">
            <div class="flex-between mb-20">
                <div class="section-title">Recent Activities</div>
                <a href="#" style="font-size:12px;color:var(--gold);text-decoration:none;">View all →</a>
            </div>
            <div class="activity-list">
                <div class="act-row">
                    <div class="act-dot"></div>
                    <div class="act-body">
                        <div class="act-title">New reservation #INV-250529</div>
                        <div class="act-sub">Deluxe Room · 2 nights</div>
                    </div>
                    <div class="act-time">5 min ago</div>
                </div>
                <div class="act-row">
                    <div class="act-dot gold"></div>
                    <div class="act-body">
                        <div class="act-title">Guest check-in – John Doe</div>
                        <div class="act-sub">Suite Room</div>
                    </div>
                    <div class="act-time">18 min ago</div>
                </div>
                <div class="act-row">
                    <div class="act-dot"></div>
                    <div class="act-body">
                        <div class="act-title">Payment received – #PAY-250529</div>
                        <div class="act-sub">Rp 3.750.000</div>
                    </div>
                    <div class="act-time">1 hr ago</div>
                </div>
            </div>
        </div>

    </div>

    @endcan

</main>

{{-- ═══ SCRIPTS ═══ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>

    /* Live date */
    const dateEl = document.getElementById('live-date');
    if (dateEl) {
        const fmt = new Intl.DateTimeFormat('en-GB', { day:'2-digit', month:'short', year:'numeric' });
        dateEl.textContent = fmt.format(new Date());
    }

    /* Revenue chart */
    const rc = document.getElementById('revenueChart');
    if (rc) {
        new Chart(rc, {
            type: 'line',
            data: {
                labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
                datasets: [{
                    data: [8200000, 9500000, 11000000, 13500000, 18000000, 24850000, 22000000],
                    borderColor: '#C9A84C',
                    backgroundColor: 'rgba(201,168,76,.08)',
                    fill: true,
                    tension: 0.45,
                    pointBackgroundColor: '#C9A84C',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { callbacks: {
                    label: ctx => ' Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                }}},
                scales: {
                    x: { grid: { color: 'rgba(255,255,255,.04)' }, ticks: { color: '#6B7A90', font: { size: 11 } } },
                    y: { grid: { color: 'rgba(255,255,255,.04)' }, ticks: {
                        color: '#6B7A90', font: { size: 10 },
                        callback: v => 'Rp ' + (v/1000000).toFixed(0) + 'M'
                    }}
                }
            }
        });
    }

    /* Sparkline */
    const sp = document.getElementById('sparklineChart');
    if (sp) {
        new Chart(sp, {
            type: 'line',
            data: {
                labels: Array(12).fill(''),
                datasets: [{
                    data: [8,9,7,11,10,13,12,15,13,14,12,14.5],
                    borderColor: '#C9A84C',
                    backgroundColor: 'rgba(201,168,76,.1)',
                    fill: true,
                    tension: 0.5,
                    pointRadius: 0,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales: { x: { display: false }, y: { display: false } }
            }
        });
    }

</script>

</body>
</html>