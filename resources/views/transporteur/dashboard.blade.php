<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Bonjour, {{ auth()->user()->name }} 👋</h1>
                <p class="text-sm text-gray-500 mt-1">Tableau de bord transporteur</p>
            </div>
            <a href="{{ route('transporteur.requests.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 text-white text-sm font-semibold rounded-xl hover:bg-orange-600 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Voir les demandes
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Statistiques -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Mes véhicules</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['vehicles'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-emerald-600 mt-2 font-medium">{{ $stats['available_vehicles'] }} disponibles</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Mes offres</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['offers'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-amber-600 mt-2 font-medium">{{ $stats['pending_offers'] }} en attente</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Mes missions</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['missions'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-purple-600 mt-2 font-medium">{{ $stats['active_missions'] }} en cours</p>
                </div>
            </div>

            <!-- Alerte demandes disponibles -->
            @if($availableRequests > 0)
                <div class="bg-gradient-to-r from-orange-50 to-amber-50 border border-orange-200 rounded-2xl p-5 mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-orange-900">{{ $availableRequests }} demande(s) disponible(s)</p>
                            <p class="text-sm text-orange-700 mt-0.5">De nouveaux clients attendent vos offres.</p>
                        </div>
                        <a href="{{ route('transporteur.requests.index') }}"
                           class="px-4 py-2 bg-orange-500 text-white text-sm font-semibold rounded-lg hover:bg-orange-600 transition-colors flex-shrink-0">
                            Voir les demandes
                        </a>
                    </div>
                </div>
            @endif

            <!-- Missions récentes -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-900">Missions récentes</h2>
                    <a href="{{ route('transporteur.missions.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Voir tout →</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse($recentMissions as $mission)
                        <a href="{{ route('transporteur.missions.show', $mission) }}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">Mission #{{ $mission->id }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">Client : {{ $mission->client->name }}</p>
                            </div>
                            <x-status-badge :status="$mission->status" type="mission"/>
                        </a>
                    @empty
                        <div class="px-6 py-8 text-center">
                            <p class="text-sm text-gray-500">Aucune mission pour le moment.</p>
                            <a href="{{ route('transporteur.requests.index') }}" class="mt-2 inline-block text-sm text-orange-600 hover:text-orange-800 font-medium">Consulter les demandes disponibles →</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
