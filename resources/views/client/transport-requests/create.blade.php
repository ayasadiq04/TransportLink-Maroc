<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('client.transport-requests.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Publier une demande de transport</h1>
                <p class="text-sm text-gray-500">Renseignez les détails de votre cargaison pour recevoir des offres des transporteurs certifiés</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('client.transport-requests.store') }}" method="POST" class="space-y-6" data-loading>
                @csrf

                <!-- Section 1 : Titre & Trajet -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                    <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3">1. Informations sur le trajet</h2>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Titre de l'annonce *</label>
                        <input type="text" name="title" required value="{{ old('title') }}" placeholder="Ex: Transport de meubles - Casablanca vers Marrakech" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Départ -->
                        <div class="space-y-4 bg-emerald-50/50 p-4 rounded-xl border border-emerald-100">
                            <h3 class="text-xs font-bold text-emerald-800 uppercase">Lieu de collecte</h3>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Ville de départ *</label>
                                <input type="text" name="departure_city" required value="{{ old('departure_city') }}" placeholder="Ex: Casablanca" class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                @error('departure_city') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Adresse précise de collecte</label>
                                <input type="text" name="departure_address" value="{{ old('departure_address') }}" placeholder="Ex: Quartier Maârif, Rue 12" class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                            </div>
                        </div>

                        <!-- Arrivée -->
                        <div class="space-y-4 bg-rose-50/50 p-4 rounded-xl border border-rose-100">
                            <h3 class="text-xs font-bold text-rose-800 uppercase">Lieu de livraison</h3>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Ville de destination *</label>
                                <input type="text" name="destination_city" required value="{{ old('destination_city') }}" placeholder="Ex: Marrakech" class="w-full text-sm rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500">
                                @error('destination_city') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Adresse de livraison</label>
                                <input type="text" name="destination_address" value="{{ old('destination_address') }}" placeholder="Ex: Zone Industrielle Sidi Ghanem" class="w-full text-sm rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2 : Marchandise & Budget -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                    <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3">2. Détails de la cargaison</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Type de marchandise *</label>
                            <select name="goods_type" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Sélectionner</option>
                                <option value="palette" {{ old('goods_type') === 'palette' ? 'selected' : '' }}>Palette</option>
                                <option value="vrac" {{ old('goods_type') === 'vrac' ? 'selected' : '' }}>Vrac</option>
                                <option value="frigorifique" {{ old('goods_type') === 'frigorifique' ? 'selected' : '' }}>Frigorifique</option>
                                <option value="liquide" {{ old('goods_type') === 'liquide' ? 'selected' : '' }}>Liquide</option>
                                <option value="colis_volumineux" {{ old('goods_type') === 'colis_volumineux' ? 'selected' : '' }}>Colis volumineux</option>
                                <option value="autre" {{ old('goods_type') === 'autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('goods_type') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Poids total estimé (kg)</label>
                            <input type="number" step="0.01" name="weight" value="{{ old('weight') }}" placeholder="Ex: 450" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Volume estimé (m³)</label>
                            <input type="number" step="0.01" name="volume" value="{{ old('volume') }}" placeholder="Ex: 3.5" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Date et heure souhaitées</label>
                            <input type="datetime-local" name="pickup_at" value="{{ old('pickup_at') }}" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Budget indicatif (DH)</label>
                            <input type="number" step="0.01" name="estimated_budget" value="{{ old('estimated_budget') }}" placeholder="Ex: 2000" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Instructions particulières & Description</label>
                        <textarea name="instructions" rows="4" placeholder="Précisez tout détail utile : besoin de hayon, manutention, accès difficile, etc." class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('instructions') }}</textarea>
                    </div>
                </div>

                <!-- Boutons de soumission -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('client.transport-requests.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-lg shadow-sm transition">
                        Publier la demande &rarr;
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
