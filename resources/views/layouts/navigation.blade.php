<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo + Navigation principale -->
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 flex-shrink-0">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-orange-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900 text-base hidden sm:block">TransportLink <span class="text-blue-600">Maroc</span></span>
                </a>

                <!-- Liens de navigation desktop -->
                <div class="hidden md:flex items-center gap-1">

                    @if(auth()->user()->role === 'client')
                        <a href="{{ route('client.dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('client.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('client.transport-requests.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('client.transport-requests.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Mes demandes
                        </a>
                        <a href="{{ route('client.offers.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('client.offers.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Offres reçues
                        </a>
                        <a href="{{ route('client.missions.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('client.missions.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Mes missions
                        </a>
                    @endif

                    @if(auth()->user()->role === 'transporteur')
                        <a href="{{ route('transporteur.dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('transporteur.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('transporteur.vehicles.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('transporteur.vehicles.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Mes véhicules
                        </a>
                        <a href="{{ route('transporteur.requests.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('transporteur.requests.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Demandes
                        </a>
                        <a href="{{ route('transporteur.offers.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('transporteur.offers.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Mes offres
                        </a>
                        <a href="{{ route('transporteur.missions.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('transporteur.missions.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Mes missions
                        </a>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Utilisateurs
                        </a>
                        <a href="{{ route('admin.transport-requests.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.transport-requests.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Demandes
                        </a>
                        <a href="{{ route('admin.offers.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.offers.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Offres
                        </a>
                        <a href="{{ route('admin.missions.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.missions.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Missions
                        </a>
<a href="{{ route('admin.vehicles.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.vehicles.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Véhicules
                        </a>
                        <a href="{{ route('admin.reviews.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.reviews.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            Avis
                        </a>
                    @endif

                </div>
            </div>

            <!-- Profil dropdown + hamburger -->
            <div class="flex items-center gap-3">

                <!-- Badge rôle -->
                <span class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if(auth()->user()->role === 'admin') bg-purple-100 text-purple-800
                    @elseif(auth()->user()->role === 'transporteur') bg-orange-100 text-orange-800
                    @else bg-blue-100 text-blue-800 @endif">
                    {{ ucfirst(auth()->user()->role) }}
                </span>

                <!-- Dropdown profil -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open"
                         @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-1 z-50"
                         style="display: none;">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            Mon profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" data-loading>
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Hamburger mobile -->
                <button class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 bg-white">
        <div class="px-4 py-3 space-y-1">
            @if(auth()->user()->role === 'client')
                <a href="{{ route('client.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                <a href="{{ route('client.transport-requests.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Mes demandes</a>
                <a href="{{ route('client.offers.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Offres reçues</a>
                <a href="{{ route('client.missions.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Mes missions</a>
            @endif
            @if(auth()->user()->role === 'transporteur')
                <a href="{{ route('transporteur.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                <a href="{{ route('transporteur.vehicles.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Mes véhicules</a>
                <a href="{{ route('transporteur.requests.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Demandes</a>
                <a href="{{ route('transporteur.offers.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Mes offres</a>
                <a href="{{ route('transporteur.missions.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Mes missions</a>
            @endif
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Utilisateurs</a>
                <a href="{{ route('admin.transport-requests.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Demandes</a>
                <a href="{{ route('admin.offers.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Offres</a>
                <a href="{{ route('admin.missions.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Missions</a>
<a href="{{ route('admin.vehicles.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Véhicules</a>
                <a href="{{ route('admin.reviews.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-100">Avis</a>
            @endif
        </div>
    </div>
</nav>
