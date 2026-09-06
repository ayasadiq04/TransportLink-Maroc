<x-guest-layout>
<style>
    .auth-header { margin-bottom: 1.5rem; }
    .auth-header h2 {
        font-size: 1.6rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.03em;
        margin-bottom: 0.4rem;
    }
    .auth-header p { font-size: 0.875rem; color: #64748b; line-height: 1.5; }

    .btn-submit {
        width: 100%;
        padding: 0.85rem;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 0.92rem;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.15s;
        box-shadow: 0 4px 16px rgba(59,130,246,0.35);
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        font-family: inherit;
    }
    .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 8px 24px rgba(59,130,246,0.45); }
    .btn-submit:active { transform: translateY(0); }

    .status-alert {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        padding: 0.85rem 1rem;
        border-radius: 12px;
        font-size: 0.85rem;
        margin-bottom: 1.25rem;
    }
</style>

<div class="auth-header">
    <h2>Vérifiez votre e-mail ✉️</h2>
    <p>Merci pour votre inscription ! Avant de commencer, veuillez cliquer sur le lien de confirmation que nous venons de vous envoyer par e-mail.</p>
</div>

@if (session('status') == 'verification-link-sent')
    <div class="status-alert">
        Un nouveau lien de vérification a été envoyé à l'adresse e-mail fournie lors de votre inscription.
    </div>
@endif

<div class="space-y-4">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn-submit">
            Renvoyer l'e-mail de confirmation
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="text-center">
        @csrf
        <button type="submit" class="text-sm text-slate-500 hover:text-slate-800 underline">
            Se déconnecter
        </button>
    </form>
</div>
</x-guest-layout>
