<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des Demandes de Transport</h1>
                <p class="text-sm text-gray-500 mt-1">Supervision globale de toutes les demandes publiées sur la plateforme</p>
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
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Trajet</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Budget</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Offres</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($requests as $req)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $req->title }}</div>
                                        <div class="text-xs text-gray-500">{{ $req->cargo_type }} • {{ $req->weight ? $req->weight.'kg' : 'Poids N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700">
                                        <div class="font-medium text-gray-900">{{ $req->client->name }}</div>
                                        <div class="text-gray-400">{{ $req->client->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600">
                                        {{ $req->departure_city }} &rarr; {{ $req->arrival_city }}
                                    </td>
                                    <td class="px-6 py-4 text-xs font-semibold text-gray-900 whitespace-nowrap">
                                        {{ $req->budget ? number_format($req->budget, 2).' DH' : 'Non précisé' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600 whitespace-nowrap">
                                        {{ $req->offers_count ?? $req->offers()->count() }} offre(s)
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-status-badge :status="$req->status" type="request" />
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                        {{ $req->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-xs whitespace-nowrap">
                                        <form action="{{ route('admin.requests.delete', $req) }}" method="POST" onsubmit="return confirm('Supprimer cette demande ainsi que ses offres associées ?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($requests, 'links'))
                <div class="mt-6">
                    {{ $requests->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
