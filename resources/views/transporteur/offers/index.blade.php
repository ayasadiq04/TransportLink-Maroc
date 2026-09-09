<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Mes offres</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $offers->count() }} offre(s) envoyée(s)</p>
            </div>
            <a href="{{ route('transporteur.requests.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Voir les demandes
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($offers->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                    <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucune offre envoyée</h3>
                    <p class="text-gray-500 mb-6">Consultez les demandes disponibles et proposez vos offres.</p>
                    <a href="{{ route('transporteur.requests.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl shadow-sm transition">
                        Voir les demandes disponibles
                    </a>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Demande</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Trajet</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Véhicule</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($offers as $offer)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-gray-900 text-sm">{{ $offer->transportRequest->title }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Client: {{ $offer->transportRequest->client->name ?? '—' }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <div class="flex items-center gap-1">
                                                <span>{{ $offer->transportRequest->departure_city }}</span>
                                                <svg class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                </svg>
                                                <span>{{ $offer->transportRequest->destination_city }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            @if($offer->vehicle)
                                                {{ $offer->vehicle->brand }} {{ $offer->vehicle->model }}
                                                <div class="text-xs text-gray-400">{{ $offer->vehicle->capacity }} t</div>
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-bold text-gray-900 text-sm">{{ number_format($offer->amount, 2) }} MAD</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-status-badge :status="$offer->status" type="offer"/>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-500">
                                            {{ $offer->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('transporteur.offers.show', $offer) }}"
                                               class="text-sm font-semibold text-orange-600 hover:text-orange-800 transition">
                                                Détails
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
