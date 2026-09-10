<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('transporteur.vehicles.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ajouter un véhicule</h1>
                <p class="text-sm text-gray-500 mt-1">Enregistrez un nouveau véhicule dans votre flotte</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">

                <form action="{{ route('transporteur.vehicles.store') }}" method="POST" data-loading>
                    @csrf

                    <div class="space-y-6">

                        {{-- Type de véhicule --}}
                        <div>
                            <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                                Type de véhicule <span class="text-red-500">*</span>
                            </label>
                            <select id="type" name="type"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('type') border-red-400 @enderror">
                                <option value="">-- Sélectionner --</option>
                                @foreach(['Camion', 'Camion frigorifique', 'Camion plateau', 'Semi-remorque', 'Fourgon', 'Camionnette', 'Benne', 'Citerne'] as $type)
                                    <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Marque et Modèle --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="brand" class="block text-sm font-semibold text-gray-700 mb-2">Marque</label>
                                <input type="text" id="brand" name="brand" value="{{ old('brand') }}"
                                       placeholder="Mercedes, Renault..."
                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('brand') border-red-400 @enderror">
                                @error('brand')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="model" class="block text-sm font-semibold text-gray-700 mb-2">Modèle</label>
                                <input type="text" id="model" name="model" value="{{ old('model') }}"
                                       placeholder="Actros, Master..."
                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('model') border-red-400 @enderror">
                                @error('model')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Immatriculation --}}
                        <div>
                            <label for="registration_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                Plaque d'immatriculation <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="registration_number" name="registration_number" value="{{ old('registration_number') }}"
                                   placeholder="Ex: A-12345-Casa"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('registration_number') border-red-400 @enderror">
                            @error('registration_number')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Capacité --}}
                        <div>
                            <label for="capacity" class="block text-sm font-semibold text-gray-700 mb-2">
                                Capacité de charge (tonnes) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}"
                                   step="0.01" min="0" placeholder="Ex: 10.5"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('capacity') border-red-400 @enderror">
                            @error('capacity')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('transporteur.vehicles.index') }}"
                           class="px-6 py-2.5 border border-gray-300 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold rounded-xl shadow-sm transition">
                            Ajouter le véhicule
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
