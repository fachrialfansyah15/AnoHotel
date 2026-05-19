<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --gold-dark: #aa8625;
            --gold-dim: rgba(212,175,55,.08);
            --gold-border: rgba(212,175,55,.18);
            --bg: #041026;
            --surface: rgba(255,255,255,.04);
            --surface-hover: rgba(255,255,255,.07);
            --border: rgba(255,255,255,.08);
            --text: #fff;
            --muted: #90a0b7;
            --soft: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --purple: #a855f7;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #041026 0%, #08172f 50%, #0d2347 100%);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .hero {
            position: relative;
            min-height: 230px;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid var(--gold-border);
            background: #030d20;
            padding: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 14px 40px rgba(0,0,0,.25);
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
            background: linear-gradient(90deg, rgba(4,16,38,.93), rgba(4,16,38,.62), rgba(4,16,38,.35));
        }

        .hero-content,
        .hero-action {
            position: relative;
            z-index: 2;
        }

        .eyebrow {
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: .25em;
            font-size: .7rem;
            font-weight: 800;
            margin-bottom: .8rem;
        }

        .hero h1 {
            font-family: 'Cinzel', serif;
            font-size: 2.6rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }

        .hero p {
            color: #c8d3e6;
            font-size: .95rem;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #041026;
            padding: .9rem 1.5rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            box-shadow: 0 12px 28px rgba(212,175,55,.25);
            transition: .2s;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-top: -4rem;
            position: relative;
            z-index: 4;
        }

        .stat-card {
            background: rgba(10,18,32,.82);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 18px;
            padding: 1.3rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 12px 28px rgba(0,0,0,.22);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border);
            display: grid;
            place-items: center;
            color: var(--gold);
            font-size: 1.1rem;
        }

        .stat-value {
            font-size: 1.7rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .stat-label {
            color: var(--muted);
            font-size: .78rem;
            margin-top: .3rem;
        }

        .panel {
            background: rgba(5,12,24,.82);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 18px 38px rgba(0,0,0,.25);
        }

        .panel-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .panel-title h2 {
            font-family: 'Cinzel', serif;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .panel-title p {
            color: var(--muted);
            font-size: .82rem;
            margin-top: .25rem;
        }

        .count-badge {
            background: var(--gold-dim);
            border: 1px solid var(--gold-border);
            color: var(--gold-light);
            padding: .55rem .9rem;
            border-radius: 12px;
            font-size: .82rem;
            font-weight: 800;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(255,255,255,.055);
        }

        th {
            text-align: left;
            padding: 1rem 1.5rem;
            color: #cbd5e1;
            font-size: .75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        td {
            padding: 1.1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,.06);
            color: #f8fafc;
            font-size: .88rem;
            vertical-align: middle;
        }

        tr:hover {
            background: rgba(255,255,255,.025);
        }

        .guest-cell {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .avatar {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(212,175,55,.32), rgba(212,175,55,.08));
            border: 1px solid var(--gold-border);
            display: grid;
            place-items: center;
            color: var(--gold-light);
            font-weight: 900;
        }

        .guest-name {
            font-weight: 800;
            color: #fff;
        }

        .guest-sub {
            color: var(--muted);
            font-size: .75rem;
            margin-top: .2rem;
        }

        .room-text {
            font-weight: 700;
            color: var(--gold-light);
        }

        .date-text {
            color: #cbd5e1;
            font-weight: 600;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .45rem .8rem;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 900;
            text-transform: capitalize;
        }

        .status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        .pending {
            background: rgba(245,158,11,.13);
            color: #fbbf24;
        }

        .pending::before { background: #fbbf24; }

        .confirmed {
            background: rgba(16,185,129,.13);
            color: #34d399;
        }

        .confirmed::before { background: #34d399; }

        .checked_in {
            background: rgba(59,130,246,.13);
            color: #60a5fa;
        }

        .checked_in::before { background: #60a5fa; }

        .checked_out {
            background: rgba(168,85,247,.13);
            color: #c084fc;
        }

        .checked_out::before { background: #c084fc; }

        .cancelled {
            background: rgba(239,68,68,.13);
            color: #f87171;
        }

        .cancelled::before { background: #f87171; }

        .actions {
            display: flex;
            gap: .6rem;
            align-items: center;
        }

        .btn-action {
            border: 1px solid var(--border);
            background: rgba(255,255,255,.05);
            color: #fff;
            padding: .65rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            font-size: .8rem;
            font-weight: 800;
            transition: .2s;
        }

        .btn-action:hover {
            background: var(--gold-dim);
            border-color: var(--gold-border);
        }

        .btn-edit {
            color: var(--gold-light);
            border-color: rgba(212,175,55,.24);
        }

        .empty {
            text-align: center;
            padding: 4rem 1rem;
            color: var(--muted);
        }

        .empty-icon {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
            display: grid;
            place-items: center;
            margin: 0 auto 1rem;
            color: var(--gold);
            font-size: 1.8rem;
        }

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .hero {
                flex-direction: column;
                gap: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                margin-top: -2rem;
            }

            .modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(0, 0, 0, 0.78);
    backdrop-filter: blur(12px);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.modal-overlay.show {
    display: flex;
}

.reservation-modal {
    width: 100%;
    max-width: 980px;
    background: #111827;
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 30px 90px rgba(0,0,0,.6);
}

.modal-head {
    padding: 2rem 2.5rem;
    border-bottom: 1px solid rgba(255,255,255,.08);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.modal-head h2 {
    font-size: 2.6rem;
    font-weight: 900;
    color: #fff;
    line-height: 1;
}

.modal-head p {
    color: #94a3b8;
    margin-top: .7rem;
    font-size: 1rem;
}

.modal-close {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,.08);
    background: rgba(255,255,255,.06);
    color: #cbd5e1;
    font-size: 1.4rem;
    cursor: pointer;
}

.modal-body {
    padding: 2.5rem;
}

.modal-group {
    margin-bottom: 1.4rem;
}

.modal-group label {
    display: block;
    margin-bottom: .6rem;
    color: #cbd5e1;
    font-weight: 700;
    font-size: .95rem;
}

.modal-group input,
.modal-group select,
.modal-group textarea {
    width: 100%;
    height: 58px;
    background: #020817;
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px;
    color: #fff;
    padding: 0 1.2rem;
    font-size: 1rem;
    outline: none;
}

.modal-group textarea {
    height: 150px;
    padding: 1rem 1.2rem;
    resize: none;
}

.modal-group input:focus,
.modal-group select:focus,
.modal-group textarea:focus {
    border-color: #d4af37;
}

.modal-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.2rem;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding-top: 1rem;
}

.modal-cancel,
.modal-submit {
    height: 54px;
    padding: 0 1.8rem;
    border-radius: 16px;
    font-weight: 800;
    cursor: pointer;
    border: none;
    font-size: 1rem;
}

.modal-cancel {
    background: rgba(255,255,255,.06);
    color: #cbd5e1;
    border: 1px solid rgba(255,255,255,.1);
}

.modal-submit {
    background: linear-gradient(135deg, #facc15, #d4af37);
    color: #041026;
}

@media (max-width: 768px) {
    .reservation-modal {
        max-width: 100%;
    }

    .modal-grid {
        grid-template-columns: 1fr;
    }

    .modal-head h2 {
        font-size: 2rem;
    }
}
        }
        
.modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(0,0,0,.78);
    backdrop-filter: blur(12px);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.modal-overlay.show {
    display: flex;
}

.reservation-modal {
    width: 100%;
    max-width: 980px;
    background: #111827;
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 30px 90px rgba(0,0,0,.6);
}

.modal-head {
    padding: 2rem 2.5rem;
    border-bottom: 1px solid rgba(255,255,255,.08);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.modal-head h2 {
    font-size: 2.6rem;
    font-weight: 900;
    color: #fff;
    line-height: 1;
}

.modal-head p {
    color: #94a3b8;
    margin-top: .7rem;
}

.modal-close {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,.08);
    background: rgba(255,255,255,.06);
    color: #cbd5e1;
    font-size: 1.3rem;
    cursor: pointer;
}

.modal-body {
    padding: 2.5rem;
}

.modal-group {
    margin-bottom: 1.4rem;
}

.modal-group label {
    display: block;
    margin-bottom: .6rem;
    color: #cbd5e1;
    font-weight: 700;
}

.modal-group input,
.modal-group select,
.modal-group textarea {
    width: 100%;
    height: 58px;
    background: #020817;
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px;
    color: #fff;
    padding: 0 1.2rem;
    font-size: 1rem;
    outline: none;
}

.modal-group textarea {
    height: 150px;
    padding: 1rem 1.2rem;
    resize: none;
}

.modal-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.2rem;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.modal-cancel,
.modal-submit {
    height: 54px;
    padding: 0 1.8rem;
    border-radius: 16px;
    font-weight: 800;
    cursor: pointer;
    border: none;
}

.modal-cancel {
    background: rgba(255,255,255,.06);
    color: #cbd5e1;
    border: 1px solid rgba(255,255,255,.1);
}

.modal-submit {
    background: linear-gradient(135deg, #facc15, #d4af37);
    color: #041026;
}

@media (max-width: 768px) {
    .reservation-modal {
        max-width: 100%;
    }

    .modal-grid {
        grid-template-columns: 1fr;
    }

    .modal-head h2 {
        font-size: 2rem;
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
    <div class="container">

        <section class="hero">
            <div class="hero-bg"></div>
            <div class="hero-overlay"></div>

            <div class="hero-content">
                <div class="eyebrow">Hotel Management</div>
                <h1>Reservations</h1>
                <p>Manage guest bookings, stay schedules, and hotel reservation activity.</p>
            </div>

            @can('create-reservation')
                <div class="hero-action">
                   <button type="button" class="btn-gold" id="openReservationModalBtn">
    <i class="fas fa-plus"></i>
    Create Reservation
</button>
                </div>
            @endcan
        </section>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                <div>
                    <div class="stat-value">{{ $reservations->count() }}</div>
                    <div class="stat-label">Total Reservations</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                <div>
                    <div class="stat-value">{{ $reservations->where('status', 'pending')->count() }}</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-circle-check"></i></div>
                <div>
                    <div class="stat-value">{{ $reservations->where('status', 'confirmed')->count() }}</div>
                    <div class="stat-label">Confirmed</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-door-open"></i></div>
                <div>
                    <div class="stat-value">{{ $reservations->where('status', 'checked_in')->count() }}</div>
                    <div class="stat-label">Checked In</div>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-header">
                <div class="panel-title">
                    <h2>Reservation List</h2>
                    <p>Latest reservation activity from backend database</p>
                </div>

                <div class="count-badge">
                    {{ $reservations->count() }} Reservations
                </div>
            </div>

            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr>
                            <th>Guest</th>
                            <th>Room</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reservations as $reservation)
                            <tr>
                                <td>
                                    <div class="guest-cell">
                                        <div class="avatar">
                                            {{ strtoupper(substr($reservation->user->name ?? 'G', 0, 1)) }}
                                        </div>

                                        <div>
                                            <div class="guest-name">
                                                {{ $reservation->user->name ?? 'Guest' }}
                                            </div>

                                            <div class="guest-sub">
                                                {{ $reservation->total_guest ?? 1 }} Guest(s)
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="room-text">
                                        Room #{{ $reservation->room->room_number ?? '-' }}
                                    </span>
                                </td>

                                <td class="date-text">
                                    {{ $reservation->check_in }}
                                </td>

                                <td class="date-text">
                                    {{ $reservation->check_out }}
                                </td>

                                <td>
                                    <span class="status {{ $reservation->status }}">
                                        {{ str_replace('_', ' ', $reservation->status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a href="{{ route('reservations.show', $reservation->id) }}"
                                           class="btn-action">
                                            View
                                        </a>

                                        @can('manage-reservations')
                                            <button type="button"
        class="btn-action btn-edit"
        onclick="openEditReservationModal(
            '{{ $reservation->id }}',
            '{{ $reservation->room_id }}',
            '{{ $reservation->check_in }}',
            '{{ $reservation->check_out }}',
            '{{ $reservation->total_guest ?? $reservation->guest_total ?? 1 }}',
            '{{ $reservation->status }}',
            `{{ $reservation->notes ?? '' }}`
        )">
    Edit
</button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty">
                                        <div class="empty-icon">
                                            <i class="fas fa-hotel"></i>
                                        </div>

                                        <h3>No Reservations Found</h3>
                                        <p>Reservation data will appear here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</main>

<!-- MODAL -->
<div id="reservationModal" class="modal-overlay">
    <div class="reservation-modal">

        <div class="modal-head">
            <div>
                <h2>Create Reservation</h2>
                <p>Add new hotel reservation</p>
            </div>

            <button type="button" class="modal-close" onclick="closeReservationModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('reservations.store') }}" method="POST" class="modal-body">
            @csrf

            <div class="modal-group">
                <label>Room</label>
                <select name="room_id" required>
                    <option value="">Select Room</option>

                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">
                            Room #{{ $room->room_number }} - {{ ucfirst($room->type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="modal-grid">
                <div class="modal-group">
                    <label>Check In</label>
                    <input type="date" name="check_in" required>
                </div>

                <div class="modal-group">
                    <label>Check Out</label>
                    <input type="date" name="check_out" required>
                </div>
            </div>

            <div class="modal-group">
                <label>Total Guest</label>
                <input type="number" name="total_guest" min="1" placeholder="Example: 2" required>
            </div>

            <div class="modal-group">
                <label>Notes</label>
                <textarea name="notes" placeholder="Additional reservation notes..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="modal-cancel" onclick="closeReservationModal()">
                    Cancel
                </button>

                <button type="submit" class="modal-submit">
                    Save Reservation
                </button>
            </div>
        </form>

    </div>
</div>

<div id="editReservationModal" class="modal-overlay">
    <div class="reservation-modal">

        <div class="modal-head">
            <div>
                <h2>Edit Reservation</h2>
                <p>Update hotel reservation data</p>
            </div>

            <button type="button" class="modal-close" onclick="closeEditReservationModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="editReservationForm" method="POST" class="modal-body">
            @csrf
            @method('PUT')

            <div class="modal-group">
                <label>Room</label>
                <select id="edit_room_id" name="room_id" required>
                    <option value="">Select Room</option>

                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">
                            Room #{{ $room->room_number }} - {{ ucfirst($room->type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="modal-grid">
                <div class="modal-group">
                    <label>Check In</label>
                    <input type="date" id="edit_check_in" name="check_in" required>
                </div>

                <div class="modal-group">
                    <label>Check Out</label>
                    <input type="date" id="edit_check_out" name="check_out" required>
                </div>
            </div>

            <div class="modal-grid">
                <div class="modal-group">
                    <label>Total Guest</label>
                    <input type="number" id="edit_total_guest" name="total_guest" min="1" required>
                </div>

                <div class="modal-group">
                    <label>Status</label>
                    <select id="edit_status" name="status" required>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="checked_in">Checked In</option>
                        <option value="checked_out">Checked Out</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="modal-group">
                <label>Notes</label>
                <textarea id="edit_notes" name="notes" placeholder="Additional reservation notes..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="modal-cancel" onclick="closeEditReservationModal()">
                    Cancel
                </button>

                <button type="submit" class="modal-submit">
                    Update Reservation
                </button>
            </div>
        </form>

    </div>
</div>


<script>
    const reservationModal = document.getElementById('reservationModal');
    const openReservationModalBtn = document.getElementById('openReservationModalBtn');

    if (openReservationModalBtn) {
        openReservationModalBtn.addEventListener('click', function () {
            reservationModal.classList.add('show');
        });
    }

    function closeReservationModal() {
        reservationModal.classList.remove('show');
    }

    function openEditReservationModal(id, roomId, checkIn, checkOut, totalGuest, status, notes) {
        const editModal = document.getElementById('editReservationModal');
        const editForm = document.getElementById('editReservationForm');

        editForm.action = `/reservations/${id}`;

        document.getElementById('edit_room_id').value = roomId;
        document.getElementById('edit_check_in').value = checkIn;
        document.getElementById('edit_check_out').value = checkOut;
        document.getElementById('edit_total_guest').value = totalGuest;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_notes').value = notes ?? '';

        editModal.classList.add('show');
    }

    function closeEditReservationModal() {
        document.getElementById('editReservationModal').classList.remove('show');
    }
</script>


</body>
</html>