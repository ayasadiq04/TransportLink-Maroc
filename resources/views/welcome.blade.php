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

    <!-- Styles & Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-500 flex items-center justify-center text-white shadow-md shadow-indigo-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-black bg-clip-text text-transparent bg-gradient-to-r from-gray-900 via-indigo-950 to-indigo-700">TransportLink</span>
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 block -mt-1">Maroc</span>
                    </div>
                </div>

                <!-- Navigation Liens -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-600">
                    <a href="#features" class="hover:text-indigo-600 transition">Comment ça marche</a>
                    <a href="#services" class="hover:text-indigo-600 transition">Nos Services</a>
                    <a href="#transporters" class="hover:text-indigo-600 transition">Espace Transporteurs</a>
                    <a href="#contact" class="hover:text-indigo-600 transition">Contact</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-sm transition">
                                <span>Mon Tableau de Bord</span>
                                &rarr;
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 px-4 py-2 transition">
                                Connexion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-md shadow-indigo-100 hover:shadow-lg transition">
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
    <section class="relative overflow-hidden pt-12 pb-24 lg:pt-20 lg:pb-32 bg-gradient-to-b from-white via-indigo-50/30 to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                
                <!-- Hero Text -->
                <div class="space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-50 border border-indigo-100 text-xs font-bold text-indigo-700">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Réseau national actif dans plus de 30 villes du Royaume 🇲🇦
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-gray-900 tracking-tight leading-[1.15]">
                        Expédiez vos marchandises au Maroc en toute <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-emerald-600">simplicité & sécurité</span>.
                    </h1>

                    <p class="text-lg text-gray-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        TransportLink Maroc met en relation expéditeurs professionnels ou particuliers avec des transporteurs vérifiés. Publiez votre annonce, comparez les offres et suivez votre trajet en temps réel.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-base font-bold rounded-xl shadow-lg shadow-indigo-200 transition transform hover:-translate-y-0.5">
                                Accéder à mon compte &rarr;
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-base font-bold rounded-xl shadow-lg shadow-indigo-200 transition transform hover:-translate-y-0.5">
                                Publier une cargaison
                            </a>
                            <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-4 bg-white hover:bg-gray-50 border border-gray-200 text-gray-800 text-base font-bold rounded-xl shadow-sm transition">
                                Je suis transporteur
                            </a>
                        @endauth
                    </div>

                    <!-- Chiffres clés -->
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-gray-200/60 max-w-lg mx-auto lg:mx-0">
                        <div>
                            <p class="text-2xl lg:text-3xl font-black text-gray-900">+1,500</p>
                            <p class="text-xs font-semibold text-gray-500 uppercase mt-0.5">Trajets réalisés</p>
                        </div>
                        <div>
                            <p class="text-2xl lg:text-3xl font-black text-gray-900">100%</p>
                            <p class="text-xs font-semibold text-gray-500 uppercase mt-0.5">Transporteurs vérifiés</p>
                        </div>
                        <div>
                            <p class="text-2xl lg:text-3xl font-black text-emerald-600">4.9 / 5</p>
                            <p class="text-xs font-semibold text-gray-500 uppercase mt-0.5">Satisfaction client</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Interactive Visual -->
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-indigo-500/20 to-emerald-500/20 rounded-3xl blur-2xl z-0"></div>
                    
                    <div class="relative z-10 bg-white rounded-3xl shadow-xl border border-gray-100 p-6 sm:p-8 space-y-6">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Dernière demande active</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                En attente de devis
                            </span>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-900">Transport de palettes alimentaires</h3>
                            
                            <div class="bg-gray-50 rounded-2xl p-4 space-y-3">
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="w-3 h-3 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>
                                    <span class="font-bold text-gray-800">Casablanca</span>
                                    <span class="text-xs text-gray-400">Zone Industrielle Ain Sebaâ</span>
                                </div>
                                <div class="w-0.5 h-4 bg-gray-300 ml-1.5"></div>
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="w-3 h-3 rounded-full bg-rose-500 ring-4 ring-rose-100"></span>
                                    <span class="font-bold text-gray-800">Tanger Med</span>
                                    <span class="text-xs text-gray-400">Plateforme Logistique</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <div class="bg-indigo-50/60 p-3 rounded-xl">
                                    <span class="text-gray-500 block">Poids & Volume</span>
                                    <span class="font-bold text-gray-900">4.5 Tonnes • 8 Palettes</span>
                                </div>
                                <div class="bg-indigo-50/60 p-3 rounded-xl">
                                    <span class="text-gray-500 block">Budget estimé</span>
                                    <span class="font-black text-emerald-600 text-sm">3,500 DH</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center py-3 bg-gray-900 hover:bg-black text-white text-xs font-bold rounded-xl shadow transition">
                                Voir toutes les opportunités de transport &rarr;
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Comment ça marche -->
    <section id="features" class="py-24 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Simple et Efficace</span>
                <h2 class="text-3xl sm:text-4xl font-black text-gray-900">Comment fonctionne TransportLink ?</h2>
                <p class="text-gray-600 text-sm sm:text-base">Une procédure fluide conçue pour vous faire gagner du temps et économiser sur vos coûts logistiques.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 space-y-4 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white font-black text-xl flex items-center justify-center shadow-md shadow-indigo-200">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Publiez votre demande</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Précisez les villes de départ et d’arrivée, la nature de la cargaison, le poids, les dates souhaitées et votre budget indicatif.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 space-y-4 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white font-black text-xl flex items-center justify-center shadow-md shadow-emerald-200">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Recevez des devis directs</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Des transporteurs certifiés consultent votre offre et vous proposent leurs meilleurs tarifs et types de véhicules adaptés.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 space-y-4 hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-purple-600 text-white font-black text-xl flex items-center justify-center shadow-md shadow-purple-200">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Suivez et Évaluez</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Acceptez l'offre idéale, suivez le statut de livraison (En attente &rarr; En cours &rarr; Livrée) et notez la prestation du transporteur.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Types de cargaisons acceptées -->
    <section id="services" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Polyvalence</span>
                <h2 class="text-3xl sm:text-4xl font-black text-gray-900">Toutes les cargaisons prises en charge</h2>
                <p class="text-gray-600 text-sm sm:text-base">Notre flotte de transporteurs s'adapte à tous vos besoins de livraison à travers le Maroc.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div class="text-3xl">📦</div>
                    <h4 class="font-bold text-gray-900 text-base">Colis volumineux & Meubles</h4>
                    <p class="text-xs text-gray-500">Déménagements, électroménager et biens fragiles.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div class="text-3xl">🏗️</div>
                    <h4 class="font-bold text-gray-900 text-base">Palettes & Fret Industriel</h4>
                    <p class="text-xs text-gray-500">Marchandises palettisées pour usines et grossistes.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div class="text-3xl">❄️</div>
                    <h4 class="font-bold text-gray-900 text-base">Frigorifique</h4>
                    <p class="text-xs text-gray-500">Produits frais et surgelés sous température dirigée.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center space-y-3">
                    <div class="text-3xl">🚛</div>
                    <h4 class="font-bold text-gray-900 text-base">Vrac & Matériaux</h4>
                    <p class="text-xs text-gray-500">Agrégats, sable, matériaux de construction et bennes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-gray-800 pb-8">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold">
                        TL
                    </div>
                    <span class="text-lg font-black text-white">TransportLink Maroc</span>
                </div>
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} TransportLink Maroc. Tous droits réservés. Projet Académique Fil Rouge.
                </p>
                <div class="flex gap-4 text-xs font-semibold">
                    <a href="{{ route('login') }}" class="hover:text-white transition">Connexion</a>
                    <a href="{{ route('register') }}" class="hover:text-white transition">Inscription</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
