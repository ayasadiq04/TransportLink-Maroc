<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes véhicules
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('vehicles.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    + Ajouter un véhicule
                </a>
            </div>

            @if($vehicles->count())

                <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left">Type</th>
                                <th class="px-6 py-3 text-left">Marque</th>
                                <th class="px-6 py-3 text-left">Modèle</th>
                                <th class="px-6 py-3 text-left">Immatriculation</th>
                                <th class="px-6 py-3 text-left">Capacité</th>
                                <th class="px-6 py-3 text-left">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($vehicles as $vehicle)

                                <tr class="border-t">

                                    <td class="px-6 py-4">
                                        {{ $vehicle->type }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $vehicle->brand ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $vehicle->model ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $vehicle->registration_number }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $vehicle->capacity }} tonnes
                                    </td>

                                    <td class="px-6 py-4">

                                        <a href="{{ route('vehicles.edit', $vehicle) }}"
                                           class="text-blue-600 hover:text-blue-800 mr-3">
                                            Modifier
                                        </a>

                                        <form action="{{ route('vehicles.destroy', $vehicle) }}"
                                              method="POST"
                                              class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer ce véhicule ?')"
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
                        Vous n'avez aucun véhicule pour le moment.
                    </p>
                </div>

            @endif

        </div>
    </div>

</x-app-layout>