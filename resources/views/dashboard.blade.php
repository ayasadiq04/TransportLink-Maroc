<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Bienvenue, {{ auth()->user()->name }} 👋</h1>
                <p class="text-sm text-gray-500 mt-1">Espace personnel TransportLink Maroc</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 uppercase">
                {{ auth()->user()->role }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Redirection intelligente -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center space-y-4">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto text-2xl font-bold">
                    🚚
                </div>
                <h2 class="text-xl font-bold text-gray-900">Accéder à votre espace dédié</h2>
                <p class="text-sm text-gray-600 max-w-md mx-auto">
                    Votre compte est configuré avec le profil <strong>{{ strtoupper(auth()->user()->role) }}</strong>. Cliquez ci-dessous pour accéder directement à votre interface complète.
                </p>

                <div class="pt-2">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-bold text-sm rounded-xl shadow-md transition">
                            Ouvrir le Dashboard Admin &rarr;
                        </a>
                    @elseif(auth()->user()->role === 'transporteur')
                        <a href="{{ route('transporteur.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-md transition">
                            Ouvrir l'Espace Transporteur &rarr;
                        </a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md transition">
                            Ouvrir l'Espace Client &rarr;
                        </a>
                    @endif
                </div>
            </div>

            <!-- Raccourcis rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm space-y-2">
                    <h3 class="font-bold text-gray-900 text-base">👤 Votre Profil</h3>
                    <p class="text-xs text-gray-500">Mettez à jour vos coordonnées personnelles, email et mot de passe.</p>
                    <div class="pt-2">
                        <a href="{{ route('profile.edit') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Modifier mon profil &rarr;</a>
                    </div>
                </div>

                @if(auth()->user()->role === 'transporteur')
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm space-y-2">
                        <h3 class="font-bold text-gray-900 text-base">🚛 Vos Véhicules</h3>
                        <p class="text-xs text-gray-500">Gérez votre parc et vos autorisations de transport.</p>
                        <div class="pt-2">
                            <a href="{{ route('transporteur.vehicles.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Voir mes véhicules &rarr;</a>
                        </div>
                    </div>
                @else
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm space-y-2">
                        <h3 class="font-bold text-gray-900 text-base">📦 Vos Annonces</h3>
                        <p class="text-xs text-gray-500">Consultez vos demandes de transport publiées et les offres reçues.</p>
                        <div class="pt-2">
                            <a href="{{ route('client.transport-requests.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Mes demandes &rarr;</a>
                        </div>
                    </div>
                @endif

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm space-y-2">
                    <h3 class="font-bold text-gray-900 text-base">⭐ Vos Missions</h3>
                    <p class="text-xs text-gray-500">Suivez l'état d'acheminement de vos livraisons en direct.</p>
                    <div class="pt-2">
                        @if(auth()->user()->role === 'transporteur')
                            <a href="{{ route('transporteur.missions.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Mes missions en cours &rarr;</a>
                        @else
                            <a href="{{ route('client.missions.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Mes livraisons &rarr;</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
