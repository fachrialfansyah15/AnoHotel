<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Detail - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: #f8fafc;
            color: #0f172a;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .page {
            max-width: 1500px;
            margin: 0 auto;
            padding: 2rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            color: #64748b;
            text-decoration: none;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1.35fr .9fr;
            gap: 2.5rem;
            align-items: center;
        }

        .gallery-card {
            position: relative;
            height: 540px;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(15,23,42,.12);
        }

        .main-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-badge {
            position: absolute;
            top: 2rem;
            left: 2rem;
            background: rgba(255,255,255,.72);
            border: 1px solid rgba(212,175,55,.45);
            color: #d4af37;
            padding: .8rem 1.3rem;
            border-radius: 999px;
            font-weight: 700;
            backdrop-filter: blur(12px);
        }

        .status-badge {
            position: absolute;
            top: 2rem;
            right: 2rem;
            padding: .75rem 1.2rem;
            border-radius: 14px;
            font-weight: 800;
            backdrop-filter: blur(12px);
        }

        .available {
            background: rgba(34,197,94,.22);
            border: 1px solid rgba(34,197,94,.35);
            color: #22c55e;
        }

        .occupied {
            background: rgba(239,68,68,.20);
            border: 1px solid rgba(239,68,68,.35);
            color: #ef4444;
        }

        .maintenance {
            background: rgba(245,158,11,.22);
            border: 1px solid rgba(245,158,11,.35);
            color: #f59e0b;
        }

        .arrow-btn {
            position: absolute;
            top: 52%;
            transform: translateY(-50%);
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #0f172a;
            color: #d4af37;
            display: grid;
            place-items: center;
            border: 1px solid rgba(212,175,55,.5);
        }

        .arrow-left { left: 2rem; }
        .arrow-right { right: 2rem; }

        .thumbs {
            position: absolute;
            bottom: 1.2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: .8rem;
        }

        .thumbs img {
            width: 130px;
            height: 82px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid rgba(255,255,255,.85);
        }

        .thumbs img.active {
            border-color: #d4af37;
        }

        .details-panel {
            padding: 1rem;
        }

        .eyebrow {
            color: #d4af37;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: .04em;
            margin-bottom: 1.4rem;
        }

        .details-panel h1 {
            font-size: 3.4rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1.4rem;
        }

        .desc {
            color: #64748b;
            font-size: 1.15rem;
            line-height: 1.9;
            max-width: 600px;
            margin-bottom: 2.4rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }

        .info-box {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 1.7rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            box-shadow: 0 10px 28px rgba(15,23,42,.04);
        }

        .info-icon {
            color: #d4af37;
            font-size: 1.4rem;
            width: 32px;
            text-align: center;
        }

        .info-label {
            color: #64748b;
            font-size: .9rem;
            font-weight: 700;
            margin-bottom: .35rem;
        }

        .info-value {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
        }

        .section {
            margin-top: 4rem;
        }

        .section h2 {
            font-size: 1.7rem;
            font-weight: 800;
            margin-bottom: 2rem;
        }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.6rem;
        }

        .facility-card {
            background: linear-gradient(135deg, #020b1c, #061936);
            color: white;
            border-radius: 16px;
            padding: 2rem;
            min-height: 185px;
            box-shadow: 0 14px 30px rgba(15,23,42,.18);
        }

        .facility-card i {
            color: #d4af37;
            font-size: 2rem;
            margin-bottom: 1.2rem;
        }

        .facility-card h3 {
            font-size: 1.05rem;
            margin-bottom: 1rem;
        }

        .facility-card p {
            color: #cbd5e1;
            line-height: 1.8;
            font-size: .95rem;
        }

        .bottom-actions {
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .bottom-actions p {
            color: #64748b;
            line-height: 1.7;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            border: none;
            border-radius: 14px;
            padding: 1rem 3rem;
            text-decoration: none;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .7rem;
        }

        .btn-edit {
            background: linear-gradient(135deg, #facc15, #d4af37);
            color: #020b1c;
        }

        .btn-delete {
            background: #fecaca;
            color: #dc2626;
        }

        @media (max-width: 1100px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .facility-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .bottom-actions {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 1rem;
            }

            .gallery-card {
                height: 380px;
            }

            .thumbs img {
                width: 75px;
                height: 55px;
            }

            .details-panel h1 {
                font-size: 2.4rem;
            }

            .info-grid,
            .facility-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                width: 100%;
                flex-direction: column;
            }

            .btn {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <a href="{{ route('rooms.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Back to Rooms
    </a>

    <div class="detail-grid">

        <div class="gallery-card">
            <img src="{{ asset('images/Rooms.png') }}" class="main-image" alt="Room Image">

            <div class="image-badge">
                <i class="fas fa-star mr-2"></i>
                Premium Luxury Room
            </div>

            @if($room->status === 'available')
                <div class="status-badge available">
                    <i class="fas fa-circle mr-2 text-xs"></i>
                    Available
                </div>
            @elseif($room->status === 'occupied')
                <div class="status-badge occupied">
                    <i class="fas fa-circle mr-2 text-xs"></i>
                    Occupied
                </div>
            @else
                <div class="status-badge maintenance">
                    <i class="fas fa-wrench mr-2"></i>
                    Maintenance
                </div>
            @endif

            <div class="arrow-btn arrow-left">
                <i class="fas fa-chevron-left"></i>
            </div>

            <div class="arrow-btn arrow-right">
                <i class="fas fa-chevron-right"></i>
            </div>

            <div class="thumbs">
                <img src="{{ asset('images/Rooms.png') }}" class="active" alt="Room">
                <img src="{{ asset('images/Room1.jpg') }}" alt="Room">
                <img src="{{ asset('images/Room2.jpg') }}" alt="Room">
                <img src="{{ asset('images/Room3.png') }}" alt="Room">
            </div>
        </div>

        <div class="details-panel">
            <div class="eyebrow">Room Details</div>

            <h1>{{ ucfirst($room->type) }} Room</h1>

            <p class="desc">
                {{ $room->description ?? 'Luxury modern room with elegant design, premium facilities, and a comfortable experience.' }}
            </p>

            <div class="info-grid">
                <div class="info-box">
                    <div class="info-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <div class="info-label">Price / Night</div>
                        <div class="info-value">
                            Rp {{ number_format($room->price_per_night ?? $room->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="info-label">Capacity</div>
                        <div class="info-value">
                            {{ $room->capacity }} Guests
                        </div>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div>
                        <div class="info-label">Room Number</div>
                        <div class="info-value">
                            #{{ $room->room_number }}
                        </div>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div>
                        <div class="info-label">Room Type</div>
                        <div class="info-value">
                            {{ ucfirst($room->type) }} Room
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="section">
        <h2>Room Facilities</h2>

        <div class="facility-grid">
            <div class="facility-card">
                <i class="fas fa-wifi"></i>
                <h3>Free WiFi</h3>
                <p>High-speed internet access throughout your stay.</p>
            </div>

            <div class="facility-card">
                <i class="fas fa-tv"></i>
                <h3>Smart TV</h3>
                <p>Enjoy a wide range of channels and streaming services.</p>
            </div>

            <div class="facility-card">
                <i class="fas fa-snowflake"></i>
                <h3>Air Conditioner</h3>
                <p>Adjustable AC for your perfect comfort.</p>
            </div>

            <div class="facility-card">
                <i class="fas fa-bath"></i>
                <h3>Luxury Bathroom</h3>
                <p>Modern bathroom with premium amenities.</p>
            </div>
        </div>
    </div>

    @if(auth()->check() && auth()->user()->role === 'guest' && $room->status === 'available')
        <div class="bottom-actions">
            <p>
                Tertarik dengan kamar ini? Pesan sekarang untuk mengamankan kamar impian Anda.
            </p>

            <div class="action-buttons">
                <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}" class="btn btn-edit">
                    <i class="fas fa-calendar-plus"></i>
                    Book This Room
                </a>
            </div>
        </div>
    @elseif(auth()->check() && auth()->user()->role === 'guest' && $room->status !== 'available')
        <div class="bottom-actions">
            <p>
                Mohon maaf, kamar ini sedang tidak tersedia untuk dipesan saat ini.
            </p>
            <div class="action-buttons">
                <button disabled class="btn" style="background: #e2e8f0; color: #94a3b8; cursor: not-allowed;">
                    <i class="fas fa-ban"></i>
                    Not Available
                </button>
            </div>
        </div>
    @endif

    @can('manage-rooms')
        <div class="bottom-actions">
            <p>
                Manage room information, availability status, pricing, and room operations directly from the dashboard.
            </p>

            <div class="action-buttons">
                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-edit">
                    <i class="fas fa-pen"></i>
                    Edit Room
                </a>

                <form action="{{ route('rooms.destroy', $room->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this room?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-delete">
                        <i class="fas fa-trash"></i>
                        Delete Room
                    </button>
                </form>
            </div>
        </div>
    @endcan

</div>

</body>
</html>