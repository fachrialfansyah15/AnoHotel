<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --gold-dim: rgba(212,175,55,.08);
            --gold-border: rgba(212,175,55,.18);
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
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid var(--gold-border);
            background: #030d20;
            padding: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 14px 40px rgba(0,0,0,.25);
            margin-bottom: 1.5rem;
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
            background: linear-gradient(90deg, rgba(4,16,38,.94), rgba(4,16,38,.62), rgba(4,16,38,.35));
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

        .btn-gold {
            border: none;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #041026;
            padding: .9rem 1.4rem;
            border-radius: 999px;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            text-decoration: none;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-top: -4rem;
            position: relative;
            z-index: 4;
            margin-bottom: 1.5rem;
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
        }

        .stat-value {
            font-size: 1.7rem;
            font-weight: 900;
        }

        .stat-label {
            color: var(--muted);
            font-size: .78rem;
            margin-top: .25rem;
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
            justify-content: space-between;
            align-items: center;
        }

        .panel-header h2 {
            font-family: 'Cinzel', serif;
            font-size: 1.25rem;
        }

        .panel-header p {
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

        .user-cell {
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

        .name {
            font-weight: 900;
        }

        .email {
            color: var(--muted);
        }

        .role-badge {
            display: inline-flex;
            padding: .45rem .8rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 900;
            text-transform: capitalize;
            background: rgba(212,175,55,.12);
            color: var(--gold-light);
            border: 1px solid var(--gold-border);
        }

        .actions {
            display: flex;
            gap: .6rem;
        }

        .btn-action {
            border: 1px solid var(--border);
            background: rgba(255,255,255,.05);
            color: white;
            padding: .65rem 1rem;
            border-radius: 10px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
        }

        .btn-edit {
            color: var(--gold-light);
            border-color: rgba(212,175,55,.25);
        }

        .btn-delete {
            color: #f87171;
            border-color: rgba(239,68,68,.25);
        }

        .empty {
            text-align: center;
            padding: 3rem;
            color: var(--muted);
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
            <div class="eyebrow">Hotel Management</div>
            <h1>Users</h1>
            <p>Manage employee accounts, guest accounts, and role permissions.</p>
        </div>

        @can('manage-users')
            <div class="hero-action">
                <a href="{{ route('users.create') }}" class="btn-gold">
                    <i class="fas fa-plus"></i>
                    Add User
                </a>
            </div>
        @endcan
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="stat-value">{{ $users->count() }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-shield"></i></div>
            <div>
                <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
                <div class="stat-label">Admins</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-tie"></i></div>
            <div>
                <div class="stat-value">{{ $users->where('role', 'manager')->count() }}</div>
                <div class="stat-label">Managers</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user"></i></div>
            <div>
                <div class="stat-value">{{ $users->where('role', 'guest')->count() }}</div>
                <div class="stat-label">Guests</div>
            </div>
        </div>
    </section>

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2>User List</h2>
                <p>Latest registered hotel users</p>
            </div>

            <div class="count-badge">
                {{ $users->count() }} Users
            </div>
        </div>

        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div class="name">
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </td>

                            <td class="email">
                                {{ $user->email }}
                            </td>

                            <td>
                                <span class="role-badge">
                                    {{ $user->role }}
                                </span>
                            </td>

                            <td>
                                @can('admin-only')
                                    <div class="actions">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit">
                                            <i class="fas fa-pen"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this user?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-action btn-delete">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty">
                                    No users found.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</main>

</body>
</html>