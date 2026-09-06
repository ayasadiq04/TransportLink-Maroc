<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Profil Transporteur</h1>
                <p class="text-sm text-gray-500">Consultez les informations et les évaluations clients de ce transporteur</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Carte principale du Transporteur -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                    <div class="w-20 h-20 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-3xl font-black shadow-md flex-shrink-0">
                        {{ strtoupper(substr($transporteur->name, 0, 1)) }}
                    </div>

                    <div class="flex-1 text-center sm:text-left space-y-2">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $transporteur->name }}</h2>
                            <div class="inline-flex items-center gap-1.5 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                                <span class="text-amber-500 font-black">★</span>
                                <span class="text-sm font-bold text-amber-900">{{ $averageRating > 0 ? $averageRating.'/5' : 'Nouveau' }}</span>
                                <span class="text-xs text-amber-700">({{ $totalReviews }} avis)</span>
                            </div>
                        </div>

                        <p class="text-xs text-gray-500">Membre depuis le {{ $transporteur->created_at->format('d/m/Y') }} • {{ $transporteur->city ?? 'Maroc' }}</p>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-3 border-t border-gray-100">
                            <div>
                                <span class="text-xs text-gray-400 block">Flotte</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $transporteur->vehicles->count() }} véhicule(s)</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Missions réalisées</span>
                                <span class="text-sm font-semibold text-emerald-600">{{ $transporteur->missionsAsTransporteur()->where('status', 'delivered')->count() }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 block">Téléphone</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $transporteur->phone ?? 'Vérifié' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flotte de véhicules -->
            @if($transporteur->vehicles->isNotEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-base font-bold text-gray-900 mb-4">Véhicules enregistrés</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($transporteur->vehicles as $veh)
                            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $veh->brand }} {{ $veh->model }}</p>
                                    <p class="text-xs text-gray-500">{{ $veh->type }} • {{ $veh->capacity }}T</p>
                                </div>
                                <span class="text-xs font-mono font-semibold bg-white border border-gray-200 px-2 py-1 rounded text-gray-700">
                                    {{ $veh->registration_number }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Avis reçus -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-base font-bold text-gray-900 mb-6">Avis et retours clients ({{ $totalReviews }})</h3>

                @if($reviews->isEmpty())
                    <p class="text-sm text-gray-500 text-center py-8">Aucun avis laissé pour le moment.</p>
                @else
                    <div class="divide-y divide-gray-100 space-y-4">
                        @foreach($reviews as $rev)
                            <div class="pt-4 first:pt-0">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-semibold text-sm text-gray-900">{{ $rev->client->name }}</span>
                                    <span class="text-xs text-gray-400">{{ $rev->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1 text-amber-400 text-sm mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span>{{ $i <= $rev->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </div>
                                @if($rev->comment)
                                    <p class="text-xs text-gray-700 bg-gray-50 p-3 rounded-lg leading-relaxed">{{ $rev->comment }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if(method_exists($reviews, 'links'))
                        <div class="mt-6">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
