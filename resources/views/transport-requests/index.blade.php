<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes demandes de transport
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('transport-requests.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    + Nouvelle demande
                </a>
            </div>

            @if($requests->count())

                <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                    <table class="w-full">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left">Titre</th>
                                <th class="px-6 py-3 text-left">Départ</th>
                                <th class="px-6 py-3 text-left">Destination</th>
                                <th class="px-6 py-3 text-left">Date</th>
                                <th class="px-6 py-3 text-left">Statut</th>
                                <th class="px-6 py-3 text-left">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($requests as $request)

                                <tr class="border-t">

                                    <td class="px-6 py-4">
                                        {{ $request->title }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $request->departure_city }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $request->destination_city }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $request->pickup_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $request->status }}
                                    </td>

                                    <td class="px-6 py-4">

                                        <a href="{{ route('transport-requests.edit', $request) }}"
                                           class="text-blue-600 hover:text-blue-800 mr-3">
                                            Modifier
                                        </a>

                                        <form action="{{ route('transport-requests.destroy', $request) }}"
                                              method="POST"
                                              class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer cette demande ?')"
                                                    class="text-red-600 hover:text-red-800">
                                                Supprimer
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <p class="text-gray-600">
                        Vous n'avez aucune demande pour le moment.
                    </p>
                </div>

            @endif

        </div>
    </div>

</x-app-layout>
