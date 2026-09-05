<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier la demande
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm rounded-lg">

                <form method="POST"
                      action="{{ route('transport-requests.update', $transportRequest) }}">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2">Titre</label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $transportRequest->title) }}"
                               class="w-full border-gray-300 rounded-md">
                        @error('title')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Ville de départ</label>
                        <input type="text"
                               name="departure_city"
                               value="{{ old('departure_city', $transportRequest->departure_city) }}"
                               class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Adresse de départ</label>
                        <input type="text"
                               name="departure_address"
                               value="{{ old('departure_address', $transportRequest->departure_address) }}"
                               class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Ville de destination</label>
                        <input type="text"
                               name="destination_city"
                               value="{{ old('destination_city', $transportRequest->destination_city) }}"
                               class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Adresse de destination</label>
                        <input type="text"
                               name="destination_address"
                               value="{{ old('destination_address', $transportRequest->destination_address) }}"
                               class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Date et heure de collecte</label>
                        <input type="datetime-local"
                               name="pickup_at"
                               value="{{ old('pickup_at', $transportRequest->pickup_at->format('Y-m-d\TH:i')) }}"
                               class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Type de marchandise</label>

                        <select name="goods_type"
                                class="w-full border-gray-300 rounded-md">

                            @foreach([
                                'palette' => 'Palette',
                                'vrac' => 'Vrac',
                                'frigorifique' => 'Frigorifique',
                                'liquide' => 'Liquide',
                                'colis_volumineux' => 'Colis volumineux',
                                'autre' => 'Autre'
                            ] as $value => $label)

                                <option value="{{ $value }}"
                                    @selected(old('goods_type', $transportRequest->goods_type) === $value)>
                                    {{ $label }}
                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Poids</label>
                        <input type="number"
                               step="0.01"
                               name="weight"
                               value="{{ old('weight', $transportRequest->weight) }}"
                               class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Volume</label>
                        <input type="number"
                               step="0.01"
                               name="volume"
                               value="{{ old('volume', $transportRequest->volume) }}"
                               class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Budget estimé (MAD)</label>
                        <input type="number"
                               step="0.01"
                               name="estimated_budget"
                               value="{{ old('estimated_budget', $transportRequest->estimated_budget) }}"
                               class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Instructions</label>

                        <textarea name="instructions"
                                  rows="4"
                                  class="w-full border-gray-300 rounded-md">{{ old('instructions', $transportRequest->instructions) }}</textarea>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Enregistrer les modifications
                    </button>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>