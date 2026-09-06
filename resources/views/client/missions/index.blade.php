<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Mes missions</h1>
                <p class="text-sm text-gray-500 mt-1">Suivi de vos livraisons</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($missions->count())
                <div class="space-y-4">
                    @foreach($missions as $mission)
                        <a href="{{ route('client.missions.show', $mission) }}"
                           class="block bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-md hover:border-blue-200 transition-all">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-4 min-w-0">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center text-white font-bold flex-shrink-0">
                                        #{{ $mission->id }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-900">{{ $mission->transportRequest->title }}</p>
                                        <div class="flex items-center gap-1 text-sm text-gray-500 mt-0.5">
                                            <span>{{ $mission->transportRequest->departure_city }}</span>
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                            <span>{{ $mission->transportRequest->destination_city }}</span>
                                        </div>
                                        <p class="text-xs text-gray-400 mt-0.5">Transporteur : {{ $mission->transporteur->name }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                    <x-status-badge :status="$mission->status" type="mission"/>
                                    @if($mission->status === 'delivered' && !$mission->review)
                                        <span class="text-xs text-amber-600 font-medium">⭐ À évaluer</span>
                                    @endif
                                    @if($mission->planned_at)
                                        <p class="text-xs text-gray-400">{{ $mission->planned_at->format('d/m/Y') }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                    <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucune mission</h3>
                    <p class="text-gray-500 mb-6">Acceptez une offre sur vos demandes pour créer une mission.</p>
                    <a href="{{ route('client.transport-requests.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                        Voir mes demandes
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
