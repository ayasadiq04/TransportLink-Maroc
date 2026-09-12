<x-guest-layout>

    {{-- Header --}}
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Nouveau mot de passe 🔒</h2>
        <p class="text-sm text-gray-500 mt-1">Choisissez un nouveau mot de passe fort pour sécuriser votre compte TransportLink.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        {{-- Password Reset Token --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email Address --}}
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
                       type="email" name="email"
                       value="{{ old('email', $request->email) }}" required autofocus
                       autocomplete="username">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5">Nouveau mot de passe</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input id="password"
                       class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                       type="password" name="password"
                       required autocomplete="new-password"
                       placeholder="Minimum 8 caractères">
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-1">
            <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1.5">Confirmer le nouveau mot de passe</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                    </svg>
                </span>
                <input id="password_confirmation"
                       class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                       type="password" name="password_confirmation"
                       required autocomplete="new-password"
                       placeholder="Répétez votre mot de passe">
            </div>
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full mt-6 flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-bold shadow-[0_4px_16px_rgba(59,130,246,0.35)] transition-all duration-150 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(59,130,246,0.45)] active:translate-y-0">
            Réinitialiser le mot de passe &rarr;
        </button>
    </form>

</x-guest-layout>