<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('client.transport-requests.show', $transportRequest) }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Modifier la demande #{{ $transportRequest->id }}</h1>
                <p class="text-sm text-gray-500">Mettez à jour les informations de votre cargaison ou de votre trajet</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('client.transport-requests.update', $transportRequest) }}" method="POST" class="space-y-6" data-loading>
                @csrf
                @method('PUT')

                <!-- Section 1 : Trajet -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                    <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3">1. Trajet</h2>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Titre de l'annonce *</label>
                        <input type="text" name="title" required value="{{ old('title', $transportRequest->title) }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Départ -->
                        <div class="space-y-4 bg-emerald-50/50 p-4 rounded-xl border border-emerald-100">
                            <h3 class="text-xs font-bold text-emerald-800 uppercase">Collecte</h3>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Ville de départ *</label>
                                <input type="text" name="departure_city" required value="{{ old('departure_city', $transportRequest->departure_city) }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Adresse de collecte</label>
                                <input type="text" name="departure_address" value="{{ old('departure_address', $transportRequest->departure_address) }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                            </div>
                        </div>

                        <!-- Arrivée -->
                        <div class="space-y-4 bg-rose-50/50 p-4 rounded-xl border border-rose-100">
                            <h3 class="text-xs font-bold text-rose-800 uppercase">Livraison</h3>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Ville de destination *</label>
                                <input type="text" name="destination_city" required value="{{ old('destination_city', $transportRequest->destination_city) }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Adresse de livraison</label>
                                <input type="text" name="destination_address" value="{{ old('destination_address', $transportRequest->destination_address) }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2 : Marchandise & Budget -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                    <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3">2. Détails & Spécifications</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Type de marchandise *</label>
                            <select name="goods_type" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach([
                                    'palette' => 'Palette',
                                    'vrac' => 'Vrac',
                                    'frigorifique' => 'Frigorifique',
                                    'liquide' => 'Liquide',
                                    'colis_volumineux' => 'Colis volumineux',
                                    'autre' => 'Autre'
                                ] as $val => $lbl)
                                    <option value="{{ $val }}" {{ old('goods_type', $transportRequest->goods_type) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Poids (kg)</label>
                            <input type="number" step="0.01" name="weight" value="{{ old('weight', $transportRequest->weight) }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Volume (m³)</label>
                            <input type="number" step="0.01" name="volume" value="{{ old('volume', $transportRequest->volume) }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Date et heure souhaitées</label>
                            <input type="datetime-local" name="pickup_at" value="{{ old('pickup_at', $transportRequest->pickup_at ? $transportRequest->pickup_at->format('Y-m-d\TH:i') : '') }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Budget estimé (DH)</label>
                            <input type="number" step="0.01" name="estimated_budget" value="{{ old('estimated_budget', $transportRequest->estimated_budget) }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Instructions</label>
                        <textarea name="instructions" rows="4" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('instructions', $transportRequest->instructions) }}</textarea>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('client.transport-requests.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-lg shadow-sm transition">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
