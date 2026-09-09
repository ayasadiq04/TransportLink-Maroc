<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('transporteur.missions.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Mission #MIS-{{ $mission->id }}</h1>
                    <p class="text-sm text-gray-500">{{ $mission->transportRequest->title ?? $mission->offer->transportRequest->title }}</p>
                </div>
            </div>
            <div>
                <a href="{{ route('transporteur.requests.show', $mission->transportRequest ?? $mission->offer->transportRequest) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Voir la demande
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Messages flash --}}
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
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Détails & Statut -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Carte statut & Progression -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-gray-900">Progression de la mission</h2>
                            <x-status-badge :status="$mission->status" type="mission" />
                        </div>

                        <!-- Stepper visuel -->
                        <div class="relative flex items-center justify-between">
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-gray-200 w-full z-0"></div>
                            
                            @php
                                $step = match($mission->status) {
                                    'pending'     => 1,
                                    'accepted'    => 2,
                                    'in_delivery' => 3,
                                    'delivered'   => 4,
                                    'cancelled'   => 0,
                                    default       => 1
                                };
                            @endphp

                            <!-- Step 1 -->
                            <div class="relative z-10 text-center bg-white px-2">
                                <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold text-sm {{ $step >= 1 && $step > 0 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    1
                                </div>
                                <span class="text-xs font-semibold mt-1 block text-gray-700">En attente</span>
                            </div>

                            <!-- Step 2 -->
                            <div class="relative z-10 text-center bg-white px-2">
                                <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold text-sm {{ $step >= 2 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    2
                                </div>
                                <span class="text-xs font-semibold mt-1 block text-gray-700">Acceptée</span>
                            </div>

                            <!-- Step 3 -->
                            <div class="relative z-10 text-center bg-white px-2">
                                <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold text-sm {{ $step >= 3 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    3
                                </div>
                                <span class="text-xs font-semibold mt-1 block text-gray-700">En livraison</span>
                            </div>

                            <!-- Step 4 -->
                            <div class="relative z-10 text-center bg-white px-2">
                                <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center font-bold text-sm {{ $step >= 4 ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    4
                                </div>
                                <span class="text-xs font-semibold mt-1 block text-gray-700">Livrée</span>
                            </div>
                        </div>
                    </div>

                    <!-- Détails livraison -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <h2 class="text-lg font-bold text-gray-900">Informations de livraison</h2>
                            <a href="{{ route('transporteur.requests.show', $mission->transportRequest ?? $mission->offer->transportRequest) }}"
                               class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">
                                Voir la demande complète &rarr;
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <span class="text-xs font-bold uppercase text-gray-500">Adresse de collecte</span>
                                <p class="text-base font-bold text-gray-900 mt-1">{{ $mission->transportRequest->departure_city ?? $mission->offer->transportRequest->departure_city }}</p>
                                <p class="text-xs text-gray-600 mt-0.5">{{ $mission->transportRequest->departure_address ?? $mission->offer->transportRequest->departure_address ?? 'Non spécifiée' }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <span class="text-xs font-bold uppercase text-gray-500">Adresse de destination</span>
                                <p class="text-base font-bold text-gray-900 mt-1">{{ $mission->transportRequest->destination_city ?? $mission->offer->transportRequest->destination_city }}</p>
                                <p class="text-xs text-gray-600 mt-0.5">{{ $mission->transportRequest->destination_address ?? $mission->offer->transportRequest->destination_address ?? 'Non spécifiée' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Marchandise</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">
                                    {{ ucfirst(str_replace('_', ' ', $mission->transportRequest->goods_type ?? $mission->offer->transportRequest->goods_type ?? 'Standard')) }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Poids</span>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">
                                    {{ ($mission->transportRequest->weight ?? $mission->offer->transportRequest->weight) ? ($mission->transportRequest->weight ?? $mission->offer->transportRequest->weight) . ' tonnes' : 'N/A' }}
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-xs text-gray-500">Montant convenu</span>
                                <p class="text-sm font-bold text-emerald-600 mt-0.5">
                                    {{ number_format($mission->offer->amount ?? 0, 2) }} MAD
                                </p>
                            </div>
                        </div>

                        @if(($mission->transportRequest->instructions ?? $mission->offer->transportRequest->instructions))
                            <div class="pt-2">
                                <h3 class="text-xs font-bold uppercase text-gray-500 mb-1">Instructions spéciales</h3>
                                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg">
                                    {{ $mission->transportRequest->instructions ?? $mission->offer->transportRequest->instructions }}
                                </p>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Panneau d'actions & Client -->
                <div class="space-y-6">

                    <!-- Actions de mise à jour du statut -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Mettre à jour le statut</h2>

                        @if($mission->status === 'delivered')
                            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-center">
                                <svg class="w-8 h-8 text-emerald-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-sm font-bold">Mission livrée avec succès</p>
                                <p class="text-xs text-emerald-600 mt-1">
                                    Livrée le {{ $mission->delivered_at ? $mission->delivered_at->format('d/m/Y à H:i') : now()->format('d/m/Y') }}.
                                </p>
                            </div>
                        @elseif($mission->status === 'cancelled')
                            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl text-center">
                                <p class="text-sm font-bold">Mission annulée</p>
                            </div>
                        @else
                            <form action="{{ route('transporteur.missions.update-status', $mission) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Nouveau statut</label>
                                    <select name="status" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        @if($mission->status === 'pending')
                                            <option value="pending" selected>En attente (actuel)</option>
                                            <option value="accepted">Accepter / Confirmer la mission</option>
                                            <option value="in_delivery">En cours de transport</option>
                                            <option value="cancelled">Annuler la mission</option>
                                        @elseif($mission->status === 'accepted')
                                            <option value="accepted" selected>Acceptée (actuel)</option>
                                            <option value="in_delivery">Démarrer le transport (En livraison)</option>
                                            <option value="cancelled">Annuler la mission</option>
                                        @elseif($mission->status === 'in_delivery')
                                            <option value="in_delivery" selected>En cours de transport (actuel)</option>
                                            <option value="delivered">Confirmer la livraison (Livrée)</option>
                                            <option value="cancelled">Annuler la mission</option>
                                        @endif
                                    </select>
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-sm transition text-sm">
                                    Appliquer le changement
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Carte Contact Client -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-base font-bold text-gray-900 mb-3">Contact Client</h2>
                        <div class="space-y-2 text-sm">
                            <p class="font-semibold text-gray-900">{{ $mission->client->name ?? $mission->offer->transportRequest->client->name }}</p>
                            <p class="text-xs text-gray-600 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $mission->client->email ?? $mission->offer->transportRequest->client->email }}
                            </p>
                            @if(($mission->client->phone ?? $mission->offer->transportRequest->client->phone))
                                <p class="text-xs text-gray-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    {{ $mission->client->phone ?? $mission->offer->transportRequest->client->phone }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Carte Véhicule -->
                    @if($mission->vehicle)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-base font-bold text-gray-900 mb-3">Véhicule assigné</h2>
                            <div class="space-y-1 text-sm">
                                <p class="font-semibold text-gray-900">{{ $mission->vehicle->brand }} {{ $mission->vehicle->model }}</p>
                                <p class="text-xs text-gray-500">Immatriculation : <span class="font-mono font-medium text-gray-700">{{ $mission->vehicle->registration_number }}</span></p>
                                <p class="text-xs text-gray-500">Capacité : <span class="font-medium text-gray-700">{{ $mission->vehicle->capacity }} tonnes</span></p>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
