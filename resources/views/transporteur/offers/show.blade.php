<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('transporteur.offers.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Détail de l'offre #{{ $offer->id }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $offer->transportRequest->title }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-3 gap-6">

                {{-- Contenu principal --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Informations de la demande --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <h2 class="font-semibold text-gray-900 mb-4">Demande concernée</h2>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Départ</p>
                                <p class="font-medium text-gray-900">{{ $offer->transportRequest->departure_city }}</p>
                                <p class="text-sm text-gray-500">{{ $offer->transportRequest->departure_address }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Destination</p>
                                <p class="font-medium text-gray-900">{{ $offer->transportRequest->destination_city }}</p>
                                <p class="text-sm text-gray-500">{{ $offer->transportRequest->destination_address }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Date d'enlèvement</p>
                                <p class="font-medium text-gray-900">{{ $offer->transportRequest->pickup_at->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Type de marchandise</p>
                                <p class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $offer->transportRequest->goods_type)) }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Mon offre --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-semibold text-gray-900">Mon offre</h2>
                            <x-status-badge :status="$offer->status" type="offer"/>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Montant proposé</p>
                                <p class="text-2xl font-bold text-gray-900">{{ number_format($offer->amount, 2) }} MAD</p>
                            </div>
                            @if($offer->estimated_delivery_time)
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Délai estimé</p>
                                    <p class="font-medium text-gray-900">{{ $offer->estimated_delivery_time }}</p>
                                </div>
                            @endif
                        </div>

                        @if($offer->message)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Message</p>
                                <p class="text-sm text-gray-700">{{ $offer->message }}</p>
                            </div>
                        @endif

                        @if($offer->conditions)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Conditions</p>
                                <p class="text-sm text-gray-700">{{ $offer->conditions }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Mission associée --}}
                    @if($offer->mission)
                        <div class="bg-blue-50 rounded-2xl border border-blue-200 p-6">
                            <h2 class="font-semibold text-blue-900 mb-4">Mission créée</h2>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-blue-700">Mission #{{ $offer->mission->id }}</p>
                                    <x-status-badge :status="$offer->mission->status" type="mission" class="mt-2"/>
                                </div>
                                <a href="{{ route('transporteur.missions.show', $offer->mission) }}"
                                   class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                                    Voir la mission
                                </a>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- Sidebar --}}
                <div class="space-y-4">

                    {{-- Véhicule utilisé --}}
                    @if($offer->vehicle)
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <h3 class="font-semibold text-gray-900 mb-3">Véhicule proposé</h3>
                            <div class="space-y-2 text-sm">
                                <div>
                                    <span class="text-xs font-semibold text-gray-500 uppercase">Type</span>
                                    <p class="font-medium text-gray-900">{{ $offer->vehicle->type }}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-gray-500 uppercase">Marque / Modèle</span>
                                    <p class="font-medium text-gray-900">{{ $offer->vehicle->brand }} {{ $offer->vehicle->model }}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-gray-500 uppercase">Immatriculation</span>
                                    <p class="font-mono font-medium text-gray-900">{{ $offer->vehicle->registration_number }}</p>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-gray-500 uppercase">Capacité</span>
                                    <p class="font-medium text-gray-900">{{ $offer->vehicle->capacity }} tonnes</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Date et statut --}}
                    <div class="bg-gray-50 rounded-2xl border border-gray-100 p-5">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Offre soumise le</p>
                        <p class="text-sm font-medium text-gray-800">{{ $offer->created_at->format('d/m/Y à H:i') }}</p>
                    </div>

                    {{-- Actions --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <h3 class="font-semibold text-gray-900 mb-3">Navigation</h3>
                        <div class="space-y-2">
                            <a href="{{ route('transporteur.requests.show', $offer->transportRequest) }}"
                               class="flex items-center gap-2 w-full px-4 py-2.5 bg-gray-50 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Voir la demande
                            </a>
                            @if($offer->mission)
                                <a href="{{ route('transporteur.missions.show', $offer->mission) }}"
                                   class="flex items-center gap-2 w-full px-4 py-2.5 bg-blue-50 text-blue-700 text-sm font-medium rounded-xl hover:bg-blue-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                    Aller à la mission
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
