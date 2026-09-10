<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-sm text-gray-500">Détails et activité du compte utilisateur</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if($user->id !== auth()->id())
                    <button type="button"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-delete')"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition">
                        Supprimer l'utilisateur
                    </button>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Fiche profil -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white font-bold text-xl flex items-center justify-center shadow-md">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            <div class="mt-2 flex items-center gap-2">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">Administrateur</span>
                                @elseif($user->role === 'transporteur')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">Transporteur</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Client</span>
                                @endif
                                <span class="text-xs text-gray-400">Inscrit le {{ $user->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm bg-gray-50 p-4 rounded-xl">
                        <div>
                            <span class="text-xs text-gray-400 block">Téléphone</span>
                            <span class="font-semibold text-gray-900">{{ $user->phone ?? 'Non renseigné' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block">Ville</span>
                            <span class="font-semibold text-gray-900">{{ $user->city ?? 'Non renseignée' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block">Adresse</span>
                            <span class="font-semibold text-gray-900">{{ $user->address ?? 'Non renseignée' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Sections selon le rôle -->
                @if($user->role === 'client')
                    <div class="mt-6">
                        <h3 class="font-bold text-gray-900 mb-4">Demandes de transport publiées ({{ $user->transportRequests->count() }})</h3>
                        @if($user->transportRequests->isEmpty())
                            <p class="text-sm text-gray-500 italic">Aucune demande enregistrée.</p>
                        @else
                            <div class="divide-y divide-gray-100 border border-gray-100 rounded-xl overflow-hidden">
                                @foreach($user->transportRequests as $req)
                                    <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition text-sm">
                                        <div>
                                            <a href="{{ route('admin.transport-requests.show', $req) }}" class="font-semibold text-gray-900 hover:text-blue-600">
                                                {{ $req->title }}
                                            </a>
                                            <p class="text-xs text-gray-500">{{ $req->departure_city }} &rarr; {{ $req->destination_city }} • Prise en charge : {{ $req->pickup_at ? \Carbon\Carbon::parse($req->pickup_at)->format('d/m/Y') : '—' }}</p>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <x-status-badge :status="$req->status" type="request" />
                                            <a href="{{ route('admin.transport-requests.show', $req) }}" class="text-xs font-semibold text-blue-600 hover:underline">
                                                Voir
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                @if($user->role === 'transporteur')
                    <div class="mt-6 space-y-6">
                        <!-- Flotte -->
                        <div>
                            <h3 class="font-bold text-gray-900 mb-3">Véhicules ({{ $user->vehicles->count() }})</h3>
                            @if($user->vehicles->isEmpty())
                                <p class="text-sm text-gray-500 italic">Aucun véhicule enregistré.</p>
                            @else
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($user->vehicles as $vehicle)
                                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-xs">
                                            <p class="font-bold text-gray-900 text-sm">{{ $vehicle->brand }} {{ $vehicle->model }}</p>
                                            <p class="text-gray-500 mt-0.5">Immat : {{ $vehicle->registration_number }}</p>
                                            <p class="text-gray-500">Capacité : {{ $vehicle->capacity }} t</p>
                                            <span class="inline-block mt-2 font-semibold {{ $vehicle->available ? 'text-emerald-600' : 'text-amber-600' }}">
                                                {{ $vehicle->available ? '● Disponible' : '● Indisponible' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Offres faites -->
                        <div>
                            <h3 class="font-bold text-gray-900 mb-3">Offres soumises ({{ $user->offers->count() }})</h3>
                            @if($user->offers->isEmpty())
                                <p class="text-sm text-gray-500 italic">Aucune offre soumise.</p>
                            @else
                                <div class="divide-y divide-gray-100 border border-gray-100 rounded-xl overflow-hidden text-sm">
                                    @foreach($user->offers as $off)
                                        <div class="p-3.5 flex items-center justify-between hover:bg-gray-50 transition">
                                            <div>
                                                <span class="font-semibold text-gray-900">{{ number_format($off->amount, 2) }} DH</span>
                                                <span class="text-xs text-gray-500 ml-2">sur "{{ $off->transportRequest->title ?? 'Demande #'.$off->transport_request_id }}"</span>
                                            </div>
                                            <x-status-badge :status="$off->status" type="offer" />
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>

    @if($user->id !== auth()->id())
        <x-confirm-modal
            name="confirm-user-delete"
            title="Supprimer cet utilisateur"
            message="Confirmer la suppression de cet utilisateur ? Cette action est définitive et supprimera toutes ses données associées."
            :action="route('admin.users.destroy', $user)"
        />
    @endif
</x-app-layout>
