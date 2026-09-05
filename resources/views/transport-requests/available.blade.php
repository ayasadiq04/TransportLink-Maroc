<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Demandes de transport disponibles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($requests->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-600">
                        Aucune demande de transport disponible pour le moment.
                    </p>
                </div>
            @else

                <div class="grid gap-6">

                    @foreach ($requests as $transportRequest)

                        <div class="bg-white p-6 rounded-lg shadow">

                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $transportRequest->title }}
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Client #{{ $transportRequest->client_id }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                                    {{ $transportRequest->status }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Départ
                                    </p>

                                    <p class="font-medium">
                                        {{ $transportRequest->departure_city }}
                                    </p>

                                    <p class="text-sm text-gray-600">
                                        {{ $transportRequest->departure_address }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Destination
                                    </p>

                                    <p class="font-medium">
                                        {{ $transportRequest->destination_city }}
                                    </p>

                                    <p class="text-sm text-gray-600">
                                        {{ $transportRequest->destination_address }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Type de marchandise
                                    </p>

                                    <p class="font-medium">
                                        {{ $transportRequest->goods_type }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500">
                                        Poids
                                    </p>

                                    <p class="font-medium">
                                        {{ $transportRequest->weight ?? '-' }} kg
                                    </p>
                                </div>

                            </div>

                            @if ($transportRequest->estimated_budget)
                                <p class="mb-4">
                                    <span class="text-gray-500">
                                        Budget estimé :
                                    </span>

                                    <span class="font-semibold">
                                        {{ $transportRequest->estimated_budget }} DH
                                    </span>
                                </p>
                            @endif

                            <div class="flex justify-end">

                                <a
                                    href="{{ route('offers.create', $transportRequest) }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                >
                                    Proposer une offre
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>
    </div>

</x-app-layout>