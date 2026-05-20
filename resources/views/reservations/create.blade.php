<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room - AnoHotel Luxury</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --gold-dark: #aa8625;
            --bg-gradient: linear-gradient(135deg, #041026 0%, #08172f 50%, #0d2347 100%);
            --surface: rgba(255, 255, 255, 0.03);
            --border-light: rgba(255, 255, 255, 0.08);
            --text-primary: #ffffff;
            --text-secondary: #90a0b7;
        }

        body {
            color: var(--text-primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .booking-card {
            background: rgba(3, 13, 32, 0.65);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-light);
            border-radius: 20px;
            width: 100%;
            max-width: 650px;
            padding: 2.5rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            position: relative;
            overflow: hidden;
        }

        .booking-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light), var(--gold-dark));
        }

        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .form-header h2 {
            font-family: 'Cinzel', serif;
            font-size: 2rem;
            color: var(--gold);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: #dbe3ee;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            background: rgba(0,0,0,0.2);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
            color: #fff;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--gold);
        }

        .form-group select option {
            background: #08172f;
            color: #fff;
        }

        .btn-submit {
            grid-column: span 2;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #041026;
            border: none;
            padding: 1.1rem;
            border-radius: 12px;
            font-weight: 800;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            transition: transform 0.2s, filter 0.2s;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }

        .back-link {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--gold);
        }

        /* Error styling */
        .error-msg {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.3rem;
            display: block;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group.full {
                grid-column: span 1;
            }
            .btn-submit {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

    <div class="booking-card">
        @if(auth()->user()->role === 'guest')
            <a href="{{ route('reservations.my') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        @else
            <a href="{{ route('reservations.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        @endif

        <div class="form-header">
            <h2>Book Your Stay</h2>
            <p>Complete the form below to secure your luxury experience</p>
        </div>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                
                <!-- Room Selection -->
                <div class="form-group full">
                    <label for="room_id"><i class="fas fa-bed mr-2"></i> Select Room</label>
                    <select name="room_id" id="room_id" required>
                        <option value="">-- Choose a available room --</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                Room {{ $room->room_number }} - {{ ucfirst($room->type) }} (Rp {{ number_format($room->price_per_night, 0, ',', '.') }} / night)
                            </option>
                        @endforeach
                    </select>
                    @error('room_id') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <!-- Check In -->
                <div class="form-group">
                    <label for="check_in"><i class="fas fa-calendar-alt mr-2"></i> Check-in Date</label>
                    <input type="date" name="check_in" id="check_in" value="{{ old('check_in') }}" required>
                    @error('check_in') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <!-- Check Out -->
                <div class="form-group">
                    <label for="check_out"><i class="fas fa-calendar-check mr-2"></i> Check-out Date</label>
                    <input type="date" name="check_out" id="check_out" value="{{ old('check_out') }}" required>
                    @error('check_out') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <!-- Guests -->
                <div class="form-group full">
                    <label for="total_guest"><i class="fas fa-users mr-2"></i> Number of Guests</label>
                    <input type="number" name="total_guest" id="total_guest" min="1" placeholder="e.g. 2" value="{{ old('total_guest', 1) }}" required>
                    @error('total_guest') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <!-- Notes -->
                <div class="form-group full">
                    <label for="notes"><i class="fas fa-comment-alt mr-2"></i> Special Requests (Optional)</label>
                    <textarea name="notes" id="notes" rows="3" placeholder="Any special needs or preferences?">{{ old('notes') }}</textarea>
                    @error('notes') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn-submit">
                    Confirm Reservation
                </button>
            </div>
        </form>

    </div>

</body>
</html>
