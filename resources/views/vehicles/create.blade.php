<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('vehicles.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ajouter un véhicule</h1>
                <p class="text-sm text-gray-500">Enregistrez un nouveau camion ou véhicule utilitaire dans votre flotte</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <form method="POST" action="{{ route('vehicles.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Type de véhicule *</label>
                        <select name="type" required class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Sélectionner</option>
                            <option value="Camion" {{ old('type') === 'Camion' ? 'selected' : '' }}>Camion</option>
                            <option value="Camionnette" {{ old('type') === 'Camionnette' ? 'selected' : '' }}>Camionnette</option>
                            <option value="Fourgon" {{ old('type') === 'Fourgon' ? 'selected' : '' }}>Fourgon</option>
                            <option value="Semi-remorque" {{ old('type') === 'Semi-remorque' ? 'selected' : '' }}>Semi-remorque</option>
                            <option value="Autre" {{ old('type') === 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('type') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Marque *</label>
                            <input type="text" name="brand" required value="{{ old('brand') }}" placeholder="Ex: Renault Trucks, Mercedes..." class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('brand') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Modèle *</label>
                            <input type="text" name="model" required value="{{ old('model') }}" placeholder="Ex: Master, Actros..." class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('model') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Immatriculation *</label>
                            <input type="text" name="registration_number" required value="{{ old('registration_number') }}" placeholder="Ex: 12345-A-6" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('registration_number') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase mb-1">Capacité (tonnes) *</label>
                            <input type="number" step="0.01" min="0" name="capacity" required value="{{ old('capacity') }}" placeholder="Ex: 3.5" class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('capacity') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('vehicles.index') }}" class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Annuler
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-lg shadow-sm transition">
                            Ajouter le véhicule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>