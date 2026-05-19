<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Dashboard - AnoHotel Luxury</title>

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
            --gold-border: rgba(212, 175, 55, 0.18);

            --bg-gradient: linear-gradient(135deg, #041026 0%, #08172f 50%, #0d2347 100%);
            --sidebar-bg: #030d20;

            --surface: rgba(255, 255, 255, 0.04);
            --surface-hover: rgba(255, 255, 255, 0.07);
            --border-light: rgba(255, 255, 255, 0.08);

            --text-primary: #ffffff;
            --text-secondary: #90a0b7;
            --text-muted: #536685;

            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;

            --r-sm: 10px;
            --r-md: 14px;
            --r-lg: 22px;
        }

        html {
            background: var(--bg-gradient);
            background-attachment: fixed;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            color: var(--text-primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            background: transparent;
            overflow-x: hidden;
        }

        .management-sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--gold-border);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: .85rem;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: #041026;
            border-radius: 8px;
            display: grid;
            place-items: center;
            box-shadow: 0 4px 14px rgba(212, 175, 55, .22);
        }

        .logo-name {
            font-family: 'Cinzel', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gold);
            line-height: 1;
        }

        .logo-sub {
            color: var(--text-muted);
            font-size: .65rem;
            letter-spacing: .16em;
            text-transform: uppercase;
            margin-top: .25rem;
        }

        .sidebar-divider {
            height: 1px;
            background: var(--gold-border);
            opacity: .55;
            margin: 1rem .75rem;
        }

        .sidebar-label {
            color: var(--gold);
            opacity: .75;
            font-size: .65rem;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase;
            padding: 0 .75rem;
            margin: 1.2rem 0 .7rem;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: .25rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .85rem;
            padding: .8rem .9rem;
            border-radius: var(--r-sm);
            text-decoration: none;
            color: var(--text-secondary);
            font-size: .9rem;
            font-weight: 500;
            border: 1px solid transparent;
            transition: .25s;
        }

        .sidebar-link i {
            width: 18px;
            text-align: center;
            color: var(--text-muted);
        }

        .sidebar-link:hover {
            background: var(--surface-hover);
            color: #fff;
        }

        .sidebar-link:hover i {
            color: var(--gold);
        }

        .sidebar-link.active {
            background: var(--gold-dim);
            color: var(--gold-light);
            border-color: var(--gold-border);
            font-weight: 700;
        }

        .sidebar-link.active i {
            color: var(--gold);
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-logout {
            display: flex;
            align-items: center;
            gap: .7rem;
            color: var(--text-muted);
            text-decoration: none;
            padding: .75rem .9rem;
            border-radius: var(--r-sm);
            border: 1px solid transparent;
            transition: .25s;
            font-size: .85rem;
        }

        .sidebar-logout:hover {
            color: #ff8a8a;
            border-color: rgba(239, 68, 68, .2);
            background: rgba(239, 68, 68, .08);
        }

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

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 1.25rem;
        }

        .topbar-left h1 {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            color: #fff;
        }

        .topbar-left p {
            color: var(--text-secondary);
            font-size: .88rem;
            margin-top: .3rem;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: .8rem;
        }

        .user-pill,
        .role-badge {
            background: var(--surface);
            border: 1px solid var(--border-light);
            border-radius: var(--r-sm);
            padding: .65rem 1rem;
            display: flex;
            align-items: center;
            gap: .65rem;
            font-size: .85rem;
        }

        .role-badge {
            background: var(--gold-dim);
            border-color: var(--gold-border);
            color: var(--gold-light);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: .05em;
        }

        .management-hero {
            position: relative;
            min-height: 230px;
            padding: 2.8rem;
            border-radius: var(--r-lg);
            overflow: hidden;
            border: 1px solid var(--gold-border);
            background: #030d20;
            box-shadow: 0 10px 30px rgba(0,0,0,.28);
        }

        .hero-img-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/Dashboard.png') }}');
            background-size: cover;
            background-position: center;
            opacity: .55;
            transform: scale(1.03);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                rgba(4,16,38,.9) 0%,
                rgba(4,16,38,.65) 48%,
                rgba(4,16,38,.35) 100%
            );
        }

        .hero-title {
            position: relative;
            z-index: 2;
        }

        .hero-title h2 {
            font-family: 'Cinzel', serif;
            font-size: 2.25rem;
            color: #fff;
            font-weight: 600;
        }

        .hero-title p {
            color: #c8d3e6;
            font-size: .92rem;
            margin-top: .5rem;
            max-width: 760px;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }

        .stat-card {
            background: var(--surface);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-md);
            padding: 1.35rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: .25s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            background: var(--surface-hover);
            border-color: var(--gold-border);
        }

        .sc-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,.04);
            border: 1px solid var(--border-light);
            display: grid;
            place-items: center;
            color: var(--gold);
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .sc-info p {
            color: var(--text-secondary);
            font-size: .78rem;
            margin-bottom: .25rem;
        }

        .sc-val {
            font-family: 'Cinzel', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
        }

        .admin-mid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 1.5rem;
        }

        .info-card,
        .chart-card {
            background: var(--surface);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-lg);
            padding: 1.5rem;
        }

        .section-title {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
            padding-bottom: .75rem;
            border-bottom: 1px solid rgba(255,255,255,.06);
            margin-bottom: 1rem;
        }

        .activity {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .85rem 0;
            border-bottom: 1px solid rgba(255,255,255,.05);
            color: var(--text-secondary);
            font-size: .85rem;
        }

        .activity:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 0 4px rgba(212,175,55,.14);
            flex-shrink: 0;
        }

        .chart-area {
            height: 280px;
            width: 100%;
        }

        @media (max-width: 1200px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .admin-mid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .management-sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@include('layouts.sidebar-management')

<main class="main">
    <div class="dashboard-container">

        <div class="topbar">
            <div class="topbar-left">
                <h1>Console Panel</h1>
                <p>Welcome back to core hotel operation hub</p>
            </div>

            <div class="topbar-right">
                <div class="user-pill">
                    <i class="fas fa-user-shield text-[#d4af37]"></i>
                    <span>{{ auth()->user()->name }}</span>
                </div>

                <div class="role-badge">
                    {{ auth()->user()->role }}
                </div>
            </div>
        </div>

        <div class="management-hero">
            <div class="hero-img-bg"></div>
            <div class="hero-overlay"></div>

            <div class="hero-title">
                <h2>Hotel Management Dashboard</h2>
                <p>Centralized control panel to coordinate rooms, reservations, payments, users, and hotel analytics.</p>
            </div>
        </div>

        <div class="cards-grid">
            <div class="stat-card">
                <div class="sc-icon-box">
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="sc-info">
                    <p>Total Rooms</p>
                    <div class="sc-val">{{ $totalRooms ?? 0 }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="sc-icon-box">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="sc-info">
                    <p>Total Reservations</p>
                    <div class="sc-val">{{ $totalReservations ?? 0 }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="sc-icon-box">
                    <i class="fas fa-users"></i>
                </div>
                <div class="sc-info">
                    <p>Registered Users</p>
                    <div class="sc-val">{{ $totalUsers ?? 0 }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="sc-icon-box">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="sc-info">
                    <p>Payments Captured</p>
                    <div class="sc-val">{{ $totalPayments ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="admin-mid">
            <div class="info-card">
                <div class="section-title">Recent Activities</div>

                <div class="activity">
                    <div class="activity-icon"></div>
                    <span>New reservation created</span>
                </div>

                <div class="activity">
                    <div class="activity-icon"></div>
                    <span>Payment received successfully</span>
                </div>

                <div class="activity">
                    <div class="activity-icon"></div>
                    <span>Guest checked in room asset</span>
                </div>
            </div>

            <div class="chart-card">
                <div class="section-title">Revenue Overview</div>

                <div class="chart-area">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('revenueChart');

    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    data: [8, 10, 12, 14, 18, 24, 20],
                    borderColor: '#d4af37',
                    backgroundColor: 'rgba(212, 175, 55, 0.08)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#d4af37'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#90a0b7' }
                    },
                    y: {
                        grid: { color: 'rgba(255,255,255,.04)' },
                        ticks: { color: '#90a0b7' }
                    }
                }
            }
        });
    }
</script>

</body>
</html>