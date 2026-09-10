<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('client.missions.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Mission #{{ $mission->id }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Détail de votre livraison</p>
                </div>
            </div>
            <div>
                <a href="{{ route('client.transport-requests.show', $mission->transportRequest) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Voir la demande
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Statut + progression -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-semibold text-gray-900">Progression de la mission</h2>
                    <x-status-badge :status="$mission->status" type="mission"/>
                </div>

                <!-- Barre de progression -->
                <div class="relative">
                    <div class="flex items-center justify-between relative z-10">
                        @php
                            $steps = ['pending' => 0, 'accepted' => 1, 'in_delivery' => 2, 'delivered' => 3];
                            $currentStep = $steps[$mission->status] ?? 0;
                        @endphp

                        @foreach([
                            ['label' => 'Créée', 'icon' => '📋'],
                            ['label' => 'Acceptée', 'icon' => '✅'],
                            ['label' => 'En livraison', 'icon' => '🚚'],
                            ['label' => 'Livrée', 'icon' => '📦'],
                        ] as $i => $step)
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg
                                    {{ $i <= $currentStep ? 'bg-blue-600 shadow-lg shadow-blue-200' : 'bg-gray-100' }}">
                                    {{ $step['icon'] }}
                                </div>
                                <p class="text-xs font-medium mt-2 {{ $i <= $currentStep ? 'text-blue-700' : 'text-gray-400' }}">
                                    {{ $step['label'] }}
                                </p>
                            </div>
                            @if($i < 3)
                                <div class="flex-1 h-1 mx-2 rounded-full {{ $i < $currentStep ? 'bg-blue-600' : 'bg-gray-100' }} self-start mt-5"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-6">

                <!-- Détails de la demande -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-gray-900">Détails de la livraison</h2>
                        <a href="{{ route('client.transport-requests.show', $mission->transportRequest) }}"
                           class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition">
                            Voir la demande &rarr;
                        </a>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500">Marchandise</p>
                            <p class="font-medium text-gray-900">{{ $mission->transportRequest->title }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs text-gray-500">Départ</p>
                                <p class="text-sm font-medium text-gray-900">{{ $mission->transportRequest->departure_city }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Destination</p>
                                <p class="text-sm font-medium text-gray-900">{{ $mission->transportRequest->destination_city }}</p>
                            </div>
                        </div>
                        @if($mission->planned_at)
                            <div>
                                <p class="text-xs text-gray-500">Date prévue</p>
                                <p class="text-sm font-medium text-gray-900">{{ $mission->planned_at->format('d/m/Y à H:i') }}</p>
                            </div>
                        @endif
                        @if($mission->delivered_at)
                            <div>
                                <p class="text-xs text-gray-500">Date de livraison</p>
                                <p class="text-sm font-medium text-emerald-700">{{ $mission->delivered_at->format('d/m/Y à H:i') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Transporteur -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-semibold text-gray-900 mb-4">Votre transporteur</h2>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($mission->transporteur->name, 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $mission->transporteur->name }}</p>
                            <p class="text-sm text-gray-500">Transporteur</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div>
                            <p class="text-xs text-gray-500">Véhicule utilisé</p>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $mission->vehicle->brand }} {{ $mission->vehicle->model }}
                                ({{ $mission->vehicle->registration_number }})
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Montant de l'offre</p>
                            <p class="text-sm font-bold text-gray-900">{{ number_format($mission->offer->amount, 2) }} MAD</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
