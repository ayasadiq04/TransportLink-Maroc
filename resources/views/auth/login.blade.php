<x-guest-layout>

    {{-- Header --}}
    <div class="mb-7 text-center">
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Connexion</h2>
        <p class="text-sm text-gray-500 mt-1">Connectez-vous à votre espace TransportLink</p>
    </div>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5">Adresse e-mail</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </span>
                <input id="email"
                       class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required autofocus autocomplete="username"
                       placeholder="vous@exemple.ma">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-5">
            <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5">Mot de passe</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input id="password"
                       class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                       type="password"
                       name="password"
                       required autocomplete="current-password"
                       placeholder="••••••••">
                <button type="button"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-500 transition-colors duration-150"
                        data-password-toggle
                        title="Afficher/Masquer">
                    <svg id="eye-icon" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember + Forgot --}}
        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer select-none">
                <input type="checkbox" name="remember" id="remember_me"
                       class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                Se souvenir de moi
            </label>
            @if (Route::has('password.request'))
                <a class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-150"
                   href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-bold shadow-[0_4px_16px_rgba(59,130,246,0.35)] transition-all duration-150 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(59,130,246,0.45)] active:translate-y-0">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                <polyline points="10 17 15 12 10 7"/>
                <line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
            Se connecter
        </button>
    </form>

    {{-- Register --}}
    <p class="text-center mt-6 text-sm text-gray-500">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-150">Créer un compte</a>
    </p>

</x-guest-layout>