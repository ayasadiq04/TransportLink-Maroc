<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Bonjour, {{ auth()->user()->name }} 👋</h1>
                <p class="text-sm text-gray-500 mt-1">Voici un aperçu de votre activité</p>
            </div>
            <a href="{{ route('client.transport-requests.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvelle demande
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
                            <p class="text-sm text-gray-500">Mes demandes</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['requests'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-amber-600 mt-2 font-medium">{{ $stats['pending_requests'] }} en attente</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Mes missions</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['missions'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-purple-600 mt-2 font-medium">{{ $stats['active_missions'] }} en cours</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm col-span-2">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Action rapide</p>
                            <p class="text-sm font-semibold text-gray-800 mt-0.5">Créez une demande et recevez des offres de transporteurs en quelques heures.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">

                <!-- Demandes récentes -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Demandes récentes</h2>
                        <a href="{{ route('client.transport-requests.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Voir tout →</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($recentRequests as $req)
                            <a href="{{ route('client.transport-requests.show', $req) }}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $req->title }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $req->departure_city }} → {{ $req->destination_city }}</p>
                                </div>
                                <x-status-badge :status="$req->status" type="request"/>
                            </a>
                        @empty
                            <div class="px-6 py-8 text-center">
                                <p class="text-sm text-gray-500">Aucune demande pour le moment.</p>
                                <a href="{{ route('client.transport-requests.create') }}" class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-800 font-medium">Créer ma première demande →</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Missions récentes -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-900">Missions récentes</h2>
                        <a href="{{ route('client.missions.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Voir tout →</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse($recentMissions as $mission)
                            <a href="{{ route('client.missions.show', $mission) }}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">Mission #{{ $mission->id }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Transporteur : {{ $mission->transporteur->name }}</p>
                                </div>
                                <x-status-badge :status="$mission->status" type="mission"/>
                            </a>
                        @empty
                            <div class="px-6 py-8 text-center">
                                <p class="text-sm text-gray-500">Aucune mission en cours.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
