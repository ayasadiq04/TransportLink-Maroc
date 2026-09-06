<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des Offres & Devis</h1>
                <p class="text-sm text-gray-500 mt-1">Supervision de l'ensemble des offres soumises par les transporteurs</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; Retour au dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Demande</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Transporteur</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix proposé</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Véhicule</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($offers as $offer)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $offer->transportRequest->title }}</div>
                                        <div class="text-xs text-gray-500">{{ $offer->transportRequest->departure_city }} &rarr; {{ $offer->transportRequest->destination_city }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700">
                                        <div class="font-medium text-gray-900">{{ $offer->transporteur->name }}</div>
                                        <div class="text-gray-400">{{ $offer->transporteur->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700">
                                        <div class="font-medium text-gray-900">{{ $offer->transportRequest->client->name }}</div>
                                        <div class="text-gray-400">{{ $offer->transportRequest->client->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-bold text-gray-900 whitespace-nowrap">
                                        {{ number_format($offer->amount ?? $offer->price, 2) }} DH
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600 whitespace-nowrap">
                                        {{ $offer->vehicle ? ($offer->vehicle->brand . ' ' . $offer->vehicle->model) : '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-status-badge :status="$offer->status" type="offer" />
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                        {{ $offer->created_at->format('d/m/Y') }}
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

        </div>
    </div>
</x-app-layout>
