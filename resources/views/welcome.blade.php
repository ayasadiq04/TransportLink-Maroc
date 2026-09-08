<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TransportLink Maroc — Plateforme N°1 de Transport de Marchandises au Maroc</title>
    <meta name="description" content="Mise en relation directe entre expéditeurs et transporteurs professionnels certifiés partout au Maroc.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

<<<<<<< HEAD
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
=======
    <!-- Scripts & Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-blue-600 selection:text-white">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5S5.17 15.5 6 15.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9 1.96 2.5H17V9.5h2.5zM18 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-extrabold tracking-tight text-slate-900">Transport<span class="text-blue-600">Link</span></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 block -mt-1">Maroc 🇲🇦</span>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                    <a href="#features" class="hover:text-blue-600 transition-colors">Comment ça marche</a>
                    <a href="#services" class="hover:text-blue-600 transition-colors">Nos Services</a>
                    <a href="#transporters" class="text-blue-600 font-bold hover:text-blue-700 transition-colors flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        Espace Transporteurs
                    </a>
                    <a href="#contact" class="hover:text-blue-600 transition-colors">Contact</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md shadow-blue-500/20 transition-all">
                                <span>Mon Tableau de Bord</span>
                                &rarr;
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-blue-600 px-4 py-2 transition-colors">
                                Connexion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg transition-all">
                                    Inscription gratuite
                                </a>
                            @endif
                        @endauth
                    @endif
>>>>>>> 97dea3ab5bdfd0f5de9200a3187f62b5921a949b
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

<<<<<<< HEAD
    <!-- ══ HERO ══ -->
    <section class="hero">
        <div class="hero-inner">
            <!-- Left -->
            <div>
                <div class="hero-badge">
                    <span></span>
                    Réseau actif dans +30 villes du Maroc 🇲🇦
                </div>
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
=======
    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28 bg-gradient-to-b from-white via-blue-50/40 to-slate-50 border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-12 items-center">
                
                <!-- Hero Text -->
                <div class="space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-xs font-bold text-blue-700 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Réseau logistique actif dans tout le Maroc 🇲🇦
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15]">
                        Expédiez vos marchandises au Maroc en toute <span class="text-blue-600">simplicité & sécurité</span>.
                    </h1>

                    <p class="text-lg text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        TransportLink Maroc met en relation directe expéditeurs et transporteurs professionnels certifiés. Publiez votre annonce, recevez des devis compétitifs et suivez votre trajet en direct.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-base font-bold rounded-xl shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                                Accéder à mon compte &rarr;
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-base font-bold rounded-xl shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                                📦 Publier une cargaison
                            </a>
                            <a href="#transporters" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-white hover:bg-slate-50 border-2 border-slate-300 text-slate-800 text-base font-bold rounded-xl shadow-sm transition">
                                🚚 Je suis transporteur
                            </a>
                        @endauth
                    </div>

                    <!-- Chiffres clés -->
                    <div class="grid grid-cols-3 gap-6 pt-6 border-t border-slate-200 max-w-lg mx-auto lg:mx-0">
                        <div>
                            <p class="text-3xl font-extrabold text-slate-900">+1,500</p>
                            <p class="text-xs font-semibold text-slate-500 uppercase mt-0.5">Trajets réussis</p>
                        </div>
                        <div>
                            <p class="text-3xl font-extrabold text-blue-600">100%</p>
                            <p class="text-xs font-semibold text-slate-500 uppercase mt-0.5">Transporteurs certifiés</p>
                        </div>
                        <div>
                            <p class="text-3xl font-extrabold text-emerald-600">4.9 ★</p>
                            <p class="text-xs font-semibold text-slate-500 uppercase mt-0.5">Satisfaction client</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Interactive Visual Card -->
                <div class="relative">
                    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-6 sm:p-8 space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <span class="text-xs font-extrabold uppercase tracking-wider text-slate-400">Exemple de demande active</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                ● En attente de devis
                            </span>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-xl font-extrabold text-slate-900">Transport de palettes industrielles</h3>
                            
                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 space-y-3">
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="w-3.5 h-3.5 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>
                                    <div>
                                        <span class="font-bold text-slate-900">Casablanca</span>
                                        <span class="text-xs text-slate-500 block">Zone Industrielle Ain Sebaâ</span>
                                    </div>
                                </div>
                                <div class="w-0.5 h-4 bg-slate-300 ml-1.5"></div>
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="w-3.5 h-3.5 rounded-full bg-blue-600 ring-4 ring-blue-100"></span>
                                    <div>
                                        <span class="font-bold text-slate-900">Tanger Med</span>
                                        <span class="text-xs text-slate-500 block">Plateforme Logistique</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <div class="bg-blue-50 p-3.5 rounded-xl border border-blue-100">
                                    <span class="text-slate-500 block font-medium">Poids & Volume</span>
                                    <span class="font-bold text-slate-900 text-sm">4.5 Tonnes • 8 Palettes</span>
                                </div>
                                <div class="bg-emerald-50 p-3.5 rounded-xl border border-emerald-100">
                                    <span class="text-slate-500 block font-medium">Budget estimé</span>
                                    <span class="font-black text-emerald-700 text-sm">3,500 DH</span>
                                </div>
