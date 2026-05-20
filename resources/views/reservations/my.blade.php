{{-- resources/views/reservations/my-reservations.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations - AnoHotel Luxury</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            --warning: #f59e0b;
            --info: #3b82f6;
            --purple: #a855f7;
            --danger: #ef4444;

            --r-sm: 8px;
            --r-md: 12px;
            --r-lg: 20px;
        }

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
            background: transparent;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--gold-border);
            padding: 2rem 1.5rem;
            position: fixed;
            left: 0;
            top: 0;
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
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #041026;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.2);
        }

        .logo-text .logo-name {
            font-family: 'Cinzel', serif;
            font-size: 1.2rem;
            font-weight: 700;
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
            transition: all 0.25s;
            border: 1px solid transparent;
        }

        .nav-link .nav-icon {
            width: 18px;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .nav-link:hover {
            background: var(--surface-hover);
            color: #fff;
        }

        .nav-link:hover .nav-icon {
            color: var(--gold);
        }

        .nav-link.active {
            background: var(--gold-dim);
            color: var(--gold-light);
            font-weight: 600;
            border-color: var(--gold-border);
        }

        .nav-link.active .nav-icon {
            color: var(--gold);
        }

        .nav-spacer {
            flex: 1;
        }

        .nav-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .nav-logout:hover {
            color: #ff6b6b;
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            padding: 2rem 2rem 2rem 1.5rem;
        }

        .dashboard-container {
            width: 100%;
            max-width: none;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* HERO */
        .reservations-hero {
            position: relative;
            width: 100%;
            min-height: 210px;
            padding: 2.8rem;
            border-radius: var(--r-lg);
            overflow: hidden;
            border: 1px solid var(--gold-border);
            background: #030d20;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .hero-img-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/Reservations.png') }}');
            background-size: cover;
            background-position: center;
            opacity: 0.55;
            transform: scale(1.03);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    90deg,
                    rgba(4,16,38,0.88) 0%,
                    rgba(4,16,38,0.62) 48%,
                    rgba(4,16,38,0.35) 100%
                );
        }

        .title-block {
            position: relative;
            z-index: 2;
        }

        .title-block h1 {
            font-family: 'Cinzel', serif;
            font-size: 2.2rem;
            font-weight: 600;
            color: #fff;
        }

        .title-block p {
            color: #c8d3e6;
            font-size: 0.92rem;
            margin-top: 0.5rem;
        }

        /* STATS */
        .stats-summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            width: 100%;
        }

        .mini-card-summary {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-md);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mcs-icon-box {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border-light);
            display: grid;
            place-items: center;
            font-size: 1.1rem;
            color: var(--gold);
        }

        .mcs-content-text p {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .mcs-content-text h3 {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            margin-top: 1px;
        }

        .mcs-content-text span {
            font-size: 0.7rem;
            color: var(--text-muted);
            display: block;
            margin-top: 2px;
        }

        /* LAYOUT */
        .split-content-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 1.5rem;
            width: 100%;
        }

        .left-list-side {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .filter-nav-tabs {
            display: flex;
            gap: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding-bottom: 0.5rem;
            width: 100%;
        }

        .tab-item-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            padding-bottom: 0.6rem;
            position: relative;
            transition: color 0.2s;
        }

        .tab-item-link:hover,
        .tab-item-link.active {
            color: var(--gold-light);
        }

        .tab-item-link.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        /* RESERVATION CARD */
        .reservation-luxury-card {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-lg);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            transition: all 0.25s ease;
        }

        .reservation-luxury-card:hover {
            border-color: var(--gold-border);
            background: var(--surface-hover);
            transform: translateY(-2px);
        }

        .rlc-left-details {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .rlc-thumbnail-placeholder {
            width: 110px;
            height: 75px;
            border-radius: var(--r-sm);
            background: rgba(3, 13, 32, 0.6);
            border: 1px solid var(--border-light);
            display: grid;
            place-items: center;
            color: var(--gold-dark);
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .rlc-meta h4 {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
        }

        .rlc-sub-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
            margin-top: 6px;
        }

        .rlc-sub-info span {
            font-size: 0.78rem;
            color: var(--text-secondary);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .rlc-sub-info i {
            color: var(--gold-dark);
            font-size: 0.75rem;
            width: 14px;
            text-align: center;
        }

        .rlc-center-dates-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            text-align: left;
        }

        .rlc-date-column p {
            font-size: 0.68rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .rlc-date-column h5 {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--gold-light);
            margin-top: 2px;
        }

        .rlc-date-column span {
            font-size: 0.72rem;
            color: var(--text-secondary);
        }

        .rlc-right-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .status-badge-pill {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-align: center;
        }

        .status-badge-pill.pending {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            color: var(--warning);
        }

        .status-badge-pill.confirmed {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .status-badge-pill.checked_in {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: var(--info);
        }

        .status-badge-pill.checked_out {
            background: rgba(168, 85, 247, 0.1);
            border: 1px solid rgba(168, 85, 247, 0.2);
            color: var(--purple);
        }

        .status-badge-pill.cancelled {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--danger);
        }

        .btn-luxury-view {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border-light);
            color: var(--text-secondary);
            padding: 0.45rem 1.1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-luxury-view:hover {
            border-color: var(--gold);
            color: #fff;
            background: var(--gold-dim);
        }

        /* RIGHT PANEL */
        .right-panel-sidebar-stack {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .side-panel-card {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-lg);
            padding: 1.5rem;
        }

        .side-panel-card-title {
            font-family: 'Cinzel', serif;
            font-size: 1rem;
            color: #fff;
            font-weight: 600;
            margin-bottom: 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 0.6rem;
        }

        .countdown-row-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            text-align: center;
            margin-bottom: 1.25rem;
        }

        .countdown-item-box {
            background: rgba(0,0,0,0.15);
            border: 1px solid var(--border-light);
            padding: 0.6rem;
            border-radius: var(--r-sm);
        }

        .countdown-item-box h4 {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
        }

        .countdown-item-box p {
            font-size: 0.62rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            margin-top: 1px;
        }

        .upcoming-room-mini-desc {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.04);
            padding-top: 0.85rem;
        }

        .urmd-title h5 {
            font-family: 'Cinzel', serif;
            font-size: 0.88rem;
            color: #fff;
        }

        .urmd-title p {
            font-size: 0.72rem;
            color: var(--text-secondary);
            margin-top: 1px;
        }

        .panel-data-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            font-size: 0.82rem;
            color: var(--text-secondary);
        }

        .panel-data-row:last-child {
            border-bottom: none;
        }

        .pdr-label {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pdr-value {
            font-weight: 600;
            color: #fff;
        }

        .btn-side-panel-action {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--gold);
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            margin-top: 1.25rem;
            transition: color 0.2s;
            width: 100%;
        }

        .btn-side-panel-action:hover {
            color: var(--gold-light);
        }

        @media (max-width: 1200px) {
            .split-content-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .reservation-luxury-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .rlc-right-actions {
                width: 100%;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                border-top: 1px solid rgba(255,255,255,0.05);
                padding-top: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .stats-summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@include('layouts.sidebar-guest')

<main class="main">
    <div class="dashboard-container">

        <div class="reservations-hero">
            <div class="hero-img-bg"></div>
            <div class="hero-overlay"></div>

            <div class="title-block">
                <h1>My Reservations</h1>
                <p>View, track, and manage your luxury stay history at AnoHotel</p>
            </div>
        </div>

        <div class="stats-summary-grid">
            <div class="mini-card-summary">
                <div class="mcs-icon-box"><i class="fas fa-calendar-alt"></i></div>
                <div class="mcs-content-text">
                    <p>Upcoming Stays</p>
                    <h3>{{ $reservations->whereIn('status', ['pending', 'confirmed', 'checked_in'])->count() }}</h3>
                    <span>Active bookings logged</span>
                </div>
            </div>

            <div class="mini-card-summary">
                <div class="mcs-icon-box"><i class="fas fa-moon"></i></div>
                <div class="mcs-content-text">
                    <p>Total Reservations</p>
                    <h3>{{ $reservations->count() }}</h3>
                    <span>Reservations booked in total</span>
                </div>
            </div>

            <div class="mini-card-summary">
                <div class="mcs-icon-box"><i class="fas fa-award"></i></div>
                <div class="mcs-content-text">
                    <p>Loyalty Level Points</p>
                    <h3>320</h3>
                    <span>Gold Member Status</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="w-full bg-[#10b981]/10 border border-[#10b981]/20 text-emerald-400 p-4 rounded-xl font-medium text-sm">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="split-content-layout">

            <div class="left-list-side">
                <div class="filter-nav-tabs" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <div style="display: flex; gap: 1.5rem;">
                        <a href="#" class="tab-item-link active">All Reservations</a>
                        <a href="#" class="tab-item-link">Upcoming</a>
                        <a href="#" class="tab-item-link">Completed</a>
                        <a href="#" class="tab-item-link">Cancelled</a>
                    </div>

                    @if(auth()->user()->role === 'guest')
                    <a href="{{ route('reservations.create') }}" class="btn-luxury-view" style="background: linear-gradient(135deg, var(--gold-light), var(--gold)); color: #041026; border: none; box-shadow: 0 4px 15px rgba(212,175,55,0.25); border-radius: 8px;">
                        <i class="fas fa-plus"></i> Book a Room
                    </a>
                    @endif
                </div>

                @forelse($reservations as $reservation)
                    <div class="reservation-luxury-card">
                        <div class="rlc-left-details">
                            <div class="rlc-thumbnail-placeholder">
                                <i class="fas fa-bed"></i>
                            </div>

                            <div class="rlc-meta">
                                <h4>
                                    Room {{ $reservation->room->room_number ?? '-' }}
                                </h4>

                                <div class="rlc-sub-info">
                                    <span>
                                        <i class="fas fa-fingerprint"></i>
                                        ID: #RES-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}
                                    </span>

                                    <span>
                                        <i class="fas fa-users"></i>
                                        {{ $reservation->total_guest }} Guests
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="rlc-center-dates-grid">
                            <div class="rlc-date-column">
                                <p>Check-in</p>
                                <h5>{{ $reservation->check_in }}</h5>
                                <span>15:00</span>
                            </div>

                            <div class="rlc-date-column">
                                <p>Check-out</p>
                                <h5>{{ $reservation->check_out }}</h5>
                                <span>12:00</span>
                            </div>
                        </div>

                        <div class="rlc-right-actions">
                            <span class="status-badge-pill {{ $reservation->status }}">
                                {{ str_replace('_', ' ', ucfirst($reservation->status)) }}
                            </span>

                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn-luxury-view">
                                View Details
                                <i class="fas fa-chevron-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="w-full border border-white/5 rounded-2xl p-10 text-center text-slate-400" style="background: var(--surface);">
                        <i class="fas fa-receipt text-3xl block mb-3 opacity-40 text-amber-500"></i>
                        No hotel reservations found in your history log account.
                    </div>
                @endforelse
            </div>

            <div class="right-panel-sidebar-stack">
                <div class="side-panel-card">
                    <div class="side-panel-card-title">Upcoming Stay</div>

                    <div class="countdown-row-grid">
                        <div class="countdown-item-box">
                            <h4>28</h4>
                            <p>Days</p>
                        </div>

                        <div class="countdown-item-box">
                            <h4>08</h4>
                            <p>Hours</p>
                        </div>

                        <div class="countdown-item-box">
                            <h4>45</h4>
                            <p>Mins</p>
                        </div>
                    </div>

                    <div class="upcoming-room-mini-desc">
                        <div class="w-8 h-8 rounded bg-amber-500/10 border border-amber-500/20 grid place-items-center text-amber-400 text-xs">
                            <i class="fas fa-hotel"></i>
                        </div>

                        <div class="urmd-title">
                            <h5>Deluxe Suite Room</h5>
                            <p>Check-in scheduled May 31, 2026</p>
                        </div>
                    </div>

                    <a href="#" class="btn-side-panel-action">
                        View Reservation Details
                        <span><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>

                <div class="side-panel-card">
                    <div class="side-panel-card-title">Hotel Information</div>

                    <div class="panel-data-row">
                        <span class="pdr-label"><i class="fas fa-clock text-[#d4af37] mr-1"></i> Check-in Time</span>
                        <span class="pdr-value">15:00</span>
                    </div>

                    <div class="panel-data-row">
                        <span class="pdr-label"><i class="fas fa-history text-[#d4af37] mr-1"></i> Check-out Time</span>
                        <span class="pdr-value">12:00</span>
                    </div>

                    <div class="panel-data-row">
                        <span class="pdr-label"><i class="fas fa-wifi text-[#d4af37] mr-1"></i> Wi-Fi SSID</span>
                        <span class="pdr-value">AnoHotel_Guest</span>
                    </div>

                    <div class="panel-data-row">
                        <span class="pdr-label"><i class="fas fa-phone text-[#d4af37] mr-1"></i> Support Hub</span>
                        <span class="pdr-value">+62 21 1234 5678</span>
                    </div>
                </div>

                <div class="side-panel-card" style="position: relative; overflow: hidden;">
                    <div class="side-panel-card-title" style="margin-bottom: 0.5rem; border: none;">
                        Enhance Your Stay
                    </div>

                    <p style="font-size: 0.78rem; color: var(--text-secondary); line-height: 1.5; margin-bottom: 1.25rem;">
                        Discover our premium signature services crafted explicitly for your comfort.
                    </p>

                    <a href="#" class="btn-side-panel-action" style="margin-top: 0;">
                        Explore Services
                        <span><i class="fas fa-chevron-right text-[10px]"></i></span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</main>

<script>
// Filter Reservation Tabs Logic
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab-item-link');
    const cards = document.querySelectorAll('.reservation-luxury-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const filter = tab.innerText.toLowerCase();

            cards.forEach(card => {
                const badge = card.querySelector('.status-badge-pill');
                if (!badge) return;
                const status = badge.innerText.toLowerCase();
                
                let show = false;
                if (filter === 'all reservations') {
                    show = true;
                } else if (filter === 'upcoming') {
                    show = status === 'pending' || status === 'confirmed' || status === 'checked in';
                } else if (filter === 'completed') {
                    show = status === 'completed';
                } else if (filter === 'cancelled') {
                    show = status === 'cancelled';
                }

                card.style.display = show ? 'flex' : 'none';
            });
        });
    });
});
</script>

</body>
</html>