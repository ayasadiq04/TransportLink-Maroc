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

    .field-group { position: relative; margin-bottom: 1.25rem; }
    .field-group label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.4rem;
    }
    .field-icon-wrap { position: relative; }
    .field-icon {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        color: #9ca3af; pointer-events: none;
    }
    .field-icon svg { width: 18px; height: 18px; }
    .field-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.9rem;
        color: #0f172a;
        background: #f8fafc;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        outline: none;
        font-family: inherit;
    }
    .field-input::placeholder { color: #cbd5e1; }
    .field-input:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(59,130,246,0.12);
    }
    .field-error { color: #ef4444; font-size: 0.78rem; margin-top: 0.35rem; }

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
        margin-top: 1.25rem;
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

    .back-nav {
        display: flex; align-items: center; justify-content: center; gap: 0.4rem;
        margin-top: 1.75rem;
        font-size: 0.82rem; color: #64748b; text-decoration: none;
        transition: color 0.15s;
    }
    .back-nav:hover { color: #3b82f6; }
    .back-nav svg { width: 15px; height: 15px; }
</style>

<div class="auth-header">
    <h2>Mot de passe oublié ? 🔑</h2>
    <p>Indiquez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe en toute sécurité.</p>
</div>

<!-- Session Status -->
@if (session('status'))
    <div class="status-alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div class="field-group">
        <label for="email">Adresse e-mail associée au compte</label>
        <div class="field-icon-wrap">
            <span class="field-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </span>
            <input id="email" class="field-input" type="email" name="email" :value="old('email')" required autofocus placeholder="vous@exemple.ma" />
        </div>
        @error('email')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn-submit">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="22" y1="2" x2="11" y2="13"></line>
            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
        </svg>
        Envoyer le lien de réinitialisation
    </button>
</form>

<a href="{{ route('login') }}" class="back-nav">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M19 12H5M12 19l-7-7 7-7"/>
    </svg>
    Retour à la page de connexion
</a>
</x-guest-layout>
