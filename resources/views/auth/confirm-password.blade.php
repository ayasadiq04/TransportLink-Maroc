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
</style>

<div class="auth-header">
    <h2>Confirmation de sécurité 🔐</h2>
    <p>Il s'agit d'une zone sécurisée. Veuillez confirmer votre mot de passe pour continuer.</p>
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div class="field-group">
        <label for="password">Mot de passe actuel</label>
        <div class="field-icon-wrap">
            <span class="field-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </span>
            <input id="password" class="field-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
        </div>
        @error('password')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn-submit">
        Confirmer &rarr;
    </button>
</form>
</x-guest-layout>