>>>>>>> 97dea3ab5bdfd0f5de9200a3187f62b5921a949b
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

<<<<<<< HEAD
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
                    <p>Gérez votre flotte, vos offres et vos trajets depuis un espace dédié. Suivez vos performances et vos avis en temps réel.</p>
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
=======
                        <div class="pt-2">
                            <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center py-3.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow transition">
                                Voir toutes les opportunités de transport &rarr;
                            </a>
>>>>>>> 97dea3ab5bdfd0f5de9200a3187f62b5921a949b
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="contact-form-card">
                    <h3>Envoyez-nous un message</h3>
                    <p class="sub">Nous vous répondrons dans les plus brefs délais.</p>

<<<<<<< HEAD
                    <form action="#" method="POST" onsubmit="handleContact(event)">
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
=======
    <!-- Section Comment ça marche -->
    <section id="features" class="py-20 bg-white border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-3.5 py-1 rounded-full border border-blue-200">
                    Simple, Rapide et Efficace
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Comment fonctionne TransportLink ?</h2>
                <p class="text-slate-600 text-sm sm:text-base">Une procédure fluide conçue pour vous faire gagner du temps et réduire vos coûts logistiques.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 space-y-4 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-blue-600 text-white font-black text-xl flex items-center justify-center shadow-md shadow-blue-500/20">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Publiez votre demande</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Précisez la ville de départ, la destination, le poids, les dates souhaitées et vos exigences particulières en quelques secondes.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 space-y-4 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white font-black text-xl flex items-center justify-center shadow-md shadow-emerald-500/20">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Recevez des offres directes</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Des transporteurs certifiés et disponibles vous soumettent leurs meilleurs devis et types de véhicules adaptés.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 space-y-4 hover:shadow-lg transition">
                    <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white font-black text-xl flex items-center justify-center shadow-md shadow-indigo-500/20">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Suivez et Validez</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Acceptez l'offre qui vous convient, suivez l'acheminement de la mission et notez le transporteur une fois la livraison confirmée.
                    </p>
>>>>>>> 97dea3ab5bdfd0f5de9200a3187f62b5921a949b
                </div>
            </div>
        </div>
    </section>

