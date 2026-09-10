<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Demandes de transport disponibles</h1>
                <p class="text-sm text-gray-500 mt-1">Trouvez des cargaisons correspondant à vos trajets et soumettez vos offres</p>
            </div>
            <a href="{{ route('transporteur.offers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 shadow-sm transition">
                Mes offres envoyées
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Liste des demandes -->
            @if($requests->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Aucune demande disponible</h3>
                    <p class="mt-1 text-sm text-gray-500">Il n'y a actuellement aucune demande de transport en attente.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($requests as $req)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                                        #{{ $req->id }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        {{ $req->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $req->title }}</h3>

                                <!-- Trajet -->
                                <div class="bg-gray-50 rounded-lg p-3 mb-4 space-y-2 text-sm">
                                    <div class="flex items-center gap-2 text-gray-700">
                                         <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                         <span class="font-medium">Départ :</span>
                                         <span>{{ $req->departure_city }}</span>
                                     </div>
                                     <div class="flex items-center gap-2 text-gray-700">
                                         <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                         <span class="font-medium">Arrivée :</span>
                                         <span>{{ $req->destination_city }}</span>
                                     </div>
                                </div>

                                <!-- Détails cargaison -->
                                <div class="space-y-1 text-xs text-gray-600 mb-4">
                                     <p><span class="font-semibold">Marchandise :</span> {{ ucfirst(str_replace('_', ' ', $req->goods_type ?? 'Standard')) }}</p>
                                     @if($req->weight)
                                         <p><span class="font-semibold">Poids :</span> {{ $req->weight }} tonnes</p>
                                     @endif
                                     @if($req->pickup_at)
                                         <p><span class="font-semibold">Date prévue :</span> {{ $req->pickup_at->format('d/m/Y H:i') }}</p>
                                     @endif
                                     @if($req->estimated_budget)
                                         <p><span class="font-semibold">Budget indicatif :</span> <span class="text-emerald-600 font-bold">{{ number_format($req->estimated_budget, 2) }} MAD</span></p>
                                     @endif
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xs text-gray-500">
                                    {{ $req->offers_count ?? $req->offers->count() }} offre(s) reçue(s)
                                </span>
                                <a href="{{ route('transporteur.requests.show', $req) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                                    Faire une offre &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if(method_exists($requests, 'links'))
                    <div class="mt-6">
                        {{ $requests->links() }}
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>