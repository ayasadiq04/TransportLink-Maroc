<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('transporteur.requests.index') }}" class="text-gray-400 hover:text-gray-600 transition">
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Détails de la demande -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                        <h2 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3">Informations de la cargaison</h2>

                        <!-- Trajet -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                                <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">Lieu de départ</span>
                                <p class="text-lg font-bold text-emerald-950 mt-1">{{ $transportRequest->departure_city }}</p>
                                @if($transportRequest->departure_address)
                                    <p class="text-xs text-emerald-700 mt-1">{{ $transportRequest->departure_address }}</p>
                                @endif
                            </div>
                            <div class="bg-rose-50 rounded-xl p-4 border border-rose-100">
                                <span class="text-xs font-bold uppercase tracking-wider text-rose-800">Lieu d'arrivée</span>
                                <p class="text-lg font-bold text-rose-950 mt-1">{{ $transportRequest->arrival_city }}</p>
                                @if($transportRequest->arrival_address)
                                    <p class="text-xs text-rose-700 mt-1">{{ $transportRequest->arrival_address }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Description & Spécifications -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-2">Description</h3>
                            <p class="text-sm text-gray-600 bg-gray-50 p-4 rounded-lg leading-relaxed whitespace-pre-line">
                                {{ $transportRequest->description ?? 'Aucune description fournie.' }}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Marchandise</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $transportRequest->cargo_type ?? 'Standard' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Poids</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $transportRequest->weight ? $transportRequest->weight . ' kg' : 'N/A' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Budget indicatif</span>
                                <p class="text-sm font-semibold text-emerald-600 mt-0.5">{{ $transportRequest->budget ? number_format($transportRequest->budget, 2) . ' DH' : 'Non précisé' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Date souhaitée</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">
                                    {{ $transportRequest->deadline_date ? \Carbon\Carbon::parse($transportRequest->deadline_date)->format('d/m/Y') : 'Flexible' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Statut de la demande</span>
                                <div class="mt-1">
                                    <x-status-badge :status="$transportRequest->status" type="request" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de proposition d'offre -->
                <div class="space-y-6">
                    @php
                        $existingOffer = auth()->user()->offers->where('transport_request_id', $transportRequest->id)->first();
                    @endphp

                    @if($existingOffer)
                        <div class="bg-white rounded-xl shadow-sm border border-indigo-100 p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-3 h-3 rounded-full bg-indigo-600"></span>
                                <h2 class="text-lg font-bold text-gray-900">Votre offre</h2>
                            </div>
                            <p class="text-xs text-gray-500 mb-4">Vous avez déjà soumis une offre pour cette demande.</p>

                            <div class="bg-indigo-50 p-4 rounded-xl border border-indigo-100 space-y-3">
                                <div>
                                    <span class="text-xs text-indigo-700 font-medium">Prix proposé :</span>
                                    <p class="text-2xl font-black text-indigo-900">{{ number_format($existingOffer->price, 2) }} DH</p>
                                </div>
                                <div>
                                    <span class="text-xs text-indigo-700 font-medium">Statut :</span>
                                    <div class="mt-1">
                                        <x-status-badge :status="$existingOffer->status" type="offer" />
                                    </div>
                                </div>
                                @if($existingOffer->comment)
                                    <div>
                                        <span class="text-xs text-indigo-700 font-medium">Message :</span>
                                        <p class="text-xs text-indigo-900 mt-0.5 bg-white/60 p-2 rounded">{{ $existingOffer->comment }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif($transportRequest->status === 'pending')
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-1">Faire une offre de transport</h2>
                            <p class="text-xs text-gray-500 mb-5">Proposez votre tarif et précisez vos disponibilités.</p>

                            <form action="{{ route('transporteur.offers.store', $transportRequest) }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Prix proposé (DH) *</label>
                                    <input type="number" step="0.01" name="price" required min="1" placeholder="Ex: 2500" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Véhicule assigné (optionnel)</label>
                                    <select name="vehicle_id" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Sélectionner un véhicule</option>
                                        @foreach(auth()->user()->vehicles ?? [] as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->license_plate }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Commentaire / Conditions</label>
                                    <textarea name="comment" rows="3" placeholder="Précisez vos délais, conditions ou informations complémentaires..." class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-sm transition text-sm">
                                    Envoyer mon offre
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-amber-50 rounded-xl p-6 border border-amber-200 text-center">
                            <p class="text-sm font-semibold text-amber-900">Demande clôturée</p>
                            <p class="text-xs text-amber-700 mt-1">Cette demande n'accepte plus de nouvelles offres car elle est déjà assignée ou terminée.</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
