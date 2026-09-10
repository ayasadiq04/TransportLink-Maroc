<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Mes demandes de transport</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $requests->count() }} demande(s) au total</p>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Filtres / Recherche -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <form method="GET" action="{{ route('client.transport-requests.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Statut</label>
                        <select name="status" class="w-full text-sm rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Tous les statuts</option>
                            <option value="pending" @selected(request('status') === 'pending')>En attente</option>
                            <option value="accepted" @selected(request('status') === 'accepted')>Acceptée</option>
                            <option value="completed" @selected(request('status') === 'completed')>Terminée</option>
                            <option value="cancelled" @selected(request('status') === 'cancelled')>Annulée</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Ville de départ</label>
                        <input type="text" name="departure_city" value="{{ request('departure_city') }}" placeholder="Ex: Casablanca" class="w-full text-sm rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Ville de destination</label>
                        <input type="text" name="destination_city" value="{{ request('destination_city') }}" placeholder="Ex: Tanger" class="w-full text-sm rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Type de marchandise</label>
                        <select name="goods_type" class="w-full text-sm rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Tous les types</option>
                            <option value="palette" @selected(request('goods_type') === 'palette')>Palette</option>
                            <option value="vrac" @selected(request('goods_type') === 'vrac')>Vrac</option>
                            <option value="frigorifique" @selected(request('goods_type') === 'frigorifique')>Frigorifique</option>
                            <option value="liquide" @selected(request('goods_type') === 'liquide')>Liquide</option>
                            <option value="colis_volumineux" @selected(request('goods_type') === 'colis_volumineux')>Colis volumineux</option>
                            <option value="autre" @selected(request('goods_type') === 'autre')>Autre</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl text-sm transition shadow-sm">
                            Filtrer
                        </button>
                        <a href="{{ route('client.transport-requests.index') }}" class="px-3 py-2 border border-gray-300 rounded-xl text-gray-600 hover:bg-gray-50 text-sm font-medium">
                            Réinitialiser
                        </a>
                    </div>
                </form>
            </div>

            @if($requests->count())
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Titre</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Trajet</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date d'enlèvement</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Offres</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($requests as $request)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <a href="{{ route('client.transport-requests.show', $request) }}" class="font-medium text-gray-900 hover:text-blue-600 transition-colors">
                                                {{ $request->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <div class="flex items-center gap-1">
                                                <span>{{ $request->departure_city }}</span>
                                                <svg class="w-3 h-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                </svg>
                                                <span>{{ $request->destination_city }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $request->pickup_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            @if($request->offers_count > 0)
                                                <a href="{{ route('client.transport-requests.show', $request) }}"
                                                   class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 font-medium">
                                                    {{ $request->offers_count }} offre(s)
                                                </a>
                                            @else
                                                <span class="text-gray-400">Aucune offre</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <x-status-badge :status="$request->status" type="request"/>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('client.transport-requests.show', $request) }}"
                                                   class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                                                    Voir
                                                </a>
                                                @if($request->status === 'pending')
                                                    <a href="{{ route('client.transport-requests.edit', $request) }}"
                                                       class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                                        Modifier
                                                    </a>
                                                    <button type="button"
                                                            x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-request-delete-{{ $request->id }}')"
                                                            class="text-sm text-red-600 hover:text-red-800 font-medium">
                                                        Supprimer
                                                    </button>

                                                    <x-confirm-modal
                                                        :name="'confirm-request-delete-'.$request->id"
                                                        title="Supprimer cette demande"
                                                        message="Supprimer cette demande ? Cette action est définitive."
                                                        :action="route('client.transport-requests.destroy', $request)"
                                                    />
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucune demande</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas encore créé de demande de transport.</p>
                    <a href="{{ route('client.transport-requests.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Créer ma première demande
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
