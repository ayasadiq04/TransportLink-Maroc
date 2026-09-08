<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des Missions</h1>
                <p class="text-sm text-gray-500 mt-1">Supervision de l'ensemble des missions de transport</p>
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
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mission</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Transporteur</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Véhicule</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($missions as $mission)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $mission->transportRequest?->title ?? $mission->offer?->transportRequest?->title ?? 'Demande #'.$mission->transport_request_id }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ $mission->transportRequest?->departure_city ?? $mission->offer?->transportRequest?->departure_city ?? '—' }} &rarr; {{ $mission->transportRequest?->destination_city ?? $mission->offer?->transportRequest?->destination_city ?? '—' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700">
                                        <div class="font-medium text-gray-900">{{ $mission->client?->name ?? $mission->offer?->transportRequest?->client?->name ?? '—' }}</div>
                                        <div class="text-gray-400">{{ $mission->client?->email ?? $mission->offer?->transportRequest?->client?->email ?? '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-700">
                                        <div class="font-medium text-gray-900">{{ $mission->transporteur?->name ?? '—' }}</div>
                                        <div class="text-gray-400">{{ $mission->transporteur?->email ?? '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-bold text-gray-900 whitespace-nowrap">
                                        {{ number_format($mission->offer?->amount ?? 0, 2) }} DH
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600 whitespace-nowrap">
                                        {{ $mission->vehicle ? ($mission->vehicle->brand . ' ' . $mission->vehicle->model) : '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-status-badge :status="$mission->status" type="mission" />
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                        {{ $mission->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($missions, 'links'))
                <div class="mt-6">
                    {{ $missions->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
