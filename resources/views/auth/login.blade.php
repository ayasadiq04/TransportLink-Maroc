<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Se connecter à TransportLink</h2>
        <p class="text-sm text-gray-500 mt-1">Accédez à votre espace d'expéditeur ou de transporteur</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adresse Email" />
            <x-text-input id="email" class="block mt-1 w-full text-sm rounded-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="exemple@transportlink.ma" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="block mt-1 w-full text-sm rounded-lg" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-gray-600">Se souvenir de moi</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-indigo-600 hover:text-indigo-800" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 text-sm font-bold rounded-xl shadow-md">
                Connexion &rarr;
            </x-primary-button>
        </div>

        <div class="text-center pt-2">
            <a class="underline text-xs text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                Pas encore de compte ? Inscrivez-vous
            </a>
        </div>
    </form>
</x-guest-layout>
