<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Recommendations - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #041026 0%, #08172f 50%, #0d2347 100%);
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .main {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-family: 'Cinzel', serif;
            font-size: 2.4rem;
            font-weight: 600;
            color: white;
        }

        .page-header p {
            color: #90a0b7;
            margin-top: .5rem;
        }

        .recommend-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .room-card {
            background: rgba(255,255,255,.04);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 22px;
            overflow: hidden;
            backdrop-filter: blur(12px);
            box-shadow: 0 16px 35px rgba(0,0,0,.25);
        }

        .room-card img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
        }

        .room-content {
            padding: 1.6rem;
        }

        .tag {
            display: inline-block;
            background: rgba(212,175,55,.12);
            border: 1px solid rgba(212,175,55,.25);
            color: #f3e5ab;
            padding: .45rem .85rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .room-title {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: .7rem;
        }

        .room-desc {
            color: #90a0b7;
            line-height: 1.7;
            font-size: .95rem;
            margin-bottom: 1.5rem;
        }

        .price {
            color: #d4af37;
            font-size: 1.7rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }

        .btn-book {
            display: block;
            width: 100%;
            text-align: center;
            background: linear-gradient(135deg, #c99a2e, #d4af37);
            color: #041026;
            text-decoration: none;
            padding: .9rem;
            border-radius: 14px;
            font-weight: 800;
        }

        .btn-book:hover {
            filter: brightness(1.08);
        }

        @media (max-width: 1200px) {
            .recommend-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main {
                margin-left: 0;
                padding: 1rem;
            }

            .recommend-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@if(auth()->user()->role === 'guest')
    @include('layouts.sidebar-guest')
@else
    @include('layouts.sidebar-management')
@endif

<main class="main">

    <div class="page-header">
        <h1>AI Room Recommendations</h1>
        <p>Personalized luxury room recommendations powered by AnoHotel AI</p>
    </div>

    <div class="recommend-grid">

        <div class="room-card">
            <img src="{{ asset('images/recommend-honeymoon.jpg') }}" alt="Honeymoon Suite">

            <div class="room-content">
                <span class="tag">Best for Honeymoon</span>

                <div class="room-title">
                    Deluxe Ocean Suite
                </div>

                <div class="room-desc">
                    Perfect for romantic couples, sunset view, private jacuzzi, and premium relaxation experience.
                </div>

                <div class="price">
                    Rp 2.500.000
                </div>

                <a href="/rooms" class="btn-book">
                    Book Recommended Room
                </a>
            </div>
        </div>

        <div class="room-card">
            <img src="{{ asset('images/recommend-business.jpg') }}" alt="Executive Smart Room">

            <div class="room-content">
                <span class="tag">Business Trip</span>

                <div class="room-title">
                    Executive Smart Room
                </div>

                <div class="room-desc">
                    Recommended for professionals with workspace, fast internet, and smart meeting facilities.
                </div>

                <div class="price">
                    Rp 1.800.000
                </div>

                <a href="/rooms" class="btn-book">
                    Book Recommended Room
                </a>
            </div>
        </div>

        <div class="room-card">
            <img src="{{ asset('images/recommend-family.jpg') }}" alt="Family Grand Suite">

            <div class="room-content">
                <span class="tag">Family Favorite</span>

                <div class="room-title">
                    Family Grand Suite
                </div>

                <div class="room-desc">
                    Spacious luxury suite for family vacation with connecting rooms and entertainment features.
                </div>

                <div class="price">
                    Rp 3.200.000
                </div>

                <a href="/rooms" class="btn-book">
                    Book Recommended Room
                </a>
            </div>
        </div>

    </div>

</main>

</body>
</html>