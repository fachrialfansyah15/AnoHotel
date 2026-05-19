<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Detail - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --gold-dim: rgba(212,175,55,.08);
            --gold-border: rgba(212,175,55,.18);
            --bg: #041026;
            --surface: rgba(255,255,255,.04);
            --border: rgba(255,255,255,.08);
            --muted: #90a0b7;
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
            min-height: 260px;
            border-radius: 26px;
            overflow: hidden;
            border: 1px solid var(--gold-border);
            background: #030d20;
            padding: 2.8rem;
            margin-bottom: 1.5rem;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/Reservations.png') }}');
            background-size: cover;
            background-position: center;
            opacity: .55;
            transform: scale(1.03);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(4,16,38,.94), rgba(4,16,38,.62), rgba(4,16,38,.35));
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
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: .6rem;
        }

        .hero p {
            color: #c8d3e6;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.3fr .7fr;
            gap: 1.5rem;
        }

        .card {
            background: rgba(5,12,24,.82);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 22px;
            padding: 1.6rem;
            box-shadow: 0 18px 38px rgba(0,0,0,.25);
        }

        .card-title {
            font-family: 'Cinzel', serif;
            font-size: 1.3rem;
            color: #fff;
            padding-bottom: .9rem;
            border-bottom: 1px solid rgba(255,255,255,.07);
            margin-bottom: 1.3rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .label {
            color: var(--muted);
            font-size: .88rem;
        }

        .value {
            color: #fff;
            font-weight: 800;
            text-align: right;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .5rem .9rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 900;
            text-transform: capitalize;
        }

        .status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        .pending { background: rgba(245,158,11,.13); color: #fbbf24; }
        .pending::before { background: #fbbf24; }

        .confirmed { background: rgba(16,185,129,.13); color: #34d399; }
        .confirmed::before { background: #34d399; }

        .checked_in { background: rgba(59,130,246,.13); color: #60a5fa; }
        .checked_in::before { background: #60a5fa; }

        .checked_out { background: rgba(168,85,247,.13); color: #c084fc; }
        .checked_out::before { background: #c084fc; }

        .cancelled { background: rgba(239,68,68,.13); color: #f87171; }
        .cancelled::before { background: #f87171; }

        .guest-box {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .avatar {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(212,175,55,.35), rgba(212,175,55,.08));
            border: 1px solid var(--gold-border);
            color: var(--gold-light);
            display: grid;
            place-items: center;
            font-size: 1.4rem;
            font-weight: 900;
        }

        .guest-name {
            font-size: 1.2rem;
            font-weight: 900;
        }

        .guest-sub {
            color: var(--muted);
            font-size: .85rem;
            margin-top: .25rem;
        }

        .actions {
            display: flex;
            gap: .8rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .btn {
            border: 1px solid var(--border);
            background: rgba(255,255,255,.05);
            color: #fff;
            padding: .8rem 1.1rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 800;
            cursor: pointer;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #041026;
            border: none;
        }

        .btn-red {
            background: rgba(239,68,68,.12);
            color: #f87171;
            border-color: rgba(239,68,68,.22);
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@can('manage-reservations')
    @include('layouts.sidebar-management')
@else
    @include('layouts.sidebar-guest')
@endcan

<main class="main">

    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="eyebrow">Reservation Detail</div>

            <h1>
                Reservation #RES-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}
            </h1>

            <p>
                Detail informasi reservasi tamu, kamar, jadwal menginap, dan status booking.
            </p>
        </div>
    </section>

    <div class="content-grid">

        <div class="card">
            <div class="card-title">
                Booking Information
            </div>

            <div class="detail-row">
                <span class="label">Reservation ID</span>
                <span class="value">#RES-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Room</span>
                <span class="value">
                    Room #{{ $reservation->room->room_number ?? '-' }}
                    — {{ ucfirst($reservation->room->type ?? 'Room') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="label">Check In</span>
                <span class="value">{{ $reservation->check_in }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Check Out</span>
                <span class="value">{{ $reservation->check_out }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Total Guest</span>
                <span class="value">
                    {{ $reservation->total_guest ?? $reservation->guest_total ?? 1 }} Guest(s)
                </span>
            </div>

            <div class="detail-row">
                <span class="label">Status</span>
                <span class="value">
                    <span class="status {{ $reservation->status }}">
                        {{ str_replace('_', ' ', $reservation->status) }}
                    </span>
                </span>
            </div>

            <div class="detail-row">
                <span class="label">Notes</span>
                <span class="value">
                    {{ $reservation->notes ?? '-' }}
                </span>
            </div>
        </div>

        <div class="card">
            <div class="card-title">
                Guest Information
            </div>

            <div class="guest-box">
                <div class="avatar">
                    {{ strtoupper(substr($reservation->user->name ?? 'G', 0, 1)) }}
                </div>

                <div>
                    <div class="guest-name">
                        {{ $reservation->user->name ?? 'Guest' }}
                    </div>

                    <div class="guest-sub">
                        {{ $reservation->user->email ?? 'No email available' }}
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <span class="label">Room Price</span>
                <span class="value">
                    Rp {{ number_format($reservation->room->price_per_night ?? 0, 0, ',', '.') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="label">Room Capacity</span>
                <span class="value">
                    {{ $reservation->room->capacity ?? '-' }} Person
                </span>
            </div>

            <div class="actions">
                <a href="{{ route('reservations.index') }}" class="btn">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>

                @can('manage-reservations')
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-gold">
                        <i class="fas fa-pen"></i>
                        Edit
                    </a>

                    <form action="{{ route('reservations.destroy', $reservation->id) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this reservation?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-red">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>

    </div>

</main>

</body>
</html>