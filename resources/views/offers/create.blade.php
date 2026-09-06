<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Proposer une offre
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Répondez à la demande du client avec votre proposition.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            @if(session('error'))
                <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Résumé de la demande -->

            <div class="mb-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

                <div class="mb-5">
                    <h3 class="text-lg font-bold text-gray-900">
                        {{ $transportRequest->title }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Demande du client
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">

                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Départ
                        </p>

                        <p class="mt-1 font-semibold text-gray-900">
                            {{ $transportRequest->departure_city }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $transportRequest->departure_address }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Destination
                        </p>

                        <p class="mt-1 font-semibold text-gray-900">
                            {{ $transportRequest->destination_city }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $transportRequest->destination_address }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Collecte
                        </p>

                        <p class="mt-1 font-semibold text-gray-900">
                            {{ $transportRequest->pickup_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-gray-50 p-4">
                        <p class="text-xs font-medium uppercase text-gray-400">
                            Marchandise
                        </p>

                        <p class="mt-1 font-semibold text-gray-900">
                            {{ ucfirst(str_replace('_', ' ', $transportRequest->goods_type)) }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- Formulaire -->

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

                <form method="POST"
                      action="{{ route('offers.store', $transportRequest) }}">

                    @csrf

                    <!-- Vehicle -->

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Véhicule
                        </label>

                        <select name="vehicle_id"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">
                                Sélectionner un véhicule
                            </option>

                            @foreach($vehicles as $vehicle)

                                <option value="{{ $vehicle->id }}"
                                    @selected(old('vehicle_id') == $vehicle->id)>

                                    {{ $vehicle->type }}
                                    -
                                    {{ $vehicle->brand ?? 'Sans marque' }}
                                    {{ $vehicle->model ?? '' }}
                                    -
                                    {{ $vehicle->capacity }} tonnes

                                </option>

                            @endforeach

                        </select>

                        @if($vehicles->isEmpty())
                            <p class="mt-2 text-sm text-red-600">
                                Aucun véhicule disponible.
                                <a href="{{ route('vehicles.create') }}"
                                   class="font-semibold underline">
                                    Ajouter un véhicule
                                </a>
                            </p>
                        @endif

                        @error('vehicle_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Amount -->

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Montant proposé (MAD)
                        </label>

                        <input type="number"
                               name="amount"
                               step="0.01"
                               min="0"
                               value="{{ old('amount') }}"
                               placeholder="Ex : 2500"
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Delivery time -->

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Délai estimé de livraison
                        </label>

                        <input type="text"
                               name="estimated_delivery_time"
                               value="{{ old('estimated_delivery_time') }}"
                               placeholder="Ex : 24 heures"
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Message -->

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Message
                        </label>

                        <textarea name="message"
                                  rows="4"
                                  placeholder="Présentez votre proposition au client..."
                                  class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('message') }}</textarea>

                        @error('message')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Conditions -->

                    <div class="mb-8">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Conditions
                        </label>

                        <textarea name="conditions"
                                  rows="3"
                                  placeholder="Ex : Paiement à la livraison..."
                                  class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('conditions') }}</textarea>
                    </div>

                    <!-- Buttons -->

                    <div class="flex flex-col gap-3 sm:flex-row">

                        <button type="submit"
                                class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                            Envoyer mon offre
                        </button>

                        <a href="{{ route('transporteur.requests.index') }}"
                           class="rounded-xl bg-gray-100 px-6 py-3 text-center text-sm font-semibold text-gray-700 transition hover:bg-gray-200">
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>