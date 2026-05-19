<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --gold-dim: rgba(212,175,55,.08);
            --gold-border: rgba(212,175,55,.18);
            --border: rgba(255,255,255,.08);
            --muted: #90a0b7;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #3b82f6;
            --purple: #a855f7;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #041026 0%, #08172f 50%, #0d2347 100%);
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            padding: 2rem;
        }

        .hero {
            position: relative;
            min-height: 240px;
            border-radius: 26px;
            overflow: hidden;
            border: 1px solid var(--gold-border);
            background: #030d20;
            padding: 2.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 14px 40px rgba(0,0,0,.25);
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/Dashboard.png') }}');
            background-size: cover;
            background-position: center;
            opacity: .45;
            transform: scale(1.03);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                rgba(4,16,38,.95),
                rgba(4,16,38,.65),
                rgba(4,16,38,.35)
            );
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .eyebrow {
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: .25em;
            font-size: .72rem;
            font-weight: 800;
            margin-bottom: .9rem;
        }

        .hero h1 {
            font-family: 'Cinzel', serif;
            font-size: 2.7rem;
            font-weight: 700;
            margin-bottom: .6rem;
        }

        .hero p {
            color: #c8d3e6;
            max-width: 650px;
            line-height: 1.7;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-top: -4rem;
            position: relative;
            z-index: 5;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: rgba(10,18,32,.85);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 20px;
            padding: 1.4rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 16px 35px rgba(0,0,0,.25);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border);
            display: grid;
            place-items: center;
            color: var(--gold);
            font-size: 1.15rem;
        }

        .stat-label {
            color: var(--muted);
            font-size: .78rem;
            margin-bottom: .35rem;
        }

        .stat-value {
            font-size: 1.7rem;
            font-weight: 900;
            color: white;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 1.5rem;
        }

        .panel {
            background: rgba(5,12,24,.82);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 24px;
            padding: 1.8rem;
            box-shadow: 0 18px 38px rgba(0,0,0,.25);
        }

        .panel h2 {
            font-family: 'Cinzel', serif;
            font-size: 1.35rem;
            margin-bottom: .7rem;
        }

        .panel p {
            color: var(--muted);
            line-height: 1.8;
        }

        .summary-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1.4rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem;
            border-radius: 16px;
            background: rgba(255,255,255,.035);
            border: 1px solid rgba(255,255,255,.06);
        }

        .summary-item span:first-child {
            color: var(--muted);
        }

        .summary-item span:last-child {
            font-weight: 900;
            color: var(--gold-light);
        }

        .chart-box {
            height: 260px;
            margin-top: 1.5rem;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,.06);
            background:
                linear-gradient(180deg, rgba(212,175,55,.10), transparent),
                repeating-linear-gradient(
                    to top,
                    rgba(255,255,255,.04) 0,
                    rgba(255,255,255,.04) 1px,
                    transparent 1px,
                    transparent 52px
                );
            position: relative;
            overflow: hidden;
        }

        .chart-line {
            position: absolute;
            left: 8%;
            right: 8%;
            bottom: 25%;
            height: 4px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            border-radius: 999px;
            transform: rotate(-8deg);
            box-shadow: 0 0 25px rgba(212,175,55,.35);
        }

        .chart-dot {
            position: absolute;
            width: 12px;
            height: 12px;
            background: var(--gold);
            border-radius: 50%;
            box-shadow: 0 0 0 5px rgba(212,175,55,.12);
        }

        .dot-1 { left: 12%; bottom: 24%; }
        .dot-2 { left: 34%; bottom: 34%; }
        .dot-3 { left: 58%; bottom: 48%; }
        .dot-4 { right: 14%; bottom: 58%; }

        @media(max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 768px) {
            .main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                margin-top: -2rem;
            }

            .hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>

@include('layouts.sidebar-management')

<main class="main">

    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="eyebrow">Hotel Analytics</div>

            <h1>Reports Dashboard</h1>

            <p>
                Monitor hotel performance, revenue, reservations, guest activity,
                and room availability from backend data.
            </p>
        </div>
    </section>

    <section class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>

            <div>
                <div class="stat-label">Total Revenue</div>
                <div class="stat-value">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>

            <div>
                <div class="stat-label">Reservations</div>
                <div class="stat-value">
                    {{ $totalReservations }}
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>

            <div>
                <div class="stat-label">Guests</div>
                <div class="stat-value">
                    {{ $totalGuests }}
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-door-open"></i>
            </div>

            <div>
                <div class="stat-label">Available Rooms</div>
                <div class="stat-value">
                    {{ $availableRooms }}
                </div>
            </div>
        </div>

    </section>

    <section class="summary-grid">

        <div class="panel">
            <h2>Report Summary</h2>

            <p>
                This dashboard displays hotel business statistics based on your system database.
                Revenue is calculated from payment data, reservations are counted from booking records,
                guest totals are counted from user accounts with guest role, and available rooms are counted
                from active room availability status.
            </p>

            <div class="summary-list">

                <div class="summary-item">
                    <span>Revenue Source</span>
                    <span>Payments Table</span>
                </div>

                <div class="summary-item">
                    <span>Reservation Source</span>
                    <span>Reservations Table</span>
                </div>

                <div class="summary-item">
                    <span>Guest Source</span>
                    <span>Users Role: Guest</span>
                </div>

                <div class="summary-item">
                    <span>Room Source</span>
                    <span>Status: Available</span>
                </div>

            </div>
        </div>

        <div class="panel">
            <h2>Business Overview</h2>

            <p>
                Visual overview of hotel growth and activity performance.
            </p>

            <div class="chart-box">
                <div class="chart-line"></div>
                <div class="chart-dot dot-1"></div>
                <div class="chart-dot dot-2"></div>
                <div class="chart-dot dot-3"></div>
                <div class="chart-dot dot-4"></div>
            </div>
        </div>

    </section>

</main>

</body>
</html>