<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ma flotte de véhicules</h1>
                <p class="text-sm text-gray-500 mt-1">Gérez vos camions, fourgons et véhicules de transport</p>
            </div>
            <a href="{{ route('transporteur.vehicles.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter un véhicule
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if($vehicles->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                    <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucun véhicule enregistré</h3>
                    <p class="text-gray-500 mb-6">Ajoutez votre premier véhicule pour pouvoir postuler aux demandes de transport.</p>
                    <a href="{{ route('transporteur.vehicles.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Ajouter mon premier véhicule
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($vehicles as $vehicle)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-orange-50 text-orange-700">
                                        {{ $vehicle->type }}
                                    </span>
                                    <span class="text-xs font-mono font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded">
                                        {{ $vehicle->registration_number }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $vehicle->brand }} {{ $vehicle->model }}</h3>

                                <div class="bg-gray-50 rounded-xl p-3 space-y-2 text-xs text-gray-600 mb-4">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700">Capacité</span>
                                        <span class="font-semibold text-gray-900">{{ $vehicle->capacity }} tonnes</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-700">Disponibilité</span>
                                        @if($vehicle->available)
                                            <span class="inline-flex items-center gap-1 text-emerald-700 font-semibold">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                Disponible
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 text-rose-600 font-semibold">
                                                <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                                                En mission
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                <a href="{{ route('transporteur.vehicles.edit', $vehicle) }}"
                                   class="inline-flex items-center gap-1 text-sm font-semibold text-orange-600 hover:text-orange-800 transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Modifier
                                </a>

                                @if($vehicle->available)
                                    <button type="button"
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-vehicle-delete-{{ $vehicle->id }}')"
                                            class="inline-flex items-center gap-1 text-sm font-semibold text-rose-600 hover:text-rose-800 transition">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Supprimer
                                    </button>

                                    <x-confirm-modal
                                        :name="'confirm-vehicle-delete-'.$vehicle->id"
                                        title="Supprimer ce véhicule"
                                        message="Confirmer la suppression de ce véhicule ? Cette action est définitive."
                                        :action="route('transporteur.vehicles.destroy', $vehicle)"
                                    />
                                @else
                                    <span class="text-xs text-gray-400">En mission</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
