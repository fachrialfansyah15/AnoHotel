<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        :root{
            --gold:#d4af37;
            --gold-light:#f3e5ab;
            --border:rgba(255,255,255,.08);
            --muted:#8fa3bf;
        }

        body{
            min-height:100vh;
            background:
            linear-gradient(
                135deg,
                #041026 0%,
                #08172f 50%,
                #0d2347 100%
            );

            font-family:'Plus Jakarta Sans',sans-serif;
            color:white;

            display:flex;
        }

        .main{
            margin-left:260px;
            width:calc(100% - 260px);
            padding:40px;
        }

        .page-header{
            margin-bottom:30px;
        }

        .eyebrow{
            color:var(--gold);
            text-transform:uppercase;
            letter-spacing:.25em;
            font-size:.75rem;
            font-weight:800;
            margin-bottom:12px;
        }

        h1{
            font-size:3rem;
            font-family:'Cinzel',serif;
            margin-bottom:10px;
        }

        .subtitle{
            color:#c7d2e3;
        }

        .card{
            max-width:900px;

            background:
            rgba(8,15,30,.88);

            border:1px solid var(--border);

            border-radius:30px;

            overflow:hidden;

            box-shadow:
            0 20px 60px rgba(0,0,0,.35);
        }

        .card-top{
            padding:35px;

            border-bottom:
            1px solid rgba(255,255,255,.06);

            background:
            linear-gradient(
                90deg,
                rgba(212,175,55,.08),
                transparent
            );
        }

        .card-top h2{
            font-size:2rem;
            margin-bottom:8px;
        }

        .card-top p{
            color:var(--muted);
        }

        .form-body{
            padding:35px;
        }

        .grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:24px;
        }

        .field{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .field.full{
            grid-column:1 / -1;
        }

        label{
            font-size:.95rem;
            font-weight:700;
            color:#dce5f3;
        }

        input,
        select{
            width:100%;

            background:#020817;

            border:1px solid rgba(255,255,255,.08);

            color:white;

            padding:18px 20px;

            border-radius:18px;

            font-size:1rem;

            outline:none;

            transition:.25s;
        }

        input:focus,
        select:focus{
            border-color:rgba(212,175,55,.45);

            box-shadow:
            0 0 0 4px rgba(212,175,55,.08);
        }

        .actions{
            margin-top:35px;

            display:flex;
            justify-content:flex-end;
            gap:16px;
        }

        .btn{
            border:none;
            cursor:pointer;

            padding:16px 28px;

            border-radius:18px;

            font-weight:800;
            font-size:1rem;

            transition:.25s;
        }

        .btn-cancel{
            background:
            rgba(255,255,255,.06);

            color:white;

            text-decoration:none;
        }

        .btn-cancel:hover{
            background:
            rgba(255,255,255,.12);
        }

        .btn-save{
            background:
            linear-gradient(
                135deg,
                var(--gold-light),
                var(--gold)
            );

            color:#041026;
        }

        .btn-save:hover{
            transform:translateY(-2px);
        }

        .error-box{
            margin-bottom:25px;

            background:
            rgba(239,68,68,.12);

            border:1px solid rgba(239,68,68,.25);

            padding:18px 20px;

            border-radius:18px;

            color:#fecaca;
        }

        .error-box ul{
            margin-left:18px;
            margin-top:10px;
        }

        @media(max-width:768px){

            .main{
                margin-left:0;
                width:100%;
                padding:20px;
            }

            .grid{
                grid-template-columns:1fr;
            }

            h1{
                font-size:2rem;
            }
        }

    </style>

</head>

<body>

@include('layouts.sidebar-management')

<div class="main">

    <div class="page-header">

        <div class="eyebrow">
            Hotel Management
        </div>

        <h1>Edit User</h1>

        <p class="subtitle">
            Update user account information and permissions.
        </p>

    </div>

    <div class="card">

        <div class="card-top">

            <h2>
                User Information
            </h2>

            <p>
                Modify user details below.
            </p>

        </div>

        <div class="form-body">

            @if ($errors->any())

                <div class="error-box">

                    <strong>
                        Validation Error
                    </strong>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form
                action="{{ route('users.update', $user->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="grid">

                    <div class="field">

                        <label>
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            placeholder="Enter full name"
                            required
                        >

                    </div>

                    <div class="field">

                        <label>
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            placeholder="Enter email"
                            required
                        >

                    </div>

                    <div class="field">

                        <label>
                            Role
                        </label>

                        <select name="role" required>

                            <option value="admin"
                                {{ $user->role == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="manager"
                                {{ $user->role == 'manager' ? 'selected' : '' }}>
                                Manager
                            </option>

                            <option value="receptionist"
                                {{ $user->role == 'receptionist' ? 'selected' : '' }}>
                                Receptionist
                            </option>

                            <option value="guest"
                                {{ $user->role == 'guest' ? 'selected' : '' }}>
                                Guest
                            </option>

                        </select>

                    </div>

                    <div class="field">

                        <label>
                            New Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Leave blank if unchanged"
                        >

                    </div>

                </div>

                <div class="actions">

                    <a
                        href="{{ route('users.index') }}"
                        class="btn btn-cancel"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-save"
                    >
                        Update User
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>