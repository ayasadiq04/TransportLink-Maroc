<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TransportLink Maroc — Plateforme N°1 de Transport de Marchandises au Maroc</title>
    <meta name="description" content="Mise en relation directe entre expéditeurs et transporteurs professionnels certifiés partout au Maroc.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --indigo: #4f46e5;
            --indigo-dark: #3730a3;
            --emerald: #10b981;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            color: #111827;
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAV ── */
        header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #f3f4f6;
        }
        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }
        .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .logo-icon {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(79,70,229,.35);
        }
        .logo-icon svg { width: 22px; height: 22px; color: #fff; stroke: #fff; fill: none; }
        .logo-text { line-height: 1; }
        .logo-text span { font-size: 1.2rem; font-weight: 900; color: #111827; letter-spacing: -0.02em; }
        .logo-text small { display: block; font-size: 0.62rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #10b981; margin-top: -1px; }

        nav.links { display: flex; align-items: center; gap: 32px; }
        nav.links a {
            font-size: 0.875rem; font-weight: 600; color: #4b5563;
            text-decoration: none; transition: color .2s;
        }
        nav.links a:hover { color: #4f46e5; }

        .nav-btns { display: flex; align-items: center; gap: 10px; }
        .btn-outline {
            padding: 8px 20px; border-radius: 10px; border: 1.5px solid #e5e7eb;
            background: transparent; font-size: 0.85rem; font-weight: 600; color: #374151;
            text-decoration: none; transition: all .2s; cursor: pointer;
        }
        .btn-outline:hover { border-color: #4f46e5; color: #4f46e5; }
        .btn-primary {
            padding: 9px 22px; border-radius: 10px;
            background: #4f46e5; color: #fff;
            font-size: 0.85rem; font-weight: 700;
            text-decoration: none; transition: all .2s;
            box-shadow: 0 2px 8px rgba(79,70,229,.3);
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-primary:hover { background: #3730a3; box-shadow: 0 4px 16px rgba(79,70,229,.4); transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            padding: 80px 24px 100px;
            background: linear-gradient(160deg, #fff 0%, #eef2ff 50%, #f0fdf4 100%);
            overflow: hidden; position: relative;
        }
        .hero-inner {
            max-width: 1280px; margin: 0 auto;
            display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: center;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: #eef2ff; border: 1px solid #c7d2fe;
            border-radius: 999px; padding: 6px 14px;
            font-size: 0.78rem; font-weight: 700; color: #4338ca;
            margin-bottom: 24px;
        }
        .hero-badge span { width: 8px; height: 8px; border-radius: 50%; background: #10b981; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%,100%{opacity:1}50%{opacity:.4} }

        .hero h1 {
            font-size: 3.5rem; font-weight: 900; line-height: 1.1;
            letter-spacing: -0.04em; color: #111827; margin-bottom: 20px;
        }
        .hero h1 em { font-style: normal; background: linear-gradient(135deg, #4f46e5, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero p { font-size: 1.05rem; color: #6b7280; line-height: 1.7; max-width: 480px; margin-bottom: 32px; }

        .hero-ctas { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 48px; }
        .cta-main {
            padding: 14px 32px; border-radius: 12px; background: #4f46e5; color: #fff;
            font-weight: 700; font-size: 0.95rem; text-decoration: none;
            box-shadow: 0 4px 20px rgba(79,70,229,.4); transition: all .2s;
        }
        .cta-main:hover { background: #3730a3; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(79,70,229,.45); }
        .cta-sec {
            padding: 14px 28px; border-radius: 12px; background: #fff;
            border: 1.5px solid #e5e7eb; color: #374151;
            font-weight: 700; font-size: 0.95rem; text-decoration: none; transition: all .2s;
        }
        .cta-sec:hover { border-color: #6366f1; color: #4f46e5; }

        .hero-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; padding-top: 32px; border-top: 1px solid #e5e7eb; max-width: 480px; }
        .hero-stat p { font-size: 1.8rem; font-weight: 900; color: #111827; }
        .hero-stat p.green { color: #10b981; }
        .hero-stat small { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #9ca3af; }

        /* Hero card */
        .hero-card {
            background: #fff; border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,.1);
            border: 1px solid #f3f4f6; padding: 28px;
            position: relative; overflow: hidden;
        }
        .hero-card::before {
            content: ''; position: absolute; top: -50%; right: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(ellipse at center, rgba(79,70,229,.05) 0%, transparent 70%);
            pointer-events: none;
        }
        .card-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #f3f4f6; }
        .card-top span { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; color: #9ca3af; }
        .badge-waiting { background: #d1fae5; color: #065f46; font-size: 0.72rem; font-weight: 700; padding: 4px 10px; border-radius: 999px; }
        .card-title { font-size: 1.1rem; font-weight: 800; color: #111827; margin-bottom: 14px; }
        .route-box { background: #f9fafb; border-radius: 14px; padding: 16px; margin-bottom: 16px; }
        .route-row { display: flex; align-items: center; gap: 10px; font-size: 0.875rem; }
        .dot-green { width: 12px; height: 12px; border-radius: 50%; background: #10b981; box-shadow: 0 0 0 4px #d1fae5; }
        .dot-red { width: 12px; height: 12px; border-radius: 50%; background: #f43f5e; box-shadow: 0 0 0 4px #ffe4e6; }
        .route-city { font-weight: 700; color: #111827; }
        .route-sub { font-size: 0.72rem; color: #9ca3af; }
        .route-line { width: 2px; height: 16px; background: #e5e7eb; margin-left: 5px; }
        .card-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 18px; }
        .meta-box { background: #eef2ff; border-radius: 10px; padding: 10px 12px; }
        .meta-box small { display: block; font-size: 0.68rem; color: #6b7280; margin-bottom: 2px; }
        .meta-box span { font-weight: 800; font-size: 0.875rem; color: #111827; }
        .meta-box span.green { color: #10b981; font-size: 1rem; }
        .card-btn {
            display: block; width: 100%; padding: 12px; text-align: center;
            background: #111827; color: #fff; font-weight: 700; font-size: 0.8rem;
            border-radius: 12px; text-decoration: none; transition: background .2s;
        }
        .card-btn:hover { background: #000; }

        /* ── SECTIONS COMMON ── */
        .section { padding: 96px 24px; }
        .section-inner { max-width: 1280px; margin: 0 auto; }
        .section-tag {
            display: inline-block; font-size: 0.72rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.08em;
            padding: 5px 14px; border-radius: 999px; margin-bottom: 14px;
        }
        .tag-indigo { background: #eef2ff; color: #4338ca; }
        .tag-emerald { background: #d1fae5; color: #065f46; }
        .tag-amber { background: #fef3c7; color: #92400e; }
        .tag-rose { background: #ffe4e6; color: #9f1239; }
        .section-title { font-size: 2.4rem; font-weight: 900; color: #111827; letter-spacing: -0.03em; margin-bottom: 14px; }
        .section-sub { font-size: 1rem; color: #6b7280; max-width: 560px; margin: 0 auto 56px; line-height: 1.6; }
        .text-center { text-align: center; }

        /* ── HOW IT WORKS ── */
        .steps { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
        .step-card {
            background: #f9fafb; border: 1px solid #f3f4f6;
            border-radius: 20px; padding: 32px;
            transition: box-shadow .3s, transform .3s;
        }
        .step-card:hover { box-shadow: 0 12px 40px rgba(0,0,0,.08); transform: translateY(-4px); }
        .step-num {
            width: 48px; height: 48px; border-radius: 14px;
            font-size: 1.2rem; font-weight: 900; color: #fff;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px; box-shadow: 0 4px 14px rgba(0,0,0,.2);
        }
        .num-1 { background: #4f46e5; box-shadow: 0 4px 14px rgba(79,70,229,.4); }
        .num-2 { background: #10b981; box-shadow: 0 4px 14px rgba(16,185,129,.4); }
        .num-3 { background: #8b5cf6; box-shadow: 0 4px 14px rgba(139,92,246,.4); }
        .step-card h3 { font-size: 1.15rem; font-weight: 800; color: #111827; margin-bottom: 10px; }
        .step-card p { font-size: 0.875rem; color: #6b7280; line-height: 1.65; }

        /* ── SERVICES ── */
        .bg-gray { background: #f9fafb; }
        .bg-white { background: #fff; }
        .services-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; }
        .service-card {
            background: #fff; border: 1px solid #f3f4f6;
            border-radius: 18px; padding: 28px 20px;
            text-align: center; transition: all .3s;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }
        .service-card:hover { box-shadow: 0 12px 32px rgba(0,0,0,.1); transform: translateY(-4px); }
        .service-icon { font-size: 2.2rem; margin-bottom: 14px; }
        .service-card h4 { font-size: 0.9rem; font-weight: 800; color: #111827; margin-bottom: 8px; }
        .service-card p { font-size: 0.78rem; color: #9ca3af; line-height: 1.5; }

        /* ── TRANSPORTEURS ── */
        .transporteur-section { background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%); }
        .transporteur-section .section-title { color: #fff; }
        .transporteur-section .section-sub { color: #94a3b8; }
        .trans-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; margin-bottom: 48px; }
        .trans-card {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 20px; padding: 28px;
            transition: all .3s;
        }
        .trans-card:hover { background: rgba(255,255,255,.1); transform: translateY(-4px); border-color: rgba(99,102,241,.5); }
        .trans-icon {
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; margin-bottom: 18px;
        }
        .icon-blue { background: rgba(79,70,229,.25); }
        .icon-green { background: rgba(16,185,129,.25); }
        .icon-purple { background: rgba(139,92,246,.25); }
        .trans-card h3 { font-size: 1rem; font-weight: 800; color: #fff; margin-bottom: 10px; }
        .trans-card p { font-size: 0.83rem; color: #94a3b8; line-height: 1.6; }
        .trans-ctas { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
        .btn-white {
            padding: 14px 32px; border-radius: 12px;
            background: #fff; color: #111827;
            font-weight: 700; font-size: 0.9rem;
            text-decoration: none; transition: all .2s;
            box-shadow: 0 4px 14px rgba(0,0,0,.2);
        }
        .btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.3); }
        .btn-ghost {
            padding: 14px 32px; border-radius: 12px;
            background: transparent; color: #fff;
            border: 1.5px solid rgba(255,255,255,.25);
            font-weight: 700; font-size: 0.9rem;
            text-decoration: none; transition: all .2s;
        }
        .btn-ghost:hover { border-color: #fff; background: rgba(255,255,255,.08); }

        /* ── CONTACT ── */
        .contact-section { background: #fff; }
        .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: start; }
        .contact-info h2 { font-size: 2.2rem; font-weight: 900; color: #111827; letter-spacing: -0.03em; margin-bottom: 14px; }
        .contact-info p { font-size: 1rem; color: #6b7280; line-height: 1.7; margin-bottom: 36px; }
        .contact-items { display: flex; flex-direction: column; gap: 20px; }
        .contact-item {
            display: flex; align-items: center; gap: 16px;
            padding: 16px 20px; border-radius: 14px;
            background: #f9fafb; border: 1px solid #f3f4f6;
            text-decoration: none; transition: all .2s;
        }
        .contact-item:hover { border-color: #c7d2fe; background: #eef2ff; transform: translateX(4px); }
        .contact-item-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 1.2rem;
        }
        .ci-email { background: #eef2ff; }
        .ci-phone { background: #d1fae5; }
        .ci-address { background: #fef3c7; }
        .contact-item-text small { display: block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; color: #9ca3af; margin-bottom: 2px; }
        .contact-item-text span { font-size: 0.9rem; font-weight: 700; color: #111827; }

        /* Contact Form */
        .contact-form-card {
            background: #fff; border: 1px solid #e5e7eb;
            border-radius: 24px; padding: 36px;
            box-shadow: 0 8px 40px rgba(0,0,0,.07);
        }
        .contact-form-card h3 { font-size: 1.25rem; font-weight: 800; color: #111827; margin-bottom: 6px; }
        .contact-form-card .sub { font-size: 0.83rem; color: #9ca3af; margin-bottom: 28px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
        .form-group label { font-size: 0.8rem; font-weight: 700; color: #374151; }
        .form-input {
            padding: 11px 14px; border-radius: 10px;
            border: 1.5px solid #e5e7eb; font-size: 0.875rem;
            color: #111827; background: #fff;
            transition: border-color .2s, box-shadow .2s; outline: none;
            font-family: inherit;
        }
        .form-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.15); }
        textarea.form-input { resize: vertical; min-height: 110px; }
        .form-submit {
            width: 100%; padding: 13px; border-radius: 12px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff; font-weight: 700; font-size: 0.9rem;
            border: none; cursor: pointer; transition: all .2s;
            box-shadow: 0 4px 14px rgba(79,70,229,.35);
        }
        .form-submit:hover { box-shadow: 0 8px 24px rgba(79,70,229,.45); transform: translateY(-1px); }

        /* ── FOOTER ── */
        footer {
            background: #0f172a; color: #64748b;
            padding: 48px 24px;
        }
        .footer-inner {
            max-width: 1280px; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 20px;
            padding-bottom: 24px; border-bottom: 1px solid #1e293b; margin-bottom: 24px;
        }
        .footer-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .footer-logo-icon {
            width: 34px; height: 34px; border-radius: 8px;
            background: #4f46e5; color: #fff;
            font-weight: 900; font-size: 0.75rem;
            display: flex; align-items: center; justify-content: center;
        }
        .footer-logo span { color: #fff; font-weight: 800; font-size: 1rem; }
        .footer-copy { font-size: 0.78rem; color: #475569; }
        .footer-links { display: flex; gap: 20px; }
        .footer-links a { font-size: 0.8rem; font-weight: 600; color: #64748b; text-decoration: none; transition: color .2s; }
        .footer-links a:hover { color: #fff; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .hero-inner { grid-template-columns: 1fr; }
            .hero h1 { font-size: 2.6rem; }
            .steps, .trans-grid { grid-template-columns: 1fr 1fr; }
            .services-grid { grid-template-columns: 1fr 1fr; }
            .contact-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            nav.links { display: none; }
            .steps, .trans-grid, .services-grid { grid-template-columns: 1fr; }
            .hero h1 { font-size: 2rem; }
            .section-title { font-size: 1.8rem; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- ══ NAVBAR ══ -->
    <header>
        <div class="nav-inner">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                    </svg>
                </div>
                <div class="logo-text">
                    <span>TransportLink</span>
                    <small>Maroc</small>
                </div>
            </a>

            <nav class="links">
                <a href="#features">Comment ça marche</a>
                <a href="#services">Nos Services</a>
                <a href="#transporters">Espace Transporteurs</a>
                <a href="#contact">Contact</a>
            </nav>

            <div class="nav-btns">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">Mon Tableau de Bord &rarr;</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary">Inscription gratuite</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- ══ HERO ══ -->
    <section class="hero">
        <div class="hero-inner">
            <!-- Left -->
            <div>
                <h1>Expédiez vos marchandises en toute <em>simplicité & sécurité</em>.</h1>
                <p>TransportLink Maroc met en relation expéditeurs et transporteurs vérifiés. Publiez votre annonce, comparez les devis et suivez votre trajet en temps réel.</p>

                <div class="hero-ctas">
                    @auth
                        <a href="{{ route('dashboard') }}" class="cta-main">Accéder à mon compte &rarr;</a>
                    @else
                        <a href="{{ route('register') }}" class="cta-main">Publier une cargaison &rarr;</a>
                        <a href="{{ route('login') }}" class="cta-sec">Je suis transporteur</a>
                    @endauth
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <p>+1,500</p>
                        <small>Trajets réalisés</small>
                    </div>
                    <div class="hero-stat">
                        <p>100%</p>
                        <small>Transporteurs vérifiés</small>
                    </div>
                    <div class="hero-stat">
                        <p class="green">4.9/5</p>
                        <small>Satisfaction client</small>
                    </div>
                </div>
            </div>

            <!-- Right: Demo card -->
            <div>
                <div class="hero-card">
                    <div class="card-top">
                        <span>Dernière demande active</span>
                        <span class="badge-waiting">En attente de devis</span>
                    </div>
                    <div class="card-title">Transport de palettes alimentaires</div>
                    <div class="route-box">
                        <div class="route-row">
                            <div class="dot-green"></div>
                            <div>
                                <div class="route-city">Casablanca</div>
                                <div class="route-sub">Zone Industrielle Ain Sebaâ</div>
                            </div>
                        </div>
                        <div class="route-line"></div>
                        <div class="route-row" style="margin-top:10px">
                            <div class="dot-red"></div>
                            <div>
                                <div class="route-city">Tanger Med</div>
                                <div class="route-sub">Plateforme Logistique</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-meta">
                        <div class="meta-box">
                            <small>Poids & Volume</small>
                            <span>4.5 T • 8 Palettes</span>
                        </div>
                        <div class="meta-box">
                            <small>Budget estimé</small>
                            <span class="green">3,500 DH</span>
                        </div>
                    </div>
                    <a href="{{ route('register') }}" class="card-btn">Voir toutes les opportunités &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ COMMENT ÇA MARCHE ══ -->
    <section id="features" class="section bg-white">
        <div class="section-inner">
            <div class="text-center" style="margin-bottom:56px">
                <span class="section-tag tag-indigo">Simple et Efficace</span>
                <h2 class="section-title">Comment fonctionne TransportLink ?</h2>
                <p class="section-sub">Une procédure fluide conçue pour vous faire gagner du temps et économiser sur vos coûts logistiques.</p>
            </div>
            <div class="steps">
                <div class="step-card">
                    <div class="step-num num-1">1</div>
                    <h3>Publiez votre demande</h3>
                    <p>Précisez les villes de départ et d'arrivée, la nature de la cargaison, le poids, les dates souhaitées et votre budget indicatif.</p>
                </div>
                <div class="step-card">
                    <div class="step-num num-2">2</div>
                    <h3>Recevez des devis directs</h3>
                    <p>Des transporteurs certifiés consultent votre offre et vous proposent leurs meilleurs tarifs avec les véhicules adaptés.</p>
                </div>
                <div class="step-card">
                    <div class="step-num num-3">3</div>
                    <h3>Suivez et Évaluez</h3>
                    <p>Acceptez l'offre idéale, suivez le statut de livraison (En attente → En cours → Livrée) et notez la prestation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ SERVICES ══ -->
    <section id="services" class="section bg-gray">
        <div class="section-inner">
            <div class="text-center" style="margin-bottom:56px">
                <span class="section-tag tag-emerald">Polyvalence</span>
                <h2 class="section-title">Toutes les cargaisons prises en charge</h2>
                <p class="section-sub">Notre flotte de transporteurs s'adapte à tous vos besoins de livraison à travers le Maroc.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">📦</div>
                    <h4>Colis volumineux & Meubles</h4>
                    <p>Déménagements, électroménager et biens fragiles avec emballage sécurisé.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🏗️</div>
                    <h4>Palettes & Fret Industriel</h4>
                    <p>Marchandises palettisées pour usines, entrepôts et grossistes.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">❄️</div>
                    <h4>Transport Frigorifique</h4>
                    <p>Produits frais et surgelés sous température dirigée et contrôlée.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🚛</div>
                    <h4>Vrac & Matériaux</h4>
                    <p>Agrégats, sable, matériaux de construction et bennes basculantes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ ESPACE TRANSPORTEURS ══ -->
    <section id="transporters" class="section transporteur-section">
        <div class="section-inner">
            <div class="text-center" style="margin-bottom:56px">
                <span class="section-tag tag-amber">Pour les Professionnels du Transport</span>
                <h2 class="section-title" style="color:#fff">Rejoignez notre réseau de transporteurs</h2>
                <p class="section-sub" style="color:#94a3b8;margin-bottom:0">Accédez à des centaines de demandes de transport chaque mois et développez votre activité au Maroc.</p>
            </div>

            <div class="trans-grid">
                <div class="trans-card">
                    <div class="trans-icon icon-blue">🎯</div>
                    <h3>Offres ciblées pour vous</h3>
                    <p>Recevez uniquement des demandes correspondant à votre zone géographique, votre type de véhicule et vos disponibilités.</p>
                </div>
                <div class="trans-card">
                    <div class="trans-icon icon-green">💰</div>
                    <h3>Revenus garantis</h3>
                    <p>Proposez vos tarifs librement, signez vos contrats directement avec les expéditeurs et percevez vos paiements en toute sécurité.</p>
                </div>
                <div class="trans-card">
                    <div class="trans-icon icon-purple">📊</div>
                    <h3>Dashboard professionnel</h3>
                    <p>Gérez votre flotte, vos offres et vos trajets depuis un espace dédié. Suivez vos performances en temps réel.</p>
                </div>
            </div>

            <div class="trans-ctas">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-white">Accéder à mon espace &rarr;</a>
                @else
                    <a href="{{ route('register') }}" class="btn-white">S'inscrire comme transporteur &rarr;</a>
                    <a href="{{ route('login') }}" class="btn-ghost">Déjà inscrit ? Connexion</a>
                @endauth
            </div>
        </div>
    </section>

    <!-- ══ CONTACT ══ -->
    <section id="contact" class="section contact-section">
        <div class="section-inner">
            <div class="contact-grid">
                <!-- Info -->
                <div class="contact-info">
                    <span class="section-tag tag-rose">Nous contacter</span>
                    <h2>Une question ? <br>On est là pour vous.</h2>
                    <p>Notre équipe est disponible du lundi au vendredi de 9h à 18h pour répondre à toutes vos questions concernant la plateforme ou vos expéditions.</p>

                    <div class="contact-items">
                        <a href="mailto:aya00sadiq@gmail.com" class="contact-item">
                            <div class="contact-item-icon ci-email">📧</div>
                            <div class="contact-item-text">
                                <small>Adresse email</small>
                                <span>aya00sadiq@gmail.com</span>
                            </div>
                        </a>
                        <a href="tel:+212700070007" class="contact-item">
                            <div class="contact-item-icon ci-phone">📞</div>
                            <div class="contact-item-text">
                                <small>Téléphone</small>
                                <span>+212 700 070 007</span>
                            </div>
                        </a>
                        <div class="contact-item" style="cursor:default">
                            <div class="contact-item-icon ci-address">📍</div>
                            <div class="contact-item-text">
                                <small>Adresse</small>
                                <span>Casablanca, Maroc</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="contact-form-card">
                    <h3>Envoyez-nous un message</h3>
                    <p class="sub">Nous vous répondrons dans les plus brefs délais.</p>

                    <form action="#" method="POST" id="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-name">Nom complet</label>
                                <input type="text" id="contact-name" name="name" class="form-input" placeholder="Votre nom" required>
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Email</label>
                                <input type="email" id="contact-email" name="email" class="form-input" placeholder="votre@email.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact-subject">Sujet</label>
                            <input type="text" id="contact-subject" name="subject" class="form-input" placeholder="Ex : Question sur une expédition" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-message">Message</label>
                            <textarea id="contact-message" name="message" class="form-input" placeholder="Décrivez votre demande en détail..." required></textarea>
                        </div>
                        <button type="submit" class="form-submit" id="contact-submit-btn">
                            Envoyer le message ✈️
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ FOOTER ══ -->
    <footer>
        <div class="footer-inner">
            <a href="/" class="footer-logo">
                <div class="footer-logo-icon">TL</div>
                <span>TransportLink Maroc</span>
            </a>
            <p class="footer-copy">&copy; {{ date('Y') }} TransportLink Maroc. Tous droits réservés. Projet Académique Fil Rouge.</p>
            <div class="footer-links">
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}">Inscription</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>
