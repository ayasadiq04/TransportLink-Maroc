<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.transport-requests.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $transportRequest->title }}</h1>
                <p class="text-sm text-gray-500">Demande #{{ $transportRequest->id }} • Publiée par {{ $transportRequest->client->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Informations principales -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h2 class="text-lg font-bold text-gray-900">Détails de la demande</h2>
                    <x-status-badge :status="$transportRequest->status" type="request" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-emerald-50/70 rounded-xl p-4 border border-emerald-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">Lieu de départ</span>
                        <p class="text-lg font-bold text-emerald-950 mt-1">{{ $transportRequest->departure_city }}</p>
                        <p class="text-xs text-emerald-700 mt-1">{{ $transportRequest->departure_address ?? 'Non spécifiée' }}</p>
                    </div>
                    <div class="bg-rose-50/70 rounded-xl p-4 border border-rose-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-rose-800">Lieu d'arrivée</span>
                        <p class="text-lg font-bold text-rose-950 mt-1">{{ $transportRequest->destination_city ?? $transportRequest->arrival_city }}</p>
                        <p class="text-xs text-rose-700 mt-1">{{ $transportRequest->destination_address ?? $transportRequest->arrival_address ?? 'Non spécifiée' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="text-xs text-gray-500">Marchandise</span>
                        <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $transportRequest->goods_type ?? $transportRequest->cargo_type ?? 'Standard' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="text-xs text-gray-500">Poids</span>
                        <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $transportRequest->weight ? $transportRequest->weight . ' kg' : '—' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="text-xs text-gray-500">Budget indicatif</span>
                        <p class="text-sm font-semibold text-emerald-600 mt-0.5">{{ $transportRequest->estimated_budget ?? $transportRequest->budget ? number_format($transportRequest->estimated_budget ?? $transportRequest->budget, 2) . ' DH' : 'Non précisé' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="text-xs text-gray-500">Date</span>
                        <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $transportRequest->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

                @if($transportRequest->instructions ?? $transportRequest->description)
                    <div>
                        <h3 class="text-xs font-bold uppercase text-gray-500 mb-1">Instructions / Description</h3>
                        <p class="text-sm text-gray-700 bg-gray-50 p-4 rounded-lg leading-relaxed">{{ $transportRequest->instructions ?? $transportRequest->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Offres liées -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-base font-bold text-gray-900 mb-4">Offres soumises sur cette demande ({{ $transportRequest->offers->count() }})</h3>

                @if($transportRequest->offers->isEmpty())
                    <p class="text-sm text-gray-500 text-center py-6">Aucune offre déposée.</p>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($transportRequest->offers as $off)
                            <div class="py-4 flex items-center justify-between first:pt-0 last:pb-0">
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $off->transporteur->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $off->transporteur->email }} • {{ $off->vehicle ? $off->vehicle->brand.' '.$off->vehicle->model : 'Véhicule standard' }}</p>
                                    @if($off->comment)
                                        <p class="text-xs text-gray-600 mt-1 italic">« {{ $off->comment }} »</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="text-base font-black text-gray-900">{{ number_format($off->amount ?? $off->price, 2) }} DH</p>
                                    <div class="mt-1">
                                        <x-status-badge :status="$off->status" type="offer" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
