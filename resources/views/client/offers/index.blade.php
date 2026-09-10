<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Offres reçues</h1>
                <p class="text-sm text-gray-500 mt-1">Consultez et gérez les offres proposées par les transporteurs</p>
            </div>
            <a href="{{ route('client.transport-requests.index') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">
                &larr; Mes demandes de transport
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if($offers->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center shadow-sm">
                    <div class="w-16 h-16 mx-auto mb-4 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Aucune offre pour le moment</h3>
                    <p class="text-sm text-gray-500 mb-6">Lorsque des transporteurs formuleront des offres pour vos demandes, elles s'afficheront ici.</p>
                    <a href="{{ route('client.transport-requests.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition">
                        + Créer une demande
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($offers as $offer)
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition flex flex-col justify-between">
                            <div>
                                <!-- Header offre -->
                                <div class="flex items-start justify-between gap-2 mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr($offer->transporteur->name ?? 'T', 0, 2)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('transporteur.profile', $offer->transporteur_id) }}" class="font-semibold text-gray-900 hover:text-emerald-600 transition text-sm">
                                                {{ $offer->transporteur->name }}
                                            </a>
                                            <p class="text-xs text-gray-500">{{ $offer->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <x-status-badge :status="$offer->status" type="offer" />
                                </div>

                                <!-- Demande cible -->
                                <div class="bg-gray-50 rounded-xl p-3 mb-4 text-xs">
                                    <p class="text-gray-400 font-medium uppercase tracking-wider mb-1">Demande associée</p>
                                    <a href="{{ route('client.transport-requests.show', $offer->transportRequest) }}" class="font-semibold text-gray-900 hover:text-emerald-600 block line-clamp-1">
                                        {{ $offer->transportRequest->title }}
                                    </a>
                                    <p class="text-gray-500 mt-1">
                                        {{ $offer->transportRequest->departure_city }} &rarr; {{ $offer->transportRequest->destination_city }}
                                    </p>
                                </div>

                                <!-- Détails prix et véhicule -->
                                <div class="grid grid-cols-2 gap-3 mb-4">
                                    <div class="p-3 bg-emerald-50/50 rounded-xl border border-emerald-100">
                                        <span class="text-xs text-emerald-700 block">Prix proposé</span>
                                        <span class="text-lg font-bold text-emerald-800">{{ number_format($offer->amount, 2) }} DH</span>
                                    </div>
                                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                                        <span class="text-xs text-gray-500 block">Véhicule</span>
                                        <span class="text-sm font-semibold text-gray-800 truncate block">
                                            {{ $offer->vehicle ? ($offer->vehicle->brand . ' ' . $offer->vehicle->model) : 'Non précisé' }}
                                        </span>
                                    </div>
                                </div>

                                @if($offer->estimated_delivery_time)
                                    <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-3">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Délai estimé : {{ $offer->estimated_delivery_time }}</span>
                                    </div>
                                @endif

                                @if($offer->message)
                                    <p class="text-xs text-gray-600 italic bg-gray-50/60 p-2.5 rounded-lg border border-gray-100 mb-4 line-clamp-3">
                                        « {{ $offer->message }} »
                                    </p>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-2">
                                <a href="{{ route('client.transport-requests.show', $offer->transportRequest) }}" class="text-xs text-gray-600 hover:text-gray-900 font-medium">
                                    Voir la demande
                                </a>

                                @if($offer->transportRequest->status === 'pending' && $offer->status === 'pending')
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('client.offers.reject', $offer) }}" method="POST">
                                            @csrf
                                            <button type="submit" data-confirm="Refuser cette offre ?" class="px-2.5 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-lg transition">
                                                Rejeter
                                            </button>
                                        </form>
                                        <form action="{{ route('client.offers.accept', $offer) }}" method="POST">
                                            @csrf
                                            <button type="submit" data-confirm="Accepter cette offre ? Cela générera la mission et refusera les autres propositions." class="px-3 py-1.5 text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition shadow-sm">
                                                Accepter
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
