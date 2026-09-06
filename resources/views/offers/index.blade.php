<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Mes offres envoyées</h1>
                <p class="text-sm text-gray-500 mt-1">Suivez l'état de vos propositions soumises aux clients</p>
            </div>
            <a href="{{ route('transporteur.requests.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold shadow-sm transition">
                Voir les demandes disponibles
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if($offers->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Aucune offre envoyée</h3>
                    <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore proposé de devis sur les demandes des clients.</p>
                    <div class="mt-6">
                        <a href="{{ route('transporteur.requests.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                            Explorer les demandes
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Demande</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Trajet</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix proposé</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Véhicule</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach($offers as $offer)
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900">{{ $offer->transportRequest->title }}</div>
                                            <div class="text-xs text-gray-500">{{ $offer->transportRequest->cargo_type }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $offer->transportRequest->client->name }}
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-600">
                                            <div>{{ $offer->transportRequest->departure_city }}</div>
                                            <div class="text-gray-400">&darr;</div>
                                            <div>{{ $offer->transportRequest->arrival_city }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">
                                            {{ number_format($offer->price, 2) }} DH
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-600">
                                            {{ $offer->vehicle ? ($offer->vehicle->brand . ' ' . $offer->vehicle->model) : 'Non assigné' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-status-badge :status="$offer->status" type="offer" />
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                            {{ $offer->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm whitespace-nowrap">
                                            <a href="{{ route('transporteur.requests.show', $offer->transportRequest) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-xs">
                                                Voir détails &rarr;
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(method_exists($offers, 'links'))
                    <div class="mt-6">
                        {{ $offers->links() }}
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>
