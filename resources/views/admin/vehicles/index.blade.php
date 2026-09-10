<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Parc de Véhicules</h1>
                <p class="text-sm text-gray-500 mt-1">Supervision de tous les véhicules enregistrés sur la plateforme</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; Retour au dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Véhicule</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Transporteur</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Immatriculation</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Capacité</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Disponibilité</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ajouté le</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($vehicles as $vehicle)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-semibold text-gray-900">{{ $vehicle->brand }} {{ $vehicle->model }}</div>
                                        <div class="text-xs text-gray-500">{{ $vehicle->year ?? 'Année non renseignée' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $vehicle->transporteur->name ?? '—' }}</div>
                                        <div class="text-gray-400">{{ $vehicle->transporteur->email ?? '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst(str_replace('_', ' ', $vehicle->type ?? 'Non spécifié')) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-mono font-medium text-gray-900 whitespace-nowrap">
                                        {{ $vehicle->registration_number ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600 whitespace-nowrap">
                                        <span class="font-semibold text-gray-900">{{ $vehicle->capacity ?? '—' }}</span> tonnes
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($vehicle->available)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                                ● Disponible
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                ● En mission / Indisponible
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                        {{ $vehicle->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-500">
                                        Aucun véhicule enregistré pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($vehicles, 'links'))
                <div class="mt-6">
                    {{ $vehicles->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
