<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une demande</title>

    
</head>

<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto py-10 px-4">

        <h1 class="text-3xl font-bold mb-6">
            Créer une demande de transport
        </h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transport-requests.store') }}" method="POST"
              class="bg-white p-6 rounded-lg shadow">

            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Titre
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="w-full border rounded p-2"
                    placeholder="Ex: Transport de marchandises"
                >
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-2 font-semibold">
                        Ville de départ
                    </label>

                    <input
                        type="text"
                        name="departure_city"
                        value="{{ old('departure_city') }}"
                        class="w-full border rounded p-2"
                    >
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Adresse de départ
                    </label>

                    <input
                        type="text"
                        name="departure_address"
                        value="{{ old('departure_address') }}"
                        class="w-full border rounded p-2"
                    >
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Ville de destination
                    </label>

                    <input
                        type="text"
                        name="destination_city"
                        value="{{ old('destination_city') }}"
                        class="w-full border rounded p-2"
                    >
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Adresse de destination
                    </label>

                    <input
                        type="text"
                        name="destination_address"
                        value="{{ old('destination_address') }}"
                        class="w-full border rounded p-2"
                    >
                </div>

            </div>

            <div class="mt-4 mb-4">
                <label class="block mb-2 font-semibold">
                    Date et heure de récupération
                </label>

                <input
                    type="datetime-local"
                    name="pickup_at"
                    value="{{ old('pickup_at') }}"
                    class="w-full border rounded p-2"
                >
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Type de marchandise
                </label>

                <select name="goods_type" class="w-full border rounded p-2">

                    <option value="">Choisir</option>

                    <option value="palette">Palette</option>
                    <option value="vrac">Vrac</option>
                    <option value="frigorifique">Frigorifique</option>
                    <option value="liquide">Liquide</option>
                    <option value="colis_volumineux">Colis volumineux</option>
                    <option value="autre">Autre</option>

                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-2 font-semibold">
                        Poids (kg)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="weight"
                        value="{{ old('weight') }}"
                        class="w-full border rounded p-2"
                    >
                </div>

                <div>
                    <label class="block mb-2 font-semibold">
                        Volume (m³)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="volume"
                        value="{{ old('volume') }}"
                        class="w-full border rounded p-2"
                    >
                </div>

            </div>

            <div class="mt-4 mb-4">
                <label class="block mb-2 font-semibold">
                    Budget estimé (MAD)
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="estimated_budget"
                    value="{{ old('estimated_budget') }}"
                    class="w-full border rounded p-2"
                >
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold">
                    Instructions
                </label>

                <textarea
                    name="instructions"
                    rows="4"
                    class="w-full border rounded p-2"
                >{{ old('instructions') }}</textarea>
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700"
            >
                Créer la demande
            </button>

        </form>

    </div>

</body>
</html>