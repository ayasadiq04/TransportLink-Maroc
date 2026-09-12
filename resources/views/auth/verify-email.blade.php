<x-guest-layout>

    {{-- Header --}}
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Vérifiez votre e-mail ✉️</h2>
        <p class="text-sm text-gray-500 mt-1">Merci pour votre inscription ! Avant de commencer, veuillez cliquer sur le lien de confirmation que nous venons de vous envoyer par e-mail.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm px-4 py-3">
            Un nouveau lien de vérification a été envoyé à l'adresse e-mail fournie lors de votre inscription.
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-bold shadow-[0_4px_16px_rgba(59,130,246,0.35)] transition-all duration-150 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(59,130,246,0.45)] active:translate-y-0">
                Renvoyer l'e-mail de confirmation
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-xs text-gray-400 hover:text-gray-900 underline transition-colors duration-150">
                Se déconnecter
            </button>
        </form>
    </div>

</x-guest-layout>