<<<<<<< HEAD
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
=======
    <!-- Types de cargaisons acceptées -->
    <section id="services" class="py-20 bg-slate-50 border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                    Polyvalence Totale
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Toutes les cargaisons prises en charge</h2>
                <p class="text-slate-600 text-sm sm:text-base">Notre réseau s'adapte à tous vos volumes de fret partout au Maroc.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center space-y-3 hover:border-blue-400 transition">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-3xl">📦</div>
                    <h4 class="font-bold text-slate-900 text-base">Colis & Meubles</h4>
                    <p class="text-xs text-slate-500">Déménagements, électroménager et biens fragiles.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center space-y-3 hover:border-emerald-400 transition">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl">🏗️</div>
                    <h4 class="font-bold text-slate-900 text-base">Palettes & Fret</h4>
                    <p class="text-xs text-slate-500">Marchandises palettisées pour usines et grossistes.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center space-y-3 hover:border-cyan-400 transition">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-3xl">❄️</div>
                    <h4 class="font-bold text-slate-900 text-base">Frigorifique</h4>
                    <p class="text-xs text-slate-500">Produits frais et surgelés sous température dirigée.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-center space-y-3 hover:border-amber-400 transition">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-3xl">🚛</div>
                    <h4 class="font-bold text-slate-900 text-base">Vrac & Matériaux</h4>
                    <p class="text-xs text-slate-500">Agrégats, sable, matériaux de construction et bennes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ESPACE TRANSPORTEURS (REDESIGN CLAIR, LUMINEUX & MODERNE) -->
    <section id="transporters" class="py-24 bg-gradient-to-b from-blue-50/70 via-indigo-50/40 to-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-100 border border-blue-300 text-xs font-extrabold text-blue-800 shadow-sm">
                    🚚 Espace Dédié aux Professionnels du Transport
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                    Vous possédez un ou plusieurs véhicules ? <br>
                    <span class="text-blue-600">Rentabilisez vos trajets au Maroc</span>
                </h2>
                <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-normal">
                    Rejoignez le réseau officiel TransportLink. Fini les retours à vide : trouvez des expéditeurs fiables, gérez vos véhicules et augmentez votre chiffre d'affaires.
                </p>
            </div>

            <!-- Main Content: 2 Columns with Vibrant High-Contrast Cards -->
            <div class="grid lg:grid-cols-12 gap-8 items-stretch">
                
                <!-- Left Column: 4 Key Benefits -->
                <div class="lg:col-span-7 grid sm:grid-cols-2 gap-4">
                    
                    <!-- Benefit 1: Rentabilité -->
                    <div class="bg-white rounded-2xl p-6 border-2 border-emerald-200 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl font-black mb-4">
                            💰
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-lg">Zéro Retour à Vide</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                            Complétez vos trajets retour en trouvant des chargements disponibles sur votre itinéraire exact.
                        </p>
                    </div>

                    <!-- Benefit 2: Gestion Flotte -->
                    <div class="bg-white rounded-2xl p-6 border-2 border-blue-200 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl font-black mb-4">
                            📋
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-lg">Gestion de Flotte</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                            Enregistrez vos camionnettes, porteurs ou semi-remorques et assignez-les facilement à chaque mission.
                        </p>
                    </div>

                    <!-- Benefit 3: Négociation Directe -->
                    <div class="bg-white rounded-2xl p-6 border-2 border-amber-200 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-2xl font-black mb-4">
                            ⚡
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-lg">Devis Directs</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                            Proposez vos prix en fonction de vos capacités, sans frais cachés ni commissions abusives.
                        </p>
                    </div>

                    <!-- Benefit 4: Avis & Notoriété -->
                    <div class="bg-white rounded-2xl p-6 border-2 border-indigo-200 shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-2xl font-black mb-4">
                            ⭐
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-lg">Profil & Avis Clients</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                            Bâtissez une réputation solide grâce aux notes et avis authentiques laissés par vos clients.
                        </p>
                    </div>

                    <!-- CTA Action Banner inside Left Column -->
                    <div class="sm:col-span-2 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 text-white flex flex-col sm:flex-row items-center justify-between gap-4 shadow-lg shadow-blue-500/20">
                        <div>
                            <h4 class="font-black text-lg">Prêt à développer votre activité ?</h4>
                            <p class="text-xs text-blue-100 mt-0.5">Inscription 100% gratuite pour les transporteurs au Maroc.</p>
                        </div>
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-white hover:bg-slate-100 text-blue-700 font-extrabold text-sm rounded-xl shadow transition whitespace-nowrap">
                            Créer mon compte transporteur &rarr;
                        </a>
                    </div>

                </div>

                <!-- Right Column: Vehicle Showcase Card -->
                <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border-2 border-slate-200 shadow-xl flex flex-col justify-between space-y-6">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                            <h3 class="text-lg font-extrabold text-slate-900">Véhicules acceptés</h3>
                            <span class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-800">
                                Inscription Ouverte
                            </span>
                        </div>
                        
                        <div class="space-y-3">
                            <!-- Vehicle 1 -->
                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🚐</span>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">Fourgons & Utilitaires</h4>
                                        <p class="text-xs text-slate-500">Jusqu'à 3.5 Tonnes</p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-200">Express</span>
                            </div>

                            <!-- Vehicle 2 -->
                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🚚</span>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">Camions Porteurs</h4>
                                        <p class="text-xs text-slate-500">De 3.5T à 19 Tonnes</p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">Régional</span>
                            </div>

                            <!-- Vehicle 3 -->
                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-200">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🚛</span>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">Semi-remorques & Plateaux</h4>
                                        <p class="text-xs text-slate-500">Jusqu'à 40 Tonnes</p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200">National</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('register') }}" class="flex-1 text-center py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                            Rejoindre le réseau
                        </a>
                        <a href="{{ route('login') }}" class="flex-1 text-center py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs rounded-xl transition">
                            Espace Connexion
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section id="contact" class="py-20 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-3.5 py-1 rounded-full border border-blue-200">
                    Support & Assistance
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900">Une question ? Contactez notre équipe</h2>
                <p class="text-slate-600 text-sm sm:text-base">Nos conseillers logistiques vous accompagnent du lundi au samedi pour toutes vos opérations au Maroc.</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Coordonnées 1: E-mail -->
                <div class="p-8 rounded-2xl bg-slate-50 border-2 border-slate-200 space-y-3 text-center hover:border-blue-400 hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center mx-auto shadow-md shadow-blue-500/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-lg">Par E-mail</h3>
                    <p class="text-xs text-slate-500">Pour toute demande commerciale ou assistance</p>
                    <a href="mailto:contact@transportlink.ma" class="text-sm font-bold text-blue-600 hover:underline block pt-2">
                        contact@transportlink.ma
                    </a>
                </div>

                <!-- Coordonnées 2: Téléphone -->
                <div class="p-8 rounded-2xl bg-slate-50 border-2 border-slate-200 space-y-3 text-center hover:border-emerald-400 hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center mx-auto shadow-md shadow-emerald-500/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-lg">Par Téléphone</h3>
                    <p class="text-xs text-slate-500">Du Lundi au Samedi de 08h30 à 19h00</p>
                    <a href="tel:+212522000000" class="text-sm font-bold text-emerald-700 hover:underline block pt-2">
                        +212 5 22 00 00 00
                    </a>
                </div>

                <!-- Coordonnées 3: Couverture -->
                <div class="p-8 rounded-2xl bg-slate-50 border-2 border-slate-200 space-y-3 text-center hover:border-indigo-400 hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center mx-auto shadow-md shadow-indigo-500/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-lg">Présence Nationale</h3>
                    <p class="text-xs text-slate-500">Hubs à Casablanca, Tanger Med, Marrakech, Agadir</p>
                    <p class="text-sm font-bold text-indigo-700 pt-2">
                        Actif dans plus de 30 villes 🇲🇦
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-slate-800 pb-8">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold">
                        TL
                    </div>
                    <span class="text-lg font-black text-white">TransportLink <span class="text-blue-400">Maroc</span></span>
                </div>
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} TransportLink Maroc. Tous droits réservés.
                </p>
                <div class="flex flex-wrap justify-center gap-6 text-xs font-semibold">
                    <a href="#features" class="hover:text-white transition-colors">Comment ça marche</a>
                    <a href="#services" class="hover:text-white transition-colors">Services</a>
                    <a href="#transporters" class="text-blue-400 hover:text-white transition-colors">Transporteurs</a>
                    <a href="#contact" class="hover:text-white transition-colors">Contact</a>
                    <a href="{{ route('login') }}" class="hover:text-white transition-colors">Connexion</a>
                    <a href="{{ route('register') }}" class="hover:text-white transition-colors">Inscription</a>
                </div>
>>>>>>> 97dea3ab5bdfd0f5de9200a3187f62b5921a949b
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const target = document.querySelector(a.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Contact form handler (demo — no backend submission yet)
        function handleContact(e) {
            e.preventDefault();
            const btn = document.getElementById('contact-submit-btn');
            btn.textContent = '✅ Message envoyé !';
            btn.style.background = 'linear-gradient(135deg,#10b981,#059669)';
            btn.disabled = true;
            setTimeout(() => {
                btn.textContent = 'Envoyer le message ✈️';
                btn.style.background = '';
                btn.disabled = false;
                e.target.reset();
            }, 3000);
        }
    </script>

</body>
</html>
