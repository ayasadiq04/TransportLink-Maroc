<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un véhicule
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm rounded-lg">

                <form method="POST"
                      action="{{ route('vehicles.store') }}">

                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2">
                            Type de véhicule
                        </label>

                        <select name="type"
                                class="w-full border-gray-300 rounded-md">

                            <option value="">Sélectionner</option>
                            <option value="Camion">Camion</option>
                            <option value="Camionnette">Camionnette</option>
                            <option value="Fourgon">Fourgon</option>
                            <option value="Semi-remorque">Semi-remorque</option>
                            <option value="Autre">Autre</option>

                        </select>

                        @error('type')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Marque</label>

                        <input type="text"
                               name="brand"
                               value="{{ old('brand') }}"
                               class="w-full border-gray-300 rounded-md">

                        @error('brand')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">Modèle</label>

                        <input type="text"
                               name="model"
                               value="{{ old('model') }}"
                               class="w-full border-gray-300 rounded-md">

                        @error('model')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">
                            Numéro d'immatriculation
                        </label>

                        <input type="text"
                               name="registration_number"
                               value="{{ old('registration_number') }}"
                               class="w-full border-gray-300 rounded-md">

                        @error('registration_number')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2">
                            Capacité (tonnes)
                        </label>

                        <input type="number"
                               name="capacity"
                               step="0.01"
                               min="0"
                               value="{{ old('capacity') }}"
                               class="w-full border-gray-300 rounded-md">

                        @error('capacity')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex gap-3">

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Ajouter
                        </button>

                        <a href="{{ route('vehicles.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>