<x-guest-layout>

    {{-- Header --}}
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Créer un compte</h2>
        <p class="text-sm text-gray-500 mt-1">Rejoignez le réseau logistique TransportLink Maroc</p>
    </div>

    <form method="POST" action="{{ route('register') }}" x-data="{ role: '{{ old('role', 'client') }}' }">
        @csrf

        {{-- Role selector --}}
        <div class="mb-5">
            <p class="text-xs font-semibold text-gray-700 mb-2">Vous êtes :</p>
            <div class="grid grid-cols-2 gap-3">
                <button type="button"
                        @click="role = 'client'"
                        class="flex flex-col items-center gap-1 p-3 rounded-xl border-[1.5px] cursor-pointer transition-all duration-200 text-center select-none"
                        :class="role === 'client' ? 'border-blue-500 bg-blue-50 ring-4 ring-blue-500/10' : 'border-gray-200 bg-gray-50 hover:border-blue-300 hover:bg-blue-50/50'">
                    <span class="text-2xl leading-none">📦</span>
                    <span class="text-xs font-bold" :class="role === 'client' ? 'text-blue-700' : 'text-gray-700'">Expéditeur</span>
                    <span class="text-[0.68rem] text-gray-400">J'envoie des colis</span>
                </button>
                <button type="button"
                        @click="role = 'transporteur'"
                        class="flex flex-col items-center gap-1 p-3 rounded-xl border-[1.5px] cursor-pointer transition-all duration-200 text-center select-none"
                        :class="role === 'transporteur' ? 'border-blue-500 bg-blue-50 ring-4 ring-blue-500/10' : 'border-gray-200 bg-gray-50 hover:border-blue-300 hover:bg-blue-50/50'">
                    <span class="text-2xl leading-none">🚚</span>
                    <span class="text-xs font-bold" :class="role === 'transporteur' ? 'text-blue-700' : 'text-gray-700'">Transporteur</span>
                    <span class="text-[0.68rem] text-gray-400">Je livre des marchandises</span>
                </button>
            </div>
            <input type="hidden" name="role" :value="role">
            @error('role')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Full Name --}}
        <div class="mb-4">
            <label for="name" class="block text-xs font-semibold text-gray-700 mb-1.5">Nom complet / Raison sociale</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </span>
                <input id="name"
                       class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                       type="text" name="name"
                       value="{{ old('name') }}" required autofocus
                       placeholder="Ex: Mohamed Alami">
            </div>
            @error('name')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

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
                       type="email" name="email"
                       value="{{ old('email') }}" required
                       placeholder="vous@exemple.ma">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone + City --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
            <div>
                <label for="phone" class="block text-xs font-semibold text-gray-700 mb-1.5">Téléphone</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.15 12 19.79 19.79 0 0 1 1.08 3.4a2 2 0 0 1 1.99-2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </span>
                    <input id="phone"
                           class="block w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                           type="text" name="phone"
                           value="{{ old('phone') }}" placeholder="0661000000">
                </div>
                @error('phone')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="city" class="block text-xs font-semibold text-gray-700 mb-1.5">Ville</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </span>
                    <input id="city"
                           class="block w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                           type="text" name="city"
                           value="{{ old('city') }}" placeholder="Casablanca">
                </div>
                @error('city')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5">Mot de passe</label>
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
                       required placeholder="Minimum 8 caractères">
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-6">
            <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1.5">Confirmer le mot de passe</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                    </svg>
                </span>
                <input id="password_confirmation"
                       class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 outline-none transition-all duration-200 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10"
                       type="password" name="password_confirmation"
                       required placeholder="Répétez votre mot de passe">
            </div>
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-bold shadow-[0_4px_16px_rgba(59,130,246,0.35)] transition-all duration-150 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(59,130,246,0.45)] active:translate-y-0">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="8.5" cy="7" r="4"/>
                <line x1="20" y1="8" x2="20" y2="14"/>
                <line x1="23" y1="11" x2="17" y2="11"/>
            </svg>
            Créer mon compte
        </button>
    </form>

    {{-- Login link --}}
    <p class="text-center mt-6 text-sm text-gray-500">
        Déjà un compte ?
        <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-150">Se connecter</a>
    </p>

</x-guest-layout>