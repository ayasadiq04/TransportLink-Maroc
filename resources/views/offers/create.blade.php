<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Proposer une offre
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Messages --}}
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Erreurs validation --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-6">
                    Détails de la demande
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

                    <div>
                        <p class="text-sm text-gray-500">
                            Départ
                        </p>

                        <p class="font-semibold">
                            {{ $transportRequest->departure }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Destination
                        </p>

                        <p class="font-semibold">
                            {{ $transportRequest->destination }}
                        </p>
                    </div>

                </div>

                <form
                    method="POST"
                    action="{{ route('offers.store', $transportRequest) }}"
                >

                    @csrf

                    {{-- Véhicule --}}
                    <div class="mb-6">

                        <label
                            for="vehicle_id"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Véhicule
                        </label>

                        <select
                            name="vehicle_id"
                            id="vehicle_id"
                            required
                            class="w-full rounded-md border-gray-300 shadow-sm"
                        >

                            <option value="">
                                -- Sélectionner un véhicule --
                            </option>

                            @foreach ($vehicles as $vehicle)

                                <option
                                    value="{{ $vehicle->id }}"
                                    {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}
                                >
                                    {{ $vehicle->brand }}
                                    {{ $vehicle->model }}
                                    - {{ $vehicle->registration_number }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Prix --}}
                    <div class="mb-6">

                        <label
                            for="price"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Prix proposé (DH)
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            value="{{ old('price') }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full rounded-md border-gray-300 shadow-sm"
                            placeholder="Ex: 1500"
                        >

                    </div>

                    {{-- Message --}}
                    <div class="mb-6">

                        <label
                            for="message"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Message
                        </label>

                        <textarea
                            name="message"
                            id="message"
                            rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm"
                            placeholder="Ajouter un message pour le client..."
                        >{{ old('message') }}</textarea>

                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        >
                            Proposer l'offre
                        </button>

                        <a
                            href="{{ route('transport-requests.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                        >
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout><x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Proposer une offre
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Messages d'erreur --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Informations de la demande --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Demande de transport
                </h3>

                <div class="space-y-2 text-gray-700">
                    <p>
                        <strong>Titre :</strong>
                        {{ $transportRequest->title }}
                    </p>

                    <p>
                        <strong>Départ :</strong>
                        {{ $transportRequest->departure_city }}
                        -
                        {{ $transportRequest->departure_address }}
                    </p>

                    <p>
                        <strong>Destination :</strong>
                        {{ $transportRequest->destination_city }}
                        -
                        {{ $transportRequest->destination_address }}
                    </p>

                    <p>
                        <strong>Type de marchandise :</strong>
                        {{ $transportRequest->goods_type }}
                    </p>

                    @if ($transportRequest->weight)
                        <p>
                            <strong>Poids :</strong>
                            {{ $transportRequest->weight }}
                        </p>
                    @endif

                    @if ($transportRequest->volume)
                        <p>
                            <strong>Volume :</strong>
                            {{ $transportRequest->volume }}
                        </p>
                    @endif

                    @if ($transportRequest->estimated_budget)
                        <p>
                            <strong>Budget estimé :</strong>
                            {{ $transportRequest->estimated_budget }} DH
                        </p>
                    @endif
                </div>

            </div>

            {{-- Formulaire --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-6">
                    Votre proposition
                </h3>

                <form
                    method="POST"
                    action="{{ route('offers.store', $transportRequest) }}"
                >
                    @csrf

                    {{-- Véhicule --}}
                    <div class="mb-6">
                        <label
                            for="vehicle_id"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Véhicule
                        </label>

                        <select
                            name="vehicle_id"
                            id="vehicle_id"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">
                                -- Sélectionner un véhicule --
                            </option>

                            @foreach ($vehicles as $vehicle)
                                <option
                                    value="{{ $vehicle->id }}"
                                    {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}
                                >
                                    {{ $vehicle->brand }}
                                    {{ $vehicle->model }}
                                    - {{ $vehicle->registration_number }}
                                </option>
                            @endforeach
                        </select>

                        @if ($vehicles->isEmpty())
                            <p class="mt-2 text-sm text-red-600">
                                Vous n'avez aucun véhicule enregistré.
                                Ajoutez d'abord un véhicule.
                            </p>
                        @endif
                    </div>

                    {{-- Prix --}}
                    <div class="mb-6">
                        <label
                            for="price"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Prix proposé (DH)
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            value="{{ old('price') }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Ex : 1500"
                        >
                    </div>

                    {{-- Message --}}
                    <div class="mb-6">
                        <label
                            for="message"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Message
                        </label>

                        <textarea
                            name="message"
                            id="message"
                            rows="4"
                            maxlength="1000"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Ajoutez un message pour le client..."
                        >{{ old('message') }}</textarea>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3">

                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                            {{ $vehicles->isEmpty() ? 'disabled' : '' }}
                        >
                            Proposer l'offre
                        </button>

                        <a
                            href="{{ route('transport-requests.index') }}"
                            class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                        >
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>