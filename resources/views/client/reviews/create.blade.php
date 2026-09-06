<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('client.missions.show', $mission) }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Évaluer le transporteur</h1>
                <p class="text-sm text-gray-500">Mission #MIS-{{ $mission->id }} • {{ $mission->transporteur->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
                
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-tr from-amber-500 to-amber-300 rounded-full flex items-center justify-center text-white text-2xl font-black mx-auto mb-3 shadow-md">
                        {{ strtoupper(substr($mission->transporteur->name, 0, 1)) }}
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">{{ $mission->transporteur->name }}</h2>
                    <p class="text-xs text-gray-500">Course : {{ $mission->transportRequest->departure_city }} &rarr; {{ $mission->transportRequest->destination_city }}</p>
                </div>

                <form action="{{ route('client.reviews.store', $mission) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Sélection étoiles -->
                    <div x-data="{ rating: {{ old('rating', 5) }} }">
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-2 text-center">Note globale *</label>
                        <div class="flex items-center justify-center gap-2">
                            <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                                <button type="button" @click="rating = star" class="text-3xl focus:outline-none transition-transform hover:scale-110">
                                    <span :class="star <= rating ? 'text-amber-400' : 'text-gray-200'">★</span>
                                </button>
                            </template>
                        </div>
                        <input type="hidden" name="rating" :value="rating">
                        @error('rating') <p class="text-xs text-rose-500 text-center mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Votre commentaire (optionnel)</label>
                        <textarea name="comment" rows="4" placeholder="Ponctualité, soin de la marchandise, communication..." class="w-full text-sm rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500">{{ old('comment') }}</textarea>
                        @error('comment') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('client.missions.show', $mission) }}" class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm rounded-lg shadow-sm transition">
                            Publier mon avis
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
