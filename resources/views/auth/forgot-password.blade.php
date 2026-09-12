<x-guest-layout>

    {{-- Header --}}
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Mot de passe oublié ? 🔑</h2>
        <p class="text-sm text-gray-500 mt-1">Indiquez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe en toute sécurité.</p>
    </div>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- Email Address --}}
        <div class="mb-1">
            <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5">Adresse e-mail associée au compte</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </span>
                <input id="email"
                       class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                       type="email" name="email"
                       value="{{ old('email') }}" required autofocus
                       placeholder="vous@exemple.ma">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full mt-6 flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-bold shadow-[0_4px_16px_rgba(59,130,246,0.35)] transition-all duration-150 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(59,130,246,0.45)] active:translate-y-0">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="22" y1="2" x2="11" y2="13"></line>
                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
            Envoyer le lien de réinitialisation
        </button>
    </form>

    <a href="{{ route('login') }}" class="flex items-center justify-center gap-1.5 mt-6 text-xs font-medium text-gray-400 hover:text-indigo-600 transition-colors duration-200">
        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Retour à la page de connexion
    </a>

</x-guest-layout>