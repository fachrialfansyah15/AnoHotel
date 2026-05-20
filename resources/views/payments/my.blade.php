{{-- resources/views/payments/my-payments.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Payments - AnoHotel Luxury</title>

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

        /* MAIN */
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
        .payments-hero {
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
            background-image: url('{{ asset('images/Payments.png') }}');
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

        .title {
            position: relative;
            z-index: 2;
        }

        .title h2 {
            font-family: 'Cinzel', serif;
            font-size: 2.2rem;
            font-weight: 600;
            color: #fff;
        }

        .title p {
            color: #c8d3e6;
            font-size: 0.92rem;
            margin-top: 0.5rem;
        }

        /* STATS */
        .payments-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            width: 100%;
        }

        .mini-stat-card {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-light);
            border-radius: var(--r-md);
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .ms-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border-light);
            display: grid;
            place-items: center;
            font-size: 1.1rem;
            color: var(--gold);
            flex-shrink: 0;
        }

        .ms-info p {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .ms-info h4 {
            font-family: 'Cinzel', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: #fff;
            margin-top: 2px;
        }

        /* CONTROLS */
        .controls-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            gap: 1rem;
        }

        .search-wrapper {
            position: relative;
            flex: 1;
            max-width: 360px;
        }

        .search-wrapper input {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--border-light);
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border-radius: var(--r-sm);
            color: #fff;
            font-size: 0.85rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-wrapper input:focus {
            border-color: var(--gold);
        }

        .search-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .filters-group {
            display: flex;
            gap: 0.75rem;
        }

        .filter-select {
            background: var(--surface);
            border: 1px solid var(--border-light);
            color: var(--text-secondary);
            padding: 0.75rem 1.5rem 0.75rem 1rem;
            border-radius: var(--r-sm);
            font-size: 0.85rem;
            outline: none;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: var(--gold);
            color: #fff;
        }

        /* TABLE */
        .table-card {
            background: var(--surface);
            backdrop-filter: blur(10px);
            border-radius: var(--r-lg);
            overflow: hidden;
            border: 1px solid var(--border-light);
            width: 100%;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid var(--border-light);
        }

        th {
            padding: 1.1rem 1.5rem;
            color: var(--text-secondary);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        td {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.03);
            font-size: 0.88rem;
            color: #e2e8f0;
            vertical-align: middle;
        }

        tr:hover {
            background: rgba(255,255,255,0.01);
        }

        .payment-id-text {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            color: #fff;
        }

        .payment-amount-text {
            font-weight: 600;
            color: var(--gold-light);
        }

        .payment-method-text {
            font-weight: 500;
            color: #f1f5f9;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .badge {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge.success,
        .badge.paid,
        .badge.settled {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .badge.pending,
        .badge.unpaid {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            color: var(--warning);
        }

        .badge.failed,
        .badge.cancelled {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--danger);
        }

        .action-icon-btn {
            color: var(--text-muted);
            font-size: 0.95rem;
            transition: color 0.2s;
            text-decoration: none;
        }

        .action-icon-btn:hover {
            color: var(--gold);
        }

        @media (max-width: 1200px) {
            .payments-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .controls-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-wrapper {
                max-width: 100%;
                width: 100%;
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

            .payments-stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@include('layouts.sidebar-guest')

<main class="main">
    <div class="dashboard-container">

        <div class="payments-hero">
            <div class="hero-img-bg"></div>
            <div class="hero-overlay"></div>

            <div class="title">
                <h2>My Payments</h2>
                <p>Track your payment history, invoices, and transaction status</p>
            </div>
        </div>

        <div class="payments-stats-grid">
            <div class="mini-stat-card">
                <div class="ms-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="ms-info">
                    <p>Total Paid</p>
                    <h4>
                        Rp {{ number_format($payments->whereIn('status', ['success', 'paid', 'settled'])->sum('amount'), 0, ',', '.') }}
                    </h4>
                </div>
            </div>

            <div class="mini-stat-card">
                <div class="ms-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="ms-info">
                    <p>Paid Invoices</p>
                    <h4>{{ $payments->whereIn('status', ['success', 'paid', 'settled'])->count() }}</h4>
                </div>
            </div>

            <div class="mini-stat-card">
                <div class="ms-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="ms-info">
                    <p>Pending Payments</p>
                    <h4>{{ $payments->whereIn('status', ['pending', 'unpaid'])->count() }}</h4>
                </div>
            </div>

            <div class="mini-stat-card">
                <div class="ms-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <div class="ms-info">
                    <p>Total Transactions</p>
                    <h4>{{ $payments->count() }}</h4>
                </div>
            </div>
        </div>

        <div class="controls-bar">
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search payment by reservation ID...">
            </div>

            <div class="filters-group">
                <select class="filter-select">
                    <option value="">All Methods</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="e_wallet">E-Wallet</option>
                    <option value="cash">Cash</option>
                </select>

                <select class="filter-select">
                    <option value="">All Statuses</option>
                    <option value="success">Success</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>Reservation</th>
                        <th>Amount Paid</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th style="width: 60px;"></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td class="payment-id-text">
                                <i class="fas fa-hashtag text-xs text-slate-500 mr-1"></i>
                                {{ $payment->reservation_id }}
                            </td>

                            <td class="payment-amount-text">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>

                            <td class="payment-method-text capitalize">
                                @if(str_contains(strtolower($payment->method), 'card'))
                                    <i class="far fa-credit-card text-sky-400 text-xs"></i>
                                @elseif(str_contains(strtolower($payment->method), 'transfer'))
                                    <i class="fas fa-university text-amber-400 text-xs"></i>
                                @elseif(str_contains(strtolower($payment->method), 'wallet'))
                                    <i class="fas fa-wallet text-emerald-400 text-xs"></i>
                                @else
                                    <i class="fas fa-money-check text-emerald-400 text-xs"></i>
                                @endif

                                {{ ucwords(str_replace('_', ' ', $payment->method)) }}
                            </td>

                            <td>
                                <span class="badge {{ strtolower($payment->status) }}">
                                    {{ ucwords(str_replace('_', ' ', $payment->status)) }}
                                </span>
                            </td>

                            <td>
                                @if(strtolower($payment->status) === 'unpaid' || strtolower($payment->status) === 'pending')
                                    <form action="{{ route('payments.pay', $payment->id) }}" method="POST" onsubmit="return confirm('Proses pembayaran ini? (Simulasi)')">
                                        @csrf
                                        <button type="submit" style="background: linear-gradient(135deg, var(--gold-light), var(--gold)); color: #041026; padding: 0.45rem 1rem; border-radius: 6px; font-weight: 700; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 10px rgba(212,175,55,0.2);">
                                            <i class="fas fa-credit-card"></i> Pay Now
                                        </button>
                                    </form>
                                @else
                                    <a href="#" class="action-icon-btn" title="View Invoice Receipt">
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--text-secondary); padding: 3rem 0;">
                                <i class="fas fa-comment-slash text-2xl block mb-2 opacity-50 text-amber-500"></i>
                                No payment transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</main>

<script>
// Filter Payment Logic
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-wrapper input');
    const selects = document.querySelectorAll('.filter-select');
    if (!searchInput || selects.length < 2) return;

    const tbody = document.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    function filterPayments() {
        const query = searchInput.value.toLowerCase();
        const methodFilter = selects[0].value.toLowerCase();
        const statusFilter = selects[1].value.toLowerCase();

        rows.forEach(row => {
            if (row.children.length === 1) return; // empty state row

            const text = row.innerText.toLowerCase();
            const methodText = row.children[2].innerText.toLowerCase();
            const statusText = row.querySelector('.badge') ? row.querySelector('.badge').innerText.toLowerCase() : '';

            const matchSearch = text.includes(query);
            const matchMethod = !methodFilter || methodText.includes(methodFilter.replace('_', ' '));
            const matchStatus = !statusFilter || statusText === statusFilter;

            if (matchSearch && matchMethod && matchStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterPayments);
    selects.forEach(s => s.addEventListener('change', filterPayments));
});
</script>

</body>
</html>