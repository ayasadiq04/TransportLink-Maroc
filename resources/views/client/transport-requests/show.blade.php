<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('client.transport-requests.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $transportRequest->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">Détail de la demande</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-3 gap-6">

                <!-- Informations principales -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Détails demande -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="font-semibold text-gray-900">Informations de transport</h2>
                            <x-status-badge :status="$transportRequest->status" type="request"/>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Départ</p>
                                <p class="font-medium text-gray-900">{{ $transportRequest->departure_city }}</p>
                                <p class="text-sm text-gray-500">{{ $transportRequest->departure_address }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Destination</p>
                                <p class="font-medium text-gray-900">{{ $transportRequest->destination_city }}</p>
                                <p class="text-sm text-gray-500">{{ $transportRequest->destination_address }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Date d'enlèvement</p>
                                <p class="font-medium text-gray-900">{{ $transportRequest->pickup_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Type de marchandise</p>
                                <p class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $transportRequest->goods_type)) }}</p>
                            </div>
                            @if($transportRequest->weight)
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Poids</p>
                                    <p class="font-medium text-gray-900">{{ $transportRequest->weight }} tonnes</p>
                                </div>
                            @endif
                            @if($transportRequest->volume)
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Volume</p>
                                    <p class="font-medium text-gray-900">{{ $transportRequest->volume }} m³</p>
                                </div>
                            @endif
                            @if($transportRequest->estimated_budget)
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Budget estimé</p>
                                    <p class="font-medium text-emerald-700">{{ number_format($transportRequest->estimated_budget, 2) }} MAD</p>
                                </div>
                            @endif
                        </div>

                        @if($transportRequest->instructions)
                            <div class="mt-5 pt-5 border-t border-gray-100">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Instructions spéciales</p>
                                <p class="text-sm text-gray-700">{{ $transportRequest->instructions }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Offres reçues -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-900">Offres reçues</h2>
                            <span class="text-sm text-gray-500">{{ $transportRequest->offers->count() }} offre(s)</span>
                        </div>

                        @if($transportRequest->offers->count())
                            <div class="divide-y divide-gray-50">
                                @foreach($transportRequest->offers as $offer)
                                    <div class="p-6 {{ $offer->status === 'accepted' ? 'bg-emerald-50' : '' }}">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                        {{ strtoupper(substr($offer->transporteur->name, 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-900">{{ $offer->transporteur->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $offer->vehicle->brand }} {{ $offer->vehicle->model }} — {{ $offer->vehicle->capacity }} t</p>
                                                    </div>
                                                </div>
                                                @if($offer->message)
                                                    <p class="text-sm text-gray-600 mb-2">{{ $offer->message }}</p>
                                                @endif
                                                @if($offer->estimated_delivery_time)
                                                    <p class="text-xs text-gray-500">⏱ Délai estimé : {{ $offer->estimated_delivery_time }}</p>
                                                @endif
                                            </div>
                                            <div class="flex-shrink-0 text-right">
                                                <p class="text-xl font-bold text-gray-900">{{ number_format($offer->amount, 2) }} MAD</p>
                                                <x-status-badge :status="$offer->status" type="offer" class="mt-1"/>

                                                @if($transportRequest->status === 'pending' && $offer->status === 'pending')
                                                    <div class="flex gap-2 mt-3 justify-end">
                                                        <form action="{{ route('client.offers.accept', $offer) }}" method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                    onclick="return confirm('Accepter cette offre ? Cela créera une mission et rejettera les autres offres.')"
                                                                    class="px-3 py-1.5 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-700 transition-colors">
                                                                ✓ Accepter
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('client.offers.reject', $offer) }}" method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                    onclick="return confirm('Rejeter cette offre ?')"
                                                                    class="px-3 py-1.5 bg-red-100 text-red-700 text-xs font-semibold rounded-lg hover:bg-red-200 transition-colors">
                                                                ✗ Rejeter
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center">
                                <p class="text-gray-500 text-sm">Aucune offre reçue pour le moment.</p>
                                <p class="text-gray-400 text-xs mt-1">Les transporteurs verront votre demande et proposeront des offres.</p>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Sidebar actions -->
                <div class="space-y-4">
                    @if($transportRequest->status === 'pending')
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <h3 class="font-semibold text-gray-900 mb-3">Actions</h3>
                            <div class="space-y-2">
                                <a href="{{ route('client.transport-requests.edit', $transportRequest) }}"
                                   class="flex items-center gap-2 w-full px-4 py-2.5 bg-gray-50 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Modifier la demande
                                </a>
                                <form action="{{ route('client.transport-requests.destroy', $transportRequest) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer définitivement cette demande ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="flex items-center gap-2 w-full px-4 py-2.5 bg-red-50 text-red-700 text-sm font-medium rounded-xl hover:bg-red-100 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Supprimer la demande
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($transportRequest->mission)
                        <div class="bg-blue-50 rounded-2xl border border-blue-200 p-5">
                            <h3 class="font-semibold text-blue-900 mb-3">Mission associée</h3>
                            <p class="text-sm text-blue-700 mb-3">Mission #{{ $transportRequest->mission->id }}</p>
                            <a href="{{ route('client.missions.show', $transportRequest->mission) }}"
                               class="block w-full text-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                                Voir la mission
                            </a>
                        </div>
                    @endif

                    <div class="bg-gray-50 rounded-2xl border border-gray-100 p-5">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Créée le</p>
                        <p class="text-sm font-medium text-gray-800">{{ $transportRequest->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
