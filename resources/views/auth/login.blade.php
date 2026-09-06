<x-guest-layout>

<style>
    /* ── Auth form skin ── */
    .login-header { margin-bottom: 2rem; }
    .login-header h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.03em;
        margin-bottom: 0.4rem;
    }
    .login-header p { font-size: 0.875rem; color: #64748b; }

    /* Divider with text */
    .or-divider {
        display: flex; align-items: center; gap: 0.75rem;
        margin: 1.25rem 0;
        color: #94a3b8; font-size: 0.75rem;
    }
    .or-divider::before, .or-divider::after {
        content: ''; flex: 1;
        height: 1px; background: #e2e8f0;
    }

    /* Floating label group */
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

    /* Toggle password button */
    .pwd-toggle {
        position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
        background: none; border: none; cursor: pointer;
        color: #9ca3af; display: flex; align-items: center;
        transition: color 0.15s;
    }
    .pwd-toggle:hover { color: #3b82f6; }
    .pwd-toggle svg { width: 18px; height: 18px; }

    /* Remember + forgot row */
    .row-meta {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.5rem;
    }
    .remember-label {
        display: flex; align-items: center; gap: 0.5rem;
        font-size: 0.8rem; color: #475569; cursor: pointer; user-select: none;
    }
    .remember-label input[type="checkbox"] {
        width: 16px; height: 16px;
        accent-color: #3b82f6;
        border-radius: 4px; cursor: pointer;
    }
    .forgot-link {
        font-size: 0.8rem; font-weight: 600;
        color: #3b82f6; text-decoration: none;
        transition: color 0.15s;
    }
    .forgot-link:hover { color: #1d4ed8; text-decoration: underline; }

    /* Primary CTA */
    .btn-login {
        width: 100%;
        padding: 0.85rem;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        letter-spacing: 0.01em;
        transition: transform 0.15s, box-shadow 0.15s, opacity 0.15s;
        box-shadow: 0 4px 16px rgba(59,130,246,0.35);
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        font-family: inherit;
    }
    .btn-login:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(59,130,246,0.45);
    }
    .btn-login:active { transform: translateY(0); }
    .btn-login svg { width: 18px; height: 18px; }

    /* Register link */
    .register-prompt {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.85rem;
        color: #64748b;
    }
    .register-prompt a {
        font-weight: 700; color: #3b82f6;
        text-decoration: none;
        transition: color 0.15s;
    }
    .register-prompt a:hover { color: #1d4ed8; text-decoration: underline; }

    /* Session status */
    .session-status {
        background: #f0fdf4; border: 1px solid #86efac;
        color: #166534; border-radius: 10px;
        padding: 0.65rem 1rem;
        font-size: 0.82rem;
        margin-bottom: 1.25rem;
    }

    /* Validation error */
    .field-error { color: #ef4444; font-size: 0.78rem; margin-top: 0.35rem; }

    /* Divider back link */
    .back-home {
        display: flex; align-items: center; justify-content: center; gap: 0.4rem;
        margin-top: 2rem;
        font-size: 0.78rem; color: #94a3b8;
        text-decoration: none;
        transition: color 0.15s;
    }
    .back-home:hover { color: #3b82f6; }
    .back-home svg { width: 14px; height: 14px; }
</style>

{{-- Header --}}
<div class="login-header">
    <h2>Bon retour 👋</h2>
    <p>Connectez-vous à votre espace TransportLink</p>
</div>

{{-- Session Status --}}
@if (session('status'))
    <div class="session-status">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    {{-- Email --}}
    <div class="field-group">
        <label for="email">Adresse e-mail</label>
        <div class="field-icon-wrap">
            <span class="field-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </span>
            <input id="email"
                   class="field-input"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   placeholder="vous@exemple.ma">
        </div>
        @error('email')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div class="field-group">
        <label for="password">Mot de passe</label>
        <div class="field-icon-wrap" style="position:relative;">
            <span class="field-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </span>
            <input id="password"
                   class="field-input"
                   type="password"
                   name="password"
                   required autocomplete="current-password"
                   placeholder="••••••••">
            <button type="button" class="pwd-toggle" onclick="togglePassword()" id="pwd-toggle-btn" title="Afficher/Masquer">
                <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </button>
        </div>
        @error('password')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Remember + Forgot --}}
    <div class="row-meta">
        <label class="remember-label">
            <input type="checkbox" name="remember" id="remember_me">
            Se souvenir de moi
        </label>
        @if (Route::has('password.request'))
            <a class="forgot-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
        @endif
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn-login">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
            <polyline points="10 17 15 12 10 7"/>
            <line x1="15" y1="12" x2="3" y2="12"/>
        </svg>
        Se connecter
    </button>
</form>

{{-- Register --}}
<div class="register-prompt">
    Pas encore de compte ?
    <a href="{{ route('register') }}">Créer un compte</a>
</div>

{{-- Back to home --}}
<a href="{{ url('/') }}" class="back-home">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M19 12H5M12 19l-7-7 7-7"/>
    </svg>
    Retour à l'accueil
</a>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    eyeIcon.innerHTML = isHidden
        ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
}
</script>

</x-guest-layout>
