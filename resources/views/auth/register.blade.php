<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Créer un compte TransportLink</h2>
        <p class="text-sm text-gray-500 mt-1">Choisissez votre profil et rejoignez notre réseau au Maroc</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Rôle (Client vs Transporteur) -->
        <div>
            <x-input-label for="role" value="Vous êtes :" />
            <div class="grid grid-cols-2 gap-3 mt-2">
                <label class="flex items-center justify-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition border-gray-200 [&:has(input:checked)]:border-indigo-600 [&:has(input:checked)]:bg-indigo-50/50">
                    <input type="radio" name="role" value="client" class="sr-only" checked>
                    <span class="text-sm font-semibold text-gray-800">📦 Expéditeur / Client</span>
                </label>
                <label class="flex items-center justify-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition border-gray-200 [&:has(input:checked)]:border-indigo-600 [&:has(input:checked)]:bg-indigo-50/50">
                    <input type="radio" name="role" value="transporteur" class="sr-only">
                    <span class="text-sm font-semibold text-gray-800">🚚 Transporteur</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nom complet / Raison sociale" />
            <x-text-input id="name" class="block mt-1 w-full text-sm rounded-lg" type="text" name="name" :value="old('name')" required autofocus placeholder="Ex: Mohamed Alami" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adresse Email" />
            <x-text-input id="email" class="block mt-1 w-full text-sm rounded-lg" type="email" name="email" :value="old('email')" required placeholder="exemple@transportlink.ma" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone & City -->
        <div class="grid grid-cols-2 gap-3">
            <div>
                <x-input-label for="phone" value="Téléphone" />
                <x-text-input id="phone" class="block mt-1 w-full text-sm rounded-lg" type="text" name="phone" :value="old('phone')" placeholder="0661000000" />
            </div>
            <div>
                <x-input-label for="city" value="Ville" />
                <x-text-input id="city" class="block mt-1 w-full text-sm rounded-lg" type="text" name="city" :value="old('city')" placeholder="Casablanca" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="block mt-1 w-full text-sm rounded-lg" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-sm rounded-lg" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 text-sm font-bold rounded-xl shadow-md">
                S'inscrire gratuitement &rarr;
            </x-primary-button>
        </div>

        <div class="text-center pt-2">
            <a class="underline text-xs text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                Déjà un compte ? Connectez-vous
            </a>
        </div>
    </form>
</x-guest-layout>
