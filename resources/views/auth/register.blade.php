<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AnoHotel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold: #C9A96E;
            --gold-light: #E8D5B0;
            --navy: #0A1628;
            --border: rgba(201,169,110,0.2);
            --border-focus: rgba(201,169,110,0.7);
            --muted: rgba(232,213,176,0.5);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* LEFT: tinggi penuh, gambar latar belakang */
        .left-panel {
            min-height: 100vh;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        /* RIGHT: dark navy form */
        .right-panel {
            background: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .right-panel::before {
            content: '';
            position: absolute;
            bottom: -100px; right: -100px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(201,169,110,0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        .form-card {
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
            animation: fadeUp 0.8s 0.1s ease both;
        }

        .form-header { margin-bottom: 2.8rem; }

        .brand { display: flex; align-items: center; gap: 0.7rem; margin-bottom: 2rem; }
        .brand-icon {
            width: 34px; height: 34px;
            border: 1px solid var(--gold);
            display: flex; align-items: center; justify-content: center;
        }
        .brand-icon svg { width: 16px; height: 16px; stroke: var(--gold); fill: none; }
        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem; color: #fff;
            letter-spacing: 0.22em; text-transform: uppercase;
        }

        .form-header h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem; font-weight: 300;
            color: #fff; line-height: 1.15; margin-bottom: 0.5rem;
        }
        .form-header h2 em { font-style: italic; color: var(--gold-light); }
        .form-header p { font-size: 0.8rem; color: var(--muted); letter-spacing: 0.06em; }

        .field { margin-bottom: 1.6rem; }
        .field label {
            display: block; font-size: 0.68rem;
            text-transform: uppercase; letter-spacing: 0.16em;
            color: var(--muted); margin-bottom: 0.6rem;
        }

        .input-wrap { position: relative; }
        .input-wrap input {
            width: 100%; background: transparent;
            border: none; border-bottom: 1px solid var(--border);
            padding: 0.7rem 2.2rem 0.7rem 0;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem; color: #fff;
            outline: none; transition: border-color 0.3s; border-radius: 0;
        }
        .input-wrap input::placeholder { color: rgba(232,213,176,0.2); }
        .input-wrap input:focus { border-bottom-color: transparent; }
        .input-wrap input:focus ~ .line { width: 100%; }

        .line {
            position: absolute; bottom: 0; left: 0;
            height: 1px; width: 0;
            background: var(--gold);
            transition: width 0.4s ease; pointer-events: none;
        }
        .ico { position: absolute; right: 0; top: 50%; transform: translateY(-50%); }
        .ico svg { width: 15px; height: 15px; stroke: var(--muted); fill: none; display: block; }

        .btn {
            width: 100%; background: transparent;
            color: var(--gold-light); border: 1px solid var(--gold);
            padding: 0.95rem; font-family: 'DM Sans', sans-serif;
            font-size: 0.75rem; font-weight: 500;
            letter-spacing: 0.22em; text-transform: uppercase;
            cursor: pointer; position: relative; overflow: hidden;
            transition: color 0.35s; border-radius: 0;
            margin-top: 1rem;
        }
        .btn::before {
            content: ''; position: absolute; inset: 0;
            background: var(--gold); transform: translateX(-101%); transition: transform 0.35s ease;
        }
        .btn:hover { color: var(--navy); }
        .btn:hover::before { transform: translateX(0); }
        .btn span { position: relative; z-index: 1; }

        .divider { display: flex; align-items: center; gap: 1rem; margin: 1.8rem 0; }
        .divider-line { flex: 1; height: 1px; background: var(--border); }
        .divider span { font-size: 0.68rem; color: rgba(201,169,110,0.3); letter-spacing: 0.12em; text-transform: uppercase; }

        .login-redirect { text-align: center; font-size: 0.78rem; color: var(--muted); }
        .login-redirect a { color: var(--gold); text-decoration: none; font-weight: 500; }
        .login-redirect a:hover { color: var(--gold-light); }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
        }
    </style>
</head>
<body>

    {{-- Gambar diambil dari public/images/AnoHotel.png --}}
    <div class="left-panel" style="background-image: url('{{ asset('images/anohotel.fix.png') }}'); background-position: 70% center;"></div>

    <div class="right-panel">
        <div class="form-card">

            <div class="form-header">
                <div class="brand">
                    <div class="brand-icon">
                        <svg viewBox="0 0 24 24" stroke-width="1.3">
                            <path d="M3 21h18M5 21V9l7-6 7 6v12M9 21v-6h6v6"/>
                        </svg>
                    </div>
                    <div class="brand-name">AnoHotel</div>
                </div>
                <h2>Begin your <em>journey</em></h2>
                <p>Create an account to experience luxury</p>
            </div>

            @if ($errors->any())
                <div class="alert-error" style="display: flex; align-items: center; gap: 0.75rem; background: rgba(255, 107, 107, 0.1); border: 1px solid rgba(255, 107, 107, 0.3); padding: 0.85rem 1rem; margin-bottom: 1.8rem; color: #ff6b6b; font-size: 0.8rem; border-radius: 4px;">
                    <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px; height: 16px; stroke: #ff6b6b; fill: none; flex-shrink: 0;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div style="display: block;">{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="/register">
                @csrf

                <div class="field">
                    <label for="name">Full Name</label>
                    <div class="input-wrap">
                        <input type="text" id="name" name="name" placeholder="Your full name" autocomplete="name" required>
                        <span class="ico">
                            <svg viewBox="0 0 24 24" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <span class="line"></span>
                    </div>
                </div>

                <div class="field">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <input type="email" id="email" name="email" placeholder="your@email.com" autocomplete="email" required>
                        <span class="ico">
                            <svg viewBox="0 0 24 24" stroke-width="1.5">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <path d="m2 7 10 7 10-7"/>
                            </svg>
                        </span>
                        <span class="line"></span>
                    </div>
                </div>

            <div class="field">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="new-password"
                        required
                    >

                    <span class="ico">
                        <svg viewBox="0 0 24 24" stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </span>

                <span class="line"></span>
                </div>
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="••••••••"
                        autocomplete="new-password"
                        required
                    >

                    <span class="ico">
                        <svg viewBox="0 0 24 24" stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </span>

                <span class="line"></span>
            </div>
        </div>

                <button type="submit" class="btn"><span>Register</span></button>
            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <span>or</span>
                <div class="divider-line"></div>
            </div>

            <div class="login-redirect">
                Already have an account? <a href="/login">Sign In &rarr;</a>
            </div>

        </div>
    </div>

</body>
</html>