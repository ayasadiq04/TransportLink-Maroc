<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ma flotte de véhicules</h1>
                <p class="text-sm text-gray-500 mt-1">Gérez vos camions, fourgons et véhicules de transport</p>
            </div>
            <a href="{{ route('transporteur.vehicles.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold shadow-sm transition">
                + Ajouter un véhicule
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if($vehicles->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Aucun véhicule enregistré</h3>
                    <p class="mt-1 text-sm text-gray-500">Ajoutez votre premier véhicule pour pouvoir postuler aux demandes de transport.</p>
                    <div class="mt-6">
                        <a href="{{ route('transporteur.vehicles.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                            Ajouter un véhicule
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($vehicles as $vehicle)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                                        {{ $vehicle->type }}
                                    </span>
                                    <span class="text-xs font-mono font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded">
                                        {{ $vehicle->registration_number }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $vehicle->brand }} {{ $vehicle->model }}</h3>

                                <div class="bg-gray-50 rounded-lg p-3 space-y-1.5 text-xs text-gray-600 mb-4">
                                    <p><span class="font-semibold text-gray-800">Capacité :</span> {{ $vehicle->capacity }} tonnes</p>
                                    @if($vehicle->is_available !== null)
                                        <p><span class="font-semibold text-gray-800">Disponibilité :</span> 
                                            <span class="{{ $vehicle->is_available ? 'text-emerald-600 font-semibold' : 'text-rose-600 font-semibold' }}">
                                                {{ $vehicle->is_available ? 'Disponible' : 'En mission' }}
                                            </span>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                <a href="{{ route('transporteur.vehicles.edit', $vehicle) }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-900">
                                    Modifier
                                </a>

                                <form action="{{ route('transporteur.vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de ce véhicule ?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-900">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>