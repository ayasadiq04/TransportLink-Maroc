<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des Utilisateurs</h1>
                <p class="text-sm text-gray-500 mt-1">Liste et administration de tous les comptes enregistrés</p>
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
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Utilisateur</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Rôle</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Téléphone</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ville</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Activité</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Inscrit le</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.users.show', $user) }}" class="font-semibold text-gray-900 hover:text-blue-600 transition">
                                            {{ $user->name }}
                                        </a>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->role === 'admin')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">Admin</span>
                                        @elseif($user->role === 'transporteur')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">Transporteur</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Client</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600 whitespace-nowrap">
                                        {{ $user->phone ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600 whitespace-nowrap">
                                        {{ $user->city ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-600 whitespace-nowrap">
                                        @if($user->role === 'client')
                                            {{ $user->transport_requests_count ?? $user->transportRequests()->count() }} demande(s)
                                        @elseif($user->role === 'transporteur')
                                            {{ $user->vehicles_count ?? $user->vehicles()->count() }} véh. • {{ $user->offers_count ?? $user->offers()->count() }} offre(s)
                                        @else
                                            Système
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-xs whitespace-nowrap space-x-2">
                                        @if($user->id !== auth()->id())
                                            <button type="button"
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-delete-{{ $user->id }}')"
                                                    class="text-rose-600 hover:text-rose-900 font-semibold">
                                                Supprimer
                                            </button>

                                            <x-confirm-modal
                                                :name="'confirm-user-delete-'.$user->id"
                                                title="Supprimer cet utilisateur"
                                                message="Confirmer la suppression de cet utilisateur ? Cette action est définitive et supprimera toutes ses données associées."
                                                :action="route('admin.users.destroy', $user)"
                                            />
                                        @else
                                            <span class="text-gray-400 italic">Vous</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($users, 'links'))
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
