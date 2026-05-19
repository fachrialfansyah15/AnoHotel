<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AI Concierge - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        :root{
            --gold:#d4af37;
            --gold-light:#f3e5ab;

            --bg:
            linear-gradient(
                135deg,
                #041026 0%,
                #08172f 50%,
                #0d2347 100%
            );

            --surface:rgba(255,255,255,.04);
            --surface-hover:rgba(255,255,255,.07);

            --border:rgba(255,255,255,.08);

            --text:#ffffff;
            --text-secondary:#90a0b7;
        }

        body{
            background:var(--bg);
            min-height:100vh;
            color:white;
            font-family:'Plus Jakarta Sans',sans-serif;
            display:flex;
            overflow:hidden;
        }

        /* MAIN */
        .main{
            flex:1;
            margin-left:260px;
            padding:32px;
            overflow:hidden;
        }

        /* HEADER */
        .page-header{
            margin-bottom:28px;
        }

        .page-header h1{
            font-family:'Cinzel',serif;
            font-size:44px;
            font-weight:600;
            color:#fff;
            margin-bottom:10px;
        }

        .page-header p{
            color:var(--text-secondary);
            font-size:16px;
        }

        /* CHAT LAYOUT */
        .chat-layout{
            display:grid;
            grid-template-columns:340px 1fr;
            gap:24px;
            height:calc(100vh - 170px);
        }

        /* GLASS */
        .glass{
            background:var(--surface);
            border:1px solid var(--border);
            backdrop-filter:blur(14px);
            border-radius:28px;
            overflow:hidden;
        }

        /* LEFT PANEL */
        .sidebar-ai{
            padding:28px;
            display:flex;
            flex-direction:column;
        }

        .sidebar-ai h3{
            color:var(--gold);
            font-size:20px;
            margin-bottom:24px;
        }

        .quick-btn{
            width:100%;
            padding:18px;
            border-radius:18px;
            border:1px solid rgba(255,255,255,.06);
            background:rgba(255,255,255,.03);
            color:white;
            text-align:left;
            margin-bottom:14px;
            transition:.25s;
            cursor:pointer;
            font-size:15px;
        }

        .quick-btn:hover{
            background:rgba(212,175,55,.12);
            border-color:rgba(212,175,55,.28);
            transform:translateY(-2px);
        }

        /* CHAT BOX */
        .chat-box{
            display:flex;
            flex-direction:column;
            height:100%;
            position:relative;
        }

        /* TOP CHAT HEADER */
        .chat-top{
            padding:24px 28px;
            border-bottom:1px solid rgba(255,255,255,.05);

            background:
            linear-gradient(
                90deg,
                rgba(212,175,55,.08),
                transparent
            );
        }

        .chat-top h2{
            font-size:18px;
            color:white;
        }

        .chat-top p{
            color:var(--text-secondary);
            margin-top:6px;
            font-size:14px;
        }

        /* MESSAGES */
        .messages{
            flex:1;
            overflow-y:auto;
            padding:32px;
            display:flex;
            flex-direction:column;
            gap:22px;
        }

        .message{
            max-width:75%;
            padding:20px;
            line-height:1.7;
            font-size:15px;
        }

        .ai-message{
            align-self:flex-start;

            background:
            linear-gradient(
                135deg,
                rgba(212,175,55,.12),
                rgba(255,255,255,.04)
            );

            border:
            1px solid rgba(212,175,55,.18);

            border-radius:
            24px 24px 24px 8px;
        }

        .user-message{
            align-self:flex-end;

            background:
            rgba(255,255,255,.06);

            border:
            1px solid rgba(255,255,255,.05);

            border-radius:
            24px 24px 8px 24px;
        }

        /* INPUT */
        .input-area{
            padding:24px;
            border-top:1px solid rgba(255,255,255,.05);

            display:flex;
            gap:16px;

            background:
            rgba(0,0,0,.12);
        }

        .input-area input{
            flex:1;

            background:
            rgba(255,255,255,.05);

            border:none;
            outline:none;

            color:white;

            padding:18px 22px;

            border-radius:18px;

            font-size:15px;
        }

        .input-area input::placeholder{
            color:#7f93b0;
        }

        .send-btn{
            background:
            linear-gradient(
                135deg,
                #c99a2e,
                #d4af37
            );

            color:#041026;

            border:none;

            padding:0 30px;

            border-radius:18px;

            font-weight:700;

            cursor:pointer;

            transition:.25s;
        }

        .send-btn:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(212,175,55,.22);
        }

        /* SCROLL */
        .messages::-webkit-scrollbar{
            width:6px;
        }

        .messages::-webkit-scrollbar-thumb{
            background:rgba(255,255,255,.08);
            border-radius:20px;
        }

        /* MOBILE */
        @media(max-width:1100px){

            .chat-layout{
                grid-template-columns:1fr;
            }

            .sidebar-ai{
                display:none;
            }
        }

        @media(max-width:768px){

            .main{
                margin-left:0;
                padding:18px;
            }

            .page-header h1{
                font-size:34px;
            }

            .message{
                max-width:100%;
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

<div class="main">

    {{-- HEADER --}}
    <div class="page-header">

        <h1>AI Concierge</h1>

        <p>
            Luxury smart assistant for hotel guests and management staff
        </p>

    </div>

    <div class="chat-layout">

        {{-- LEFT PANEL --}}
        <div class="sidebar-ai glass">

            <h3>Quick Assistance</h3>

            <button class="quick-btn">
                🛏️ Recommend luxury rooms
            </button>

            <button class="quick-btn">
                🍽️ Restaurant recommendations
            </button>

            <button class="quick-btn">
                🏖️ Honeymoon package ideas
            </button>

            <button class="quick-btn">
                📅 Available rooms today
            </button>

            <button class="quick-btn">
                💳 Payment assistance
            </button>

            <button class="quick-btn">
                🚕 Airport pickup service
            </button>

            <button class="quick-btn">
                🧾 Reservation support
            </button>

        </div>

        {{-- CHAT --}}
        <div class="chat-box glass">

            {{-- CHAT HEADER --}}
            <div class="chat-top">

                <h2>AnoHotel AI Concierge</h2>

                <p>
                    Ask about rooms, reservations, payments, services, and recommendations
                </p>

            </div>

            {{-- CHAT BODY --}}
            <div class="messages" id="messages">

                <div class="message ai-message">
                    Welcome to AnoHotel AI Concierge.
                    How may I assist you today?
                </div>

                <div class="message user-message">
                    Recommend the best room for honeymoon.
                </div>

                <div class="message ai-message">
                    I recommend our Deluxe Ocean Suite with private jacuzzi,
                    romantic dinner service, complimentary champagne,
                    and panoramic ocean sunset view.
                </div>

            </div>

            {{-- INPUT --}}
            <div class="input-area">

                <input
                    type="text"
                    placeholder="Ask AnoHotel AI..."
                >

                <button class="send-btn">

                    <i class="fas fa-paper-plane"></i>

                </button>

            </div>

        </div>

    </div>

</div>

</body>
</html>