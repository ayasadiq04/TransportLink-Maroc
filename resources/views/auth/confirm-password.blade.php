<x-guest-layout>

    {{-- Header --}}
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Confirmation de sécurité 🔐</h2>
        <p class="text-sm text-gray-500 mt-1">Il s'agit d'une zone sécurisée. Veuillez confirmer votre mot de passe pour continuer.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        {{-- Password --}}
        <div class="mb-1">
            <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5">Mot de passe actuel</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input id="password"
                       class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                       type="password" name="password"
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

        <button type="submit"
                class="w-full mt-6 flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-bold shadow-[0_4px_16px_rgba(59,130,246,0.35)] transition-all duration-150 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(59,130,246,0.45)] active:translate-y-0">
            Confirmer &rarr;
        </button>
    </form>

</x-guest-layout>