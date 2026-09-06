<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Mes missions de transport</h1>
                <p class="text-sm text-gray-500 mt-1">Gérez vos courses en cours et mettez à jour l'état de livraison</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if($missions->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Aucune mission pour le moment</h3>
                    <p class="mt-1 text-sm text-gray-500">Dès qu'un client accepte l'une de vos offres, la mission apparaîtra ici.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($missions as $mission)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs font-mono font-bold text-gray-400">#MIS-{{ $mission->id }}</span>
                                    <x-status-badge :status="$mission->status" type="mission" />
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $mission->offer->transportRequest->title }}</h3>
                                <p class="text-xs text-gray-500 mb-4">Client : {{ $mission->offer->transportRequest->client->name }}</p>

                                <div class="bg-gray-50 rounded-lg p-3 space-y-2 text-sm mb-4">
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500">Trajet :</span>
                                        <span class="font-medium text-gray-900">{{ $mission->offer->transportRequest->departure_city }} &rarr; {{ $mission->offer->transportRequest->arrival_city }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500">Montant convenu :</span>
                                        <span class="font-bold text-emerald-600">{{ number_format($mission->offer->price, 2) }} DH</span>
                                    </div>
                                    @if($mission->vehicle)
                                        <div class="flex items-center justify-between text-xs">
                                            <span class="text-gray-500">Véhicule :</span>
                                            <span class="text-gray-700">{{ $mission->vehicle->brand }} ({{ $mission->vehicle->license_plate }})</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100">
                                <a href="{{ route('transporteur.missions.show', $mission) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                                    Gérer la mission &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(method_exists($missions, 'links'))
                    <div class="mt-6">
                        {{ $missions->links() }}
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>
