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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Inter',sans-serif] antialiased bg-gray-50 text-gray-900">

    <!-- ══ NAVBAR ══ -->
<header
    x-data="{ mobileOpen: false }"
    @keydown.escape.window="mobileOpen = false"
    @click.outside="mobileOpen = false"
    class="sticky top-0 z-50 bg-white border-b border-gray-100"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between gap-4 h-[68px]">

        <!-- Logo -->
        <a href="/" class="shrink-0">
            <x-application-logo />
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-7 xl:gap-8">
            <a
                href="#features"
                class="text-sm font-semibold text-gray-500 transition-colors duration-200 hover:text-indigo-600"
            >
                Comment ça marche
            </a>

            <a
                href="#services"
                class="text-sm font-semibold text-gray-500 transition-colors duration-200 hover:text-indigo-600"
            >
                Nos Services
            </a>

            <a
                href="#transporters"
                class="text-sm font-semibold text-gray-500 transition-colors duration-200 hover:text-indigo-600"
            >
                Espace Transporteurs
            </a>

            <a
                href="#contact"
                class="text-sm font-semibold text-gray-500 transition-colors duration-200 hover:text-indigo-600"
            >
                Contact
            </a>
        </nav>

        <!-- Desktop Buttons -->
        <div class="hidden lg:flex items-center gap-2.5">
            @if (Route::has('login'))

                @auth

                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-flex items-center gap-1.5 px-[22px] py-[9px] rounded-[10px] bg-indigo-600 text-white text-[0.85rem] font-bold shadow-[0_2px_8px_rgba(79,70,229,0.3)] transition-all duration-200 hover:bg-indigo-900 hover:shadow-[0_4px_16px_rgba(79,70,229,0.4)] hover:-translate-y-px"
                    >
                        Mon Tableau de Bord &rarr;
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="px-5 py-2 rounded-[10px] border-[1.5px] border-gray-200 bg-white text-[0.85rem] font-semibold text-gray-700 transition-all duration-200 hover:border-indigo-600 hover:text-indigo-600"
                    >
                        Connexion
                    </a>

                    @if (Route::has('register'))

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center gap-1.5 px-[22px] py-[9px] rounded-[10px] bg-indigo-600 text-white text-[0.85rem] font-bold shadow-[0_2px_8px_rgba(79,70,229,0.3)] transition-all duration-200 hover:bg-indigo-900 hover:shadow-[0_4px_16px_rgba(79,70,229,0.4)] hover:-translate-y-px"
                        >
                            Inscription gratuite
                        </a>

                    @endif

                @endauth

            @endif
        </div>

        <!-- Mobile Menu Button -->
        <button
            type="button"@click="mobileOpen = !mobileOpen":aria-expanded="mobileOpen"aria-controls="mobile-nav"aria-label="Ouvrir le menu"
            class="lg:hidden inline-flex items-center justify-center shrink-0 w-10 h-10 rounded-lg border border-gray-200 bg-white text-gray-700 transition-colors duration-200 hover:border-indigo-600 hover:text-indigo-600"
        >

            <!-- Menu Icon -->
            <svg x-show="!mobileOpen" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" >
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>

            <!-- Close Icon -->
            <svg
                x-show="mobileOpen"
                class="w-5 h-5"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
            >
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>

        </button>

    </div>

    <!-- Mobile Navigation -->
    <div
        id="mobile-nav"
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden border-t border-gray-100 bg-white px-4 sm:px-6 py-5 shadow-[0_16px_40px_rgba(0,0,0,0.08)]"
    >

        <nav class="flex flex-col gap-1">

            <a
                href="#features"
                @click="mobileOpen = false"
                class="px-3 py-2.5 rounded-lg text-sm font-semibold text-gray-700 transition-colors duration-200 hover:bg-gray-50 hover:text-indigo-600"
            >
                Comment ça marche
            </a>

            <a
                href="#services"
                @click="mobileOpen = false"
                class="px-3 py-2.5 rounded-lg text-sm font-semibold text-gray-700 transition-colors duration-200 hover:bg-gray-50 hover:text-indigo-600"
            >
                Nos Services
            </a>

            <a
                href="#transporters"
                @click="mobileOpen = false"
                class="px-3 py-2.5 rounded-lg text-sm font-semibold text-gray-700 transition-colors duration-200 hover:bg-gray-50 hover:text-indigo-600"
            >
                Espace Transporteurs
            </a>

            <a
                href="#contact"
                @click="mobileOpen = false"
                class="px-3 py-2.5 rounded-lg text-sm font-semibold text-gray-700 transition-colors duration-200 hover:bg-gray-50 hover:text-indigo-600"
            >
                Contact
            </a>

        </nav>

        <!-- Mobile Buttons -->
        <div class="flex flex-col gap-2.5 mt-4 pt-4 border-t border-gray-100">

            @if (Route::has('login'))

                @auth

                    <a
                        href="{{ url('/dashboard') }}"
                        @click="mobileOpen = false"
                        class="inline-flex items-center justify-center gap-1.5 px-5 py-3 rounded-[10px] bg-indigo-600 text-white text-sm font-bold shadow-[0_2px_8px_rgba(79,70,229,0.3)] transition-all duration-200 hover:bg-indigo-900"
                    >
                        Mon Tableau de Bord &rarr;
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        @click="mobileOpen = false"
                        class="inline-flex items-center justify-center rounded-[10px] border-[1.5px] border-gray-200 bg-white text-gray-700 text-sm font-semibold px-5 py-3 transition-all duration-200 hover:border-indigo-600 hover:text-indigo-600"
                    >
                        Connexion
                    </a>

                    @if (Route::has('register'))

                        <a
                            href="{{ route('register') }}"
                            @click="mobileOpen = false"
                            class="inline-flex items-center justify-center gap-1.5 px-5 py-3 rounded-[10px] bg-indigo-600 text-white text-sm font-bold shadow-[0_2px_8px_rgba(79,70,229,0.3)] transition-all duration-200 hover:bg-indigo-900"
                        >
                            Inscription gratuite
                        </a>

                    @endif

                @endauth

            @endif

        </div>

    </div>

