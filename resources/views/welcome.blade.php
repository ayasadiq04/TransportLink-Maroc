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
    @vite(['resources/css/app.css'])
</head>
<body style="font-family: 'Inter', sans-serif" class="antialiased bg-gray-50 text-gray-900">

    <!-- ══ NAVBAR ══ -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-[72px]">
            <a href="/" class="flex items-center gap-3">
                <div class="w-[42px] h-[42px] rounded-xl bg-gradient-to-br from-indigo-600 to-indigo-500 flex items-center justify-center shadow-[0_4px_14px_rgba(79,70,229,0.35)]">
                    <svg class="w-[22px] h-[22px] text-white stroke-white fill-none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                    </svg>
                </div>
                <div class="leading-none">
                    <span class="block text-lg font-black text-gray-900 tracking-[-0.02em]">TransportLink</span>
                    <small class="block text-[0.62rem] font-bold uppercase tracking-[0.1em] text-emerald-500 -mt-px">Maroc</small>
                </div>
            </a>

            <nav class="hidden sm:flex items-center gap-8">
                <a href="#features" class="text-sm font-semibold text-gray-500 transition-colors duration-200 hover:text-indigo-600">Comment ça marche</a>
                <a href="#services" class="text-sm font-semibold text-gray-500 transition-colors duration-200 hover:text-indigo-600">Nos Services</a>
                <a href="#transporters" class="text-sm font-semibold text-gray-500 transition-colors duration-200 hover:text-indigo-600">Espace Transporteurs</a>
                <a href="#contact" class="text-sm font-semibold text-gray-500 transition-colors duration-200 hover:text-indigo-600">Contact</a>
            </nav>

            <div class="flex items-center gap-2.5">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-1.5 px-[22px] py-[9px] rounded-[10px] bg-indigo-600 text-white text-[0.85rem] font-bold shadow-[0_2px_8px_rgba(79,70,229,0.3)] transition-all duration-200 hover:bg-indigo-900 hover:shadow-[0_4px_16px_rgba(79,70,229,0.4)] hover:-translate-y-px">Mon Tableau de Bord &rarr;</a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 rounded-[10px] border-[1.5px] border-gray-200 bg-transparent text-[0.85rem] font-semibold text-gray-700 transition-all duration-200 hover:border-indigo-600 hover:text-indigo-600">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-1.5 px-[22px] py-[9px] rounded-[10px] bg-indigo-600 text-white text-[0.85rem] font-bold shadow-[0_2px_8px_rgba(79,70,229,0.3)] transition-all duration-200 hover:bg-indigo-900 hover:shadow-[0_4px_16px_rgba(79,70,229,0.4)] hover:-translate-y-px">Inscription gratuite</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- ══ HERO ══ -->
    <section class="relative overflow-hidden px-6 pt-20 pb-[100px] bg-[linear-gradient(160deg,#ffffff_0%,#eef2ff_50%,#f0fdf4_100%)]">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left -->
            <div>
                <h1 class="text-[2rem] sm:text-[2.6rem] lg:text-[3.5rem] font-black leading-[1.1] tracking-[-0.04em] text-gray-900 mb-5">Expédiez vos marchandises en toute <em class="font-normal bg-gradient-to-br from-indigo-600 to-emerald-500 bg-clip-text text-transparent">simplicité & sécurité</em>.</h1>
                <p class="text-[1.05rem] text-gray-500 leading-7 max-w-[480px] mb-8">TransportLink Maroc met en relation expéditeurs et transporteurs vérifiés. Publiez votre annonce, comparez les devis et suivez votre trajet en temps réel.</p>

                <div class="flex gap-3 flex-wrap mb-12">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-8 py-3.5 rounded-xl bg-indigo-600 text-white font-bold text-[0.95rem] shadow-[0_4px_20px_rgba(79,70,229,0.4)] transition-all duration-200 hover:bg-indigo-900 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(79,70,229,0.45)]">Accéder à mon compte &rarr;</a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-3.5 rounded-xl bg-indigo-600 text-white font-bold text-[0.95rem] shadow-[0_4px_20px_rgba(79,70,229,0.4)] transition-all duration-200 hover:bg-indigo-900 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(79,70,229,0.45)]">Publier une cargaison &rarr;</a>
                        <a href="{{ route('login') }}" class="px-7 py-3.5 rounded-xl bg-white border-[1.5px] border-gray-200 text-gray-700 font-bold text-[0.95rem] transition-all duration-200 hover:border-indigo-500 hover:text-indigo-600">Je suis transporteur</a>
                    @endauth
                </div>

                <div class="grid grid-cols-3 gap-4 pt-8 border-t border-gray-200 max-w-[480px]">
                    <div>
                        <p class="text-[1.8rem] font-black text-gray-900">+1,500</p>
                        <small class="text-[0.7rem] font-semibold uppercase tracking-[0.06em] text-gray-400">Trajets réalisés</small>
                    </div>
                    <div>
                        <p class="text-[1.8rem] font-black text-gray-900">100%</p>
                        <small class="text-[0.7rem] font-semibold uppercase tracking-[0.06em] text-gray-400">Transporteurs vérifiés</small>
                    </div>
                    <div>
                        <p class="text-[1.8rem] font-black text-emerald-500">4.9/5</p>
                        <small class="text-[0.7rem] font-semibold uppercase tracking-[0.06em] text-gray-400">Satisfaction client</small>
                    </div>
                </div>
            </div>

            <!-- Right: Demo card -->
            <div>
                <div class="relative overflow-hidden bg-white rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.1)] border border-gray-100 p-7 before:absolute before:top-[-50%] before:right-[-50%] before:w-[200%] before:h-[200%] before:content-[''] before:bg-[radial-gradient(ellipse_at_center,rgba(79,70,229,0.05)_0%,transparent_70%)] before:pointer-events-none">
                    <div class="flex items-center justify-between mb-5 pb-4 border-b border-gray-100">
                        <span class="text-[0.72rem] font-bold uppercase tracking-[0.07em] text-gray-400">Dernière demande active</span>
                        <span class="bg-emerald-100 text-emerald-800 text-[0.72rem] font-bold px-2.5 py-1 rounded-full">En attente de devis</span>
                    </div>
                    <div class="text-lg font-extrabold text-gray-900 mb-3.5">Transport de palettes alimentaires</div>
                    <div class="bg-gray-50 rounded-2xl p-4 mb-4">
                        <div class="flex items-center gap-2.5 text-sm">
                            <div class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_0_4px_#d1fae5]"></div>
                            <div>
                                <div class="font-bold text-gray-900">Casablanca</div>
                                <div class="text-[0.72rem] text-gray-400">Zone Industrielle Ain Sebaâ</div>
                            </div>
                        </div>
                        <div class="w-0.5 h-4 bg-gray-200 ml-[5px]"></div>
                        <div class="flex items-center gap-2.5 text-sm mt-2.5">
                            <div class="w-3 h-3 rounded-full bg-rose-500 shadow-[0_0_0_4px_#ffe4e6]"></div>
                            <div>
                                <div class="font-bold text-gray-900">Tanger Med</div>
                                <div class="text-[0.72rem] text-gray-400">Plateforme Logistique</div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2.5 mb-[18px]">
                        <div class="bg-indigo-100 rounded-[10px] px-3 py-2.5">
                            <small class="block text-[0.68rem] text-gray-500 mb-0.5">Poids & Volume</small>
                            <span class="font-extrabold text-sm text-gray-900">4.5 T • 8 Palettes</span>
                        </div>
                        <div class="bg-indigo-100 rounded-[10px] px-3 py-2.5">
                            <small class="block text-[0.68rem] text-gray-500 mb-0.5">Budget estimé</small>
                            <span class="font-extrabold text-base text-emerald-500">3,500 DH</span>
                        </div>
                    </div>
                    <a href="{{ route('register') }}" class="block w-full py-3 text-center bg-gray-900 text-white font-bold text-[0.8rem] rounded-xl transition-all duration-200 hover:bg-black">Voir toutes les opportunités &rarr;</a>
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
                        <a href="mailto:aya00sadiq@gmail.com" class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-gray-50 border border-gray-100 transition-all duration-200 hover:border-indigo-200 hover:bg-indigo-100 hover:translate-x-1">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 text-[1.2rem] bg-indigo-100">📧</div>
                            <div>
                                <small class="block text-[0.72rem] font-bold uppercase tracking-[0.07em] text-gray-400 mb-0.5">Adresse email</small>
                                <span class="text-sm font-bold text-gray-900">aya00sadiq@gmail.com</span>
                            </div>
                        </a>
                        <a href="tel:+212700070007" class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-gray-50 border border-gray-100 transition-all duration-200 hover:border-indigo-200 hover:bg-indigo-100 hover:translate-x-1">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 text-[1.2rem] bg-emerald-100">📞</div>
                            <div>
                                <small class="block text-[0.72rem] font-bold uppercase tracking-[0.07em] text-gray-400 mb-0.5">Téléphone</small>
                                <span class="text-sm font-bold text-gray-900">+212 700 070 007</span>
                            </div>
                        </a>
                        <div class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-gray-50 border border-gray-100 transition-all duration-200 hover:border-indigo-200 hover:bg-indigo-100 hover:translate-x-1 cursor-default">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 text-[1.2rem] bg-amber-100">📍</div>
                            <div>
                                <small class="block text-[0.72rem] font-bold uppercase tracking-[0.07em] text-gray-400 mb-0.5">Adresse</small>
                                <span class="text-sm font-bold text-gray-900">Casablanca, Maroc</span>
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
            <a href="/" class="flex items-center gap-2.5">
                <div class="w-[34px] h-[34px] rounded-lg bg-indigo-600 text-white font-black text-xs flex items-center justify-center">TL</div>
                <span class="text-white font-extrabold text-base">TransportLink Maroc</span>
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