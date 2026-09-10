<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
                <p class="text-sm text-gray-500 mt-1">Vue d'ensemble de la plateforme</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                Administrateur
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Statistiques -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Clients</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['clients'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Transporteurs</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['transporteurs'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Demandes</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['transport_requests'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Missions livrées</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['missions_delivered'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-cyan-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Véhicules</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['vehicles'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Offres</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['offers'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Total Missions</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['missions'] }}</p>
                        </div>
                    </div>
                </div>

                </div>

            <!-- Accès rapides admin -->
            <div class="grid md:grid-cols-3 gap-4 mb-8">
                <a href="{{ route('admin.users.index') }}" class="bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-md hover:border-blue-200 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 group-hover:bg-blue-200 rounded-xl flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Gérer les utilisateurs</p>
                            <p class="text-xs text-gray-500">Clients & Transporteurs</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.transport-requests.index') }}" class="bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-md hover:border-indigo-200 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 group-hover:bg-indigo-200 rounded-xl flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Gérer les demandes</p>
                            <p class="text-xs text-gray-500">Voir & modérer</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.missions.index') }}" class="bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-md hover:border-purple-200 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 group-hover:bg-purple-200 rounded-xl flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Gérer les missions</p>
                            <p class="text-xs text-gray-500">Suivi des livraisons</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Demandes récentes -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Demandes récentes</h2>
                        <a href="{{ route('admin.transport-requests.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Voir tout →</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($recentRequests as $req)
                            <a href="{{ route('admin.transport-requests.show', $req) }}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $req->title }}</p>
                                    <p class="text-xs text-gray-500">Client : {{ $req->client->name }}</p>
                                </div>
                                <x-status-badge :status="$req->status" type="request"/>
                            </a>
                        @empty
                            <div class="px-6 py-8 text-center text-sm text-gray-500">Aucune demande.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Missions récentes -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Missions récentes</h2>
                        <a href="{{ route('admin.missions.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Voir tout →</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($recentMissions as $mission)
                            <div class="flex items-center justify-between px-6 py-4">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Mission #{{ $mission->id }}</p>
                                    <p class="text-xs text-gray-500">{{ $mission->client->name }} → {{ $mission->transporteur->name }}</p>
                                </div>
                                <x-status-badge :status="$mission->status" type="mission"/>
                            </div>
                        @empty
                            <div class="px-6 py-8 text-center text-sm text-gray-500">Aucune mission.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
