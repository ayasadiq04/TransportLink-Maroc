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
                </div>
            </div>
        </div>
    </header>

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
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center py-3.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow transition">
                                Voir toutes les opportunités de transport &rarr;
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

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
                </div>
            </div>
        </div>
    </section>

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
            </div>
        </div>
    </footer>

</body>
</html>
