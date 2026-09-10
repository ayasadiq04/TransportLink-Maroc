<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TransportLink') }} - Connexion</title>

    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Base reset ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; }

        /* ── Full-screen split wrapper ── */
        .auth-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ── Left branding panel ── */
        .auth-brand {
            flex: 1;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 3rem 4rem;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1d4ed8 100%);
            overflow: hidden;
        }

        /* Decorative floating circles */
        .auth-brand::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.25) 0%, transparent 70%);
            top: -150px; right: -150px;
        }
        .auth-brand::after {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59,130,246,0.2) 0%, transparent 70%);
            bottom: -100px; left: -80px;
        }

        .auth-brand .brand-inner { position: relative; z-index: 1; }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 3rem;
        }
        .brand-logo-icon {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 24px rgba(99,102,241,0.4);
        }
        .brand-logo-icon svg { width: 26px; height: 26px; fill: white; }
        .brand-logo-text { color: white; font-size: 1.5rem; font-weight: 800; letter-spacing: -0.02em; }
        .brand-logo-text span { color: #93c5fd; }

        .brand-headline {
            font-size: 2.75rem;
            font-weight: 800;
            color: white;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 1.25rem;
        }
        .brand-headline em { font-style: normal; color: #93c5fd; }

        .brand-sub {
            font-size: 1rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.7;
            max-width: 380px;
            margin-bottom: 2.5rem;
        }

        /* Feature pills */
        .brand-pills { display: flex; flex-wrap: wrap; gap: 0.65rem; }
        .brand-pill {
            display: flex; align-items: center; gap: 0.5rem;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            border-radius: 999px;
            padding: 0.4rem 1rem;
            color: rgba(255,255,255,0.85);
            font-size: 0.8rem;
            font-weight: 500;
        }
        .brand-pill svg { width: 14px; height: 14px; fill: #93c5fd; flex-shrink: 0; }

        /* Decorative route line bottom */
        .brand-route {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            display: flex; justify-content: center;
        }

        /* ── Right form panel ── */
        .auth-form-panel {
            width: 100%;
            max-width: 520px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 2.5rem;
            background: #ffffff;
        }

        .auth-form-inner { width: 100%; max-width: 400px; }

        /* ── Responsive: stack vertically on small screens ── */
        @media (max-width: 768px) {
            .auth-wrapper { flex-direction: column; }
            .auth-brand { display: none; }
            .auth-form-panel { max-width: 100%; padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>
<div class="auth-wrapper">

    {{-- ── Left branding panel ── --}}
    <div class="auth-brand">
        <div class="brand-inner">
            {{-- Logo --}}
            <div class="brand-logo">
                <div class="brand-logo-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5S5.17 15.5 6 15.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9 1.96 2.5H17V9.5h2.5zM18 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                    </svg>
                </div>
                <span class="brand-logo-text">Transport<span>Link</span></span>
            </div>

            <h1 class="brand-headline">
                Connectez votre<br>
                <em>réseau logistique</em><br>
                au Maroc
            </h1>
            <p class="brand-sub">
                Plateforme intelligente qui relie expéditeurs et transporteurs pour une gestion fluide, rapide et sécurisée de vos livraisons.
            </p>

            <div class="brand-pills">
                <div class="brand-pill">
                    <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    Suivi en temps réel
                </div>
                <div class="brand-pill">
                    <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    Gestion des offres
                </div>
                <div class="brand-pill">
                    <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    Paiement sécurisé
                </div>
                <div class="brand-pill">
                    <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    Support 24/7
                </div>
            </div>
        </div>
    </div>

    {{-- ── Right form panel ── --}}
    <div class="auth-form-panel">
        <div class="auth-form-inner">

            @if(session('success'))
                <x-flash type="success" wrapper-class="mb-4 w-full">{{ session('success') }}</x-flash>
            @endif

            @if(session('error'))
                <x-flash type="error" wrapper-class="mb-4 w-full">{{ session('error') }}</x-flash>
            @endif

            {{ $slot }}
        </div>
    </div>

</div>
</body>
</html>