</header>

     <!-- ══ HERO ══ -->
    <section class="relative min-h-screen flex items-center bg-[url('/images/hero-truck.png')] bg-cover bg-center bg-no-repeat overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/70 to-gray-900/30"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-6 lg:px-10 w-full py-28 sm:py-32 lg:py-0">
            <div class="max-w-[620px]">
                <p class="text-xs font-bold tracking-[0.25em] text-indigo-300 mb-5 uppercase">Transport &bull; Logistique &bull; Maroc</p>

                <h1 class="text-[2rem] sm:text-[2.5rem] lg:text-[3.75rem] font-black leading-[1.08] tracking-[-0.02em] text-white mb-6">
                    Le transport de marchandises,<br>
                    <span class="bg-gradient-to-r from-violet-400 to-blue-400 bg-clip-text text-transparent">plus simple.</span>
                </h1>

                <p class="text-base sm:text-lg text-white/70 leading-7 sm:leading-8 max-w-[520px] mb-8 sm:mb-9">TransportLink Maroc met en relation les clients et les transporteurs pour un transport de marchandises plus rapide, plus sûr et plus efficace partout au Maroc.</p>

                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-7 py-3.5 rounded-xl bg-indigo-600 text-white font-bold text-[0.95rem] shadow-[0_6px_24px_rgba(79,70,229,0.5)] transition-all duration-200 hover:bg-indigo-500 hover:-translate-y-0.5 hover:shadow-[0_10px_30px_rgba(79,70,229,0.5)]">Trouver un transport &rarr;</a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-7 py-3.5 rounded-xl bg-indigo-600 text-white font-bold text-[0.95rem] shadow-[0_6px_24px_rgba(79,70,229,0.5)] transition-all duration-200 hover:bg-indigo-500 hover:-translate-y-0.5 hover:shadow-[0_10px_30px_rgba(79,70,229,0.5)]">Trouver un transport &rarr;</a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-7 py-3.5 rounded-xl bg-white/10 border border-white/25 text-white font-bold text-[0.95rem] backdrop-blur-sm transition-all duration-200 hover:bg-white/20 hover:border-white/40">Devenir transporteur</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
    <!-- ══ COMMENT ÇA MARCHE ══ -->
    <section id="features" class="px-6 py-24 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-14">
                <span class="inline-block text-[0.72rem] font-bold uppercase tracking-[0.08em] px-3.5 py-[5px] rounded-full mb-3.5 bg-indigo-100 text-indigo-800">Simple et Efficace</span>
                <h2 class="text-[1.8rem] sm:text-[2.4rem] font-black text-gray-900 tracking-[-0.03em] mb-3.5">Comment fonctionne TransportLink ?</h2>
                <p class="text-base text-gray-500 max-w-[560px] mx-auto leading-relaxed">Une procédure fluide conçue pour vous faire gagner du temps et économiser sur vos coûts logistiques.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-50 border border-gray-100 rounded-[20px] p-8 transition-all duration-300 hover:shadow-[0_12px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-[14px] text-[1.2rem] font-black text-white flex items-center justify-center mb-[18px] shadow-[0_4px_14px_rgba(79,70,229,0.4)] bg-indigo-600">1</div>
                    <h3 class="text-[1.15rem] font-extrabold text-gray-900 mb-2.5">Publiez votre demande</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Précisez les villes de départ et d'arrivée, la nature de la cargaison, le poids, les dates souhaitées et votre budget indicatif.</p>
                </div>
                <div class="bg-gray-50 border border-gray-100 rounded-[20px] p-8 transition-all duration-300 hover:shadow-[0_12px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-[14px] text-[1.2rem] font-black text-white flex items-center justify-center mb-[18px] shadow-[0_4px_14px_rgba(16,185,129,0.4)] bg-emerald-500">2</div>
                    <h3 class="text-[1.15rem] font-extrabold text-gray-900 mb-2.5">Recevez des devis directs</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Des transporteurs certifiés consultent votre offre et vous proposent leurs meilleurs tarifs avec les véhicules adaptés.</p>
                </div>
                <div class="bg-gray-50 border border-gray-100 rounded-[20px] p-8 transition-all duration-300 hover:shadow-[0_12px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-[14px] text-[1.2rem] font-black text-white flex items-center justify-center mb-[18px] shadow-[0_4px_14px_rgba(139,92,246,0.4)] bg-violet-500">3</div>
                    <h3 class="text-[1.15rem] font-extrabold text-gray-900 mb-2.5">Suivez et Évaluez</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Acceptez l'offre idéale, suivez le statut de livraison (En attente → En cours → Livrée) et notez la prestation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ SERVICES ══ -->
    <section id="services" class="px-6 py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-14">
                <span class="inline-block text-[0.72rem] font-bold uppercase tracking-[0.08em] px-3.5 py-[5px] rounded-full mb-3.5 bg-emerald-100 text-emerald-800">Polyvalence</span>
                <h2 class="text-[1.8rem] sm:text-[2.4rem] font-black text-gray-900 tracking-[-0.03em] mb-3.5">Toutes les cargaisons prises en charge</h2>
                <p class="text-base text-gray-500 max-w-[560px] mx-auto leading-relaxed">Notre flotte de transporteurs s'adapte à tous vos besoins de livraison à travers le Maroc.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white border border-gray-100 rounded-[18px] px-5 py-7 text-center transition-all duration-300 hover:shadow-[0_12px_32px_rgba(0,0,0,0.1)] hover:-translate-y-1 shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
                    <div class="text-[2.2rem] mb-3.5">📦</div>
                    <h4 class="text-sm font-extrabold text-gray-900 mb-2">Colis volumineux & Meubles</h4>
                    <p class="text-[0.78rem] text-gray-400 leading-relaxed">Déménagements, électroménager et biens fragiles avec emballage sécurisé.</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-[18px] px-5 py-7 text-center transition-all duration-300 hover:shadow-[0_12px_32px_rgba(0,0,0,0.1)] hover:-translate-y-1 shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
                    <div class="text-[2.2rem] mb-3.5">🏗️</div>
                    <h4 class="text-sm font-extrabold text-gray-900 mb-2">Palettes & Fret Industriel</h4>
                    <p class="text-[0.78rem] text-gray-400 leading-relaxed">Marchandises palettisées pour usines, entrepôts et grossistes.</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-[18px] px-5 py-7 text-center transition-all duration-300 hover:shadow-[0_12px_32px_rgba(0,0,0,0.1)] hover:-translate-y-1 shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
                    <div class="text-[2.2rem] mb-3.5">❄️</div>
                    <h4 class="text-sm font-extrabold text-gray-900 mb-2">Transport Frigorifique</h4>
                    <p class="text-[0.78rem] text-gray-400 leading-relaxed">Produits frais et surgelés sous température dirigée et contrôlée.</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-[18px] px-5 py-7 text-center transition-all duration-300 hover:shadow-[0_12px_32px_rgba(0,0,0,0.1)] hover:-translate-y-1 shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
                    <div class="text-[2.2rem] mb-3.5">🚛</div>
                    <h4 class="text-sm font-extrabold text-gray-900 mb-2">Vrac & Matériaux</h4>
                    <p class="text-[0.78rem] text-gray-400 leading-relaxed">Agrégats, sable, matériaux de construction et bennes basculantes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ ESPACE TRANSPORTEURS ══ -->
    <section id="transporters" class="px-6 py-24 bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-14">
                <span class="inline-block text-[0.72rem] font-bold uppercase tracking-[0.08em] px-3.5 py-[5px] rounded-full mb-3.5 bg-amber-100 text-amber-900">Pour les Professionnels du Transport</span>
                <h2 class="text-[1.8rem] sm:text-[2.4rem] font-black text-white tracking-[-0.03em] mb-3.5">Rejoignez notre réseau de transporteurs</h2>
                <p class="text-base text-slate-400 max-w-[560px] mx-auto leading-relaxed">Accédez à des centaines de demandes de transport chaque mois et développez votre activité au Maroc.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <div class="bg-white/[0.06] border border-white/10 rounded-[20px] p-7 transition-all duration-300 hover:bg-white/[0.1] hover:-translate-y-1 hover:border-indigo-400/50">
                    <div class="w-[52px] h-[52px] rounded-[14px] flex items-center justify-center text-[1.4rem] mb-[18px] bg-indigo-500/25">🎯</div>
                    <h3 class="text-base font-extrabold text-white mb-2.5">Offres ciblées pour vous</h3>
                    <p class="text-[0.83rem] text-slate-400 leading-relaxed">Recevez uniquement des demandes correspondant à votre zone géographique, votre type de véhicule et vos disponibilités.</p>
                </div>
                <div class="bg-white/[0.06] border border-white/10 rounded-[20px] p-7 transition-all duration-300 hover:bg-white/[0.1] hover:-translate-y-1 hover:border-indigo-400/50">
                    <div class="w-[52px] h-[52px] rounded-[14px] flex items-center justify-center text-[1.4rem] mb-[18px] bg-emerald-500/25">💰</div>
                    <h3 class="text-base font-extrabold text-white mb-2.5">Revenus garantis</h3>
                    <p class="text-[0.83rem] text-slate-400 leading-relaxed">Proposez vos tarifs librement, signez vos contrats directement avec les expéditeurs et percevez vos paiements en toute sécurité.</p>
                </div>
                <div class="bg-white/[0.06] border border-white/10 rounded-[20px] p-7 transition-all duration-300 hover:bg-white/[0.1] hover:-translate-y-1 hover:border-indigo-400/50">
                    <div class="w-[52px] h-[52px] rounded-[14px] flex items-center justify-center text-[1.4rem] mb-[18px] bg-violet-500/25">📊</div>
                    <h3 class="text-base font-extrabold text-white mb-2.5">Dashboard professionnel</h3>
                    <p class="text-[0.83rem] text-slate-400 leading-relaxed">Gérez votre flotte, vos offres et vos trajets depuis un espace dédié. Suivez vos performances en temps réel.</p>
                </div>
            </div>

            <div class="flex gap-3.5 justify-center flex-wrap">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-8 py-3.5 rounded-xl bg-white text-gray-900 font-bold text-sm shadow-[0_4px_14px_rgba(0,0,0,0.2)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(0,0,0,0.3)]">Accéder à mon espace &rarr;</a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-3.5 rounded-xl bg-white text-gray-900 font-bold text-sm shadow-[0_4px_14px_rgba(0,0,0,0.2)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(0,0,0,0.3)]">S'inscrire comme transporteur &rarr;</a>
                    <a href="{{ route('login') }}" class="px-8 py-3.5 rounded-xl bg-transparent text-white border-[1.5px] border-white/25 font-bold text-sm transition-all duration-200 hover:border-white hover:bg-white/10">Déjà inscrit ? Connexion</a>
                @endauth
            </div>
        </div>
    </section>

    <!-- ══ CONTACT ══ -->
    <section id="contact" class="px-6 py-24 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 items-start">
                <!-- Info -->
                <div class="max-w-[640px] mx-auto w-full">
                    <span class="inline-block text-[0.72rem] font-bold uppercase tracking-[0.08em] px-3.5 py-[5px] rounded-full mb-3.5 bg-rose-100 text-rose-900">Nous contacter</span>
                    <h2 class="text-[2.2rem] font-black text-gray-900 tracking-[-0.03em] mb-3.5">Une question ? <br>On est là pour vous.</h2>
                    <p class="text-base text-gray-500 leading-7 mb-9">Notre équipe est disponible du lundi au vendredi de 9h à 18h pour répondre à toutes vos questions concernant la plateforme ou vos expéditions.</p>

                    <div class="flex flex-col gap-5">
                        <a href="mailto:aya00sadiq@gmail.com" class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-gray-50 border border-gray-100 ">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 text-[1.2rem] bg-indigo-100">📧</div>
                            <div>
                                <small class="block text-[0.72rem] font-bold uppercase tracking-[0.07em] text-gray-400 mb-0.5">Adresse email</small>
                                <span class="text-sm font-bold text-gray-900 break-words">ayasadiq@gmail.com</span>
                            </div>
                        </a>
                        <a href="tel:+212700070007" class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-gray-50 border border-gray-100 ">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 text-[1.2rem] bg-emerald-100">📞</div>
                            <div>
                                <small class="block text-[0.72rem] font-bold uppercase tracking-[0.07em] text-gray-400 mb-0.5">Téléphone</small>
                                <span class="text-sm font-bold text-gray-900">+212 700 070 007</span>
                            </div>
                        </a>
                        <div class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-gray-50 border border-gray-100  cursor-default">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 text-[1.2rem] bg-amber-100">📍</div>
                            <div>
                                <small class="block text-[0.72rem] font-bold uppercase tracking-[0.07em] text-gray-400 mb-0.5">Adresse</small>
                                <span class="text-sm font-bold text-gray-900">fquih ben saleh, Maroc</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ FOOTER ══ -->
    <footer class="bg-slate-900 text-slate-500 px-6 py-12">
        <div class="max-w-7xl mx-auto flex items-center justify-between flex-wrap gap-5 pb-6 border-b border-slate-800 mb-6">
            <a href="/" class="shrink-0">
                <x-application-logo :dark="true" size="sm" />
            </a>
            <p class="text-[0.78rem] text-slate-600">&copy; {{ date('Y') }} TransportLink Maroc. Tous droits réservés. Projet Académique Fil Rouge.</p>
            <div class="flex gap-5">
                <a href="{{ route('login') }}" class="text-[0.8rem] font-semibold text-slate-500 transition-colors duration-200 hover:text-white">Connexion</a>
                <a href="{{ route('register') }}" class="text-[0.8rem] font-semibold text-slate-500 transition-colors duration-200 hover:text-white">Inscription</a>
                <a href="#contact" class="text-[0.8rem] font-semibold text-slate-500 transition-colors duration-200 hover:text-white">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>