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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Flash messages & Validation Errors --}}
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl text-sm">
                    <p class="font-semibold mb-1">Veuillez corriger les erreurs ci-dessous :</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Détails de la demande -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <h2 class="text-lg font-bold text-gray-900">Informations de la cargaison</h2>
                            <x-status-badge :status="$transportRequest->status" type="request" />
                        </div>

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
                                <p class="text-lg font-bold text-rose-950 mt-1">{{ $transportRequest->destination_city }}</p>
                                @if($transportRequest->destination_address)
                                    <p class="text-xs text-rose-700 mt-1">{{ $transportRequest->destination_address }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Spécifications -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Marchandise</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">
                                    {{ ucfirst(str_replace('_', ' ', $transportRequest->goods_type)) }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Poids</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $transportRequest->weight ? $transportRequest->weight . ' tonnes' : 'Non précisé' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Volume</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $transportRequest->volume ? $transportRequest->volume . ' m³' : 'Non précisé' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Date d'enlèvement</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">
                                    {{ $transportRequest->pickup_at ? $transportRequest->pickup_at->format('d/m/Y à H:i') : 'Flexible' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Budget estimé</span>
                                <p class="text-sm font-semibold text-emerald-600 mt-0.5">
                                    {{ $transportRequest->estimated_budget ? number_format($transportRequest->estimated_budget, 2) . ' MAD' : 'Non précisé' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Offres reçues</span>
                                <p class="text-sm font-semibold text-indigo-600 mt-0.5">
                                    {{ $transportRequest->offers->count() }} offre(s)
                                </p>
                            </div>
                        </div>

                        <!-- Instructions -->
                        @if($transportRequest->instructions)
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 mb-2">Instructions spéciales</h3>
                                <p class="text-sm text-gray-600 bg-gray-50 p-4 rounded-lg leading-relaxed whitespace-pre-line">
                                    {{ $transportRequest->instructions }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Client info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-base font-bold text-gray-900 mb-3">Client émetteur</h2>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-base">
                                {{ strtoupper(substr($transportRequest->client->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $transportRequest->client->name }}</p>
                                <p class="text-xs text-gray-500">Ville : {{ $transportRequest->client->city ?? 'Maroc' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de proposition d'offre ou Offre existante -->
                <div class="space-y-6">
                    @php
                        $existingOffer = $myOffer ?? auth()->user()->offers->where('transport_request_id', $transportRequest->id)->first();
                    @endphp

                    @if($existingOffer)
                        <div class="bg-white rounded-xl shadow-sm border border-indigo-100 p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-indigo-600"></span>
                                    <h2 class="text-lg font-bold text-gray-900">Votre offre</h2>
                                </div>
                                <x-status-badge :status="$existingOffer->status" type="offer" />
                            </div>

                            <div class="bg-indigo-50 p-4 rounded-xl border border-indigo-100 space-y-3">
                                <div>
                                    <span class="text-xs text-indigo-700 font-medium">Montant proposé :</span>
                                    <p class="text-2xl font-black text-indigo-900">{{ number_format($existingOffer->amount, 2) }} MAD</p>
                                </div>

                                @if($existingOffer->vehicle)
                                    <div>
                                        <span class="text-xs text-indigo-700 font-medium">Véhicule proposé :</span>
                                        <p class="text-xs font-semibold text-indigo-950 mt-0.5">
                                            {{ $existingOffer->vehicle->brand }} {{ $existingOffer->vehicle->model }} ({{ $existingOffer->vehicle->registration_number }})
                                        </p>
                                    </div>
                                @endif

                                @if($existingOffer->estimated_delivery_time)
                                    <div>
                                        <span class="text-xs text-indigo-700 font-medium">Délai estimé :</span>
                                        <p class="text-xs font-semibold text-indigo-950 mt-0.5">{{ $existingOffer->estimated_delivery_time }}</p>
                                    </div>
                                @endif

                                @if($existingOffer->message)
                                    <div>
                                        <span class="text-xs text-indigo-700 font-medium">Message :</span>
                                        <p class="text-xs text-indigo-900 mt-0.5 bg-white/70 p-2.5 rounded-lg border border-indigo-100">{{ $existingOffer->message }}</p>
                                    </div>
                                @endif

                                @if($existingOffer->conditions)
                                    <div>
                                        <span class="text-xs text-indigo-700 font-medium">Conditions :</span>
                                        <p class="text-xs text-indigo-900 mt-0.5 bg-white/70 p-2.5 rounded-lg border border-indigo-100">{{ $existingOffer->conditions }}</p>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('transporteur.offers.show', $existingOffer) }}"
                               class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold rounded-xl transition">
                                Voir le détail de mon offre &rarr;
                            </a>

                            @if($existingOffer->mission)
                                <a href="{{ route('transporteur.missions.show', $existingOffer->mission) }}"
                                   class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-sm">
                                    Aller à la mission &rarr;
                                </a>
                            @endif
                        </div>
                    @elseif($transportRequest->status === 'pending')
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-1">Proposer une offre de transport</h2>
                            <p class="text-xs text-gray-500 mb-5">Indiquez votre tarif et votre véhicule pour cette cargaison.</p>

                            @php
                                $carrierVehicles = auth()->user()->vehicles()->where('available', true)->get();
                            @endphp

                            <form action="{{ route('transporteur.offers.store', $transportRequest) }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Véhicule assigné *</label>
                                    <select name="vehicle_id" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Sélectionner un véhicule disponible</option>
                                        @foreach($carrierVehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" @selected(old('vehicle_id') == $vehicle->id)>
                                                {{ $vehicle->type }} - {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->registration_number }} — {{ $vehicle->capacity }} t)
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($carrierVehicles->isEmpty())
                                        <p class="text-xs text-rose-600 mt-1">
                                            Aucun véhicule disponible.
                                            <a href="{{ route('transporteur.vehicles.create') }}" class="underline font-bold">Ajouter un véhicule</a>
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Montant proposé (MAD) *</label>
                                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required min="1" placeholder="Ex: 2500" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Délai estimé de livraison</label>
                                    <input type="text" name="estimated_delivery_time" value="{{ old('estimated_delivery_time') }}" placeholder="Ex: 24h, 2 jours..." class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Message au client</label>
                                    <textarea name="message" rows="3" placeholder="Présentez votre proposition, expérience ou disponibilités..." class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('message') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Conditions spécifiques (optionnel)</label>
                                    <textarea name="conditions" rows="2" placeholder="Ex: Paiement à la livraison, chargement inclus..." class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('conditions') }}</textarea>
                                </div>

                                <button type="submit"
                                        @disabled($carrierVehicles->isEmpty())
                                        class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50 text-white font-bold py-2.5 px-4 rounded-lg shadow-sm transition text-sm">
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
