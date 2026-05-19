<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --gold-border: rgba(212,175,55,.18);
            --bg: #041026;
            --surface: rgba(5,12,24,.86);
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
            min-height: 230px;
            padding: 2.5rem;
            border-radius: 26px;
            overflow: hidden;
            border: 1px solid var(--gold-border);
            background: #030d20;
            margin-bottom: 1.5rem;
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
            font-size: 2.7rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }

        .hero p {
            color: #c8d3e6;
        }

        .form-card {
            max-width: 980px;
            background: var(--surface);
            border: 1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius: 26px;
            padding: 2rem;
            box-shadow: 0 18px 38px rgba(0,0,0,.28);
        }

        .form-title {
            font-family: 'Cinzel', serif;
            font-size: 1.4rem;
            margin-bottom: .4rem;
        }

        .form-subtitle {
            color: var(--muted);
            margin-bottom: 1.8rem;
            font-size: .9rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }

        .form-group.full {
            grid-column: span 2;
        }

        label {
            display: block;
            color: #cbd5e1;
            font-size: .9rem;
            font-weight: 800;
            margin-bottom: .6rem;
        }

        input,
        select,
        textarea {
            width: 100%;
            background: #020817;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 16px;
            color: white;
            padding: 1rem 1.2rem;
            outline: none;
            font-size: .95rem;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--gold);
        }

        textarea {
            resize: none;
            min-height: 140px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.8rem;
        }

        .btn {
            border: none;
            border-radius: 16px;
            padding: .95rem 1.5rem;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .6rem;
        }

        .btn-back {
            background: rgba(255,255,255,.06);
            color: #cbd5e1;
            border: 1px solid rgba(255,255,255,.10);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #041026;
        }

        @media (max-width: 768px) {
            .main {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: span 1;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
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
            <div class="eyebrow">Reservation Management</div>

            <h1>Edit Reservation</h1>

            <p>
                Update guest booking, room schedule, status, and additional reservation notes.
            </p>
        </div>
    </section>

    <section class="form-card">

        <h2 class="form-title">
            Reservation Form
        </h2>

        <p class="form-subtitle">
            Make sure all reservation information matches the guest booking data.
        </p>

        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group full">
                    <label>Room</label>

                    <select name="room_id" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}"
                                {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                                Room #{{ $room->room_number ?? $room->name }} - {{ ucfirst($room->type ?? 'Room') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Check In</label>

                    <input type="date"
                           name="check_in"
                           value="{{ old('check_in', $reservation->check_in) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Check Out</label>

                    <input type="date"
                           name="check_out"
                           value="{{ old('check_out', $reservation->check_out) }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Total Guest</label>

                    <input type="number"
                           name="total_guest"
                           value="{{ old('total_guest', $reservation->total_guest ?? $reservation->guest_total) }}"
                           min="1"
                           required>
                </div>

                <div class="form-group">
                    <label>Status</label>

                    <select name="status" required>
                        <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="checked_in" {{ $reservation->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                        <option value="checked_out" {{ $reservation->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                        <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label>Notes</label>

                    <textarea name="notes">{{ old('notes', $reservation->notes) }}</textarea>
                </div>

            </div>

            <div class="actions">
                <a href="{{ route('reservations.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>

                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-save"></i>
                    Update Reservation
                </button>
            </div>
        </form>

    </section>

</main>

</body>
</html>