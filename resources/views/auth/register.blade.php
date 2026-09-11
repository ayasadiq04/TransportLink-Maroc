<x-guest-layout>

<style>
    /* Inherits .field-group, .field-input, .btn-login, .register-prompt, .back-home from guest layout */
    /* Extended styles for register-specific elements */

    .login-header { margin-bottom: 1.75rem; }
    .login-header h2 {
        font-size: 1.6rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.03em;
        margin-bottom: 0.35rem;
    }
    .login-header p { font-size: 0.85rem; color: #64748b; }

    .field-group { position: relative; margin-bottom: 1rem; }
    .field-group label {
        display: block;
        font-size: 0.78rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.35rem;
    }
    .field-icon-wrap { position: relative; }
    .field-icon {
        position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
        color: #9ca3af; pointer-events: none;
    }
    .field-icon svg { width: 17px; height: 17px; }
    .field-input {
        width: 100%;
        padding: 0.7rem 0.9rem 0.7rem 2.6rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 11px;
        font-size: 0.875rem;
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
    .field-error { color: #ef4444; font-size: 0.75rem; margin-top: 0.3rem; }

    /* Role selector cards */
    .role-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem; margin-bottom: 1rem; }
    .role-card {
        display: flex; flex-direction: column; align-items: center; gap: 0.35rem;
        padding: 0.85rem 0.5rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        cursor: pointer;
        background: #f8fafc;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        text-align: center;
        user-select: none;
    }
    .role-card:hover { border-color: #93c5fd; background: #eff6ff; }
    .role-card input[type="radio"] { display: none; }
    .role-card .role-emoji { font-size: 1.6rem; line-height: 1; }
    .role-card .role-name { font-size: 0.78rem; font-weight: 700; color: #374151; }
    .role-card .role-desc { font-size: 0.68rem; color: #94a3b8; }
    /* Checked state via JS */
    .role-card.selected {
        border-color: #3b82f6;
        background: #eff6ff;
        box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
    }
    .role-card.selected .role-name { color: #1d4ed8; }

    /* Two-column grid for phone/city */
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }

    /* Password with no padding-right (no toggle on register pwd fields) */
    .field-input.no-icon { padding-left: 0.9rem; }

    /* Submit */
    .btn-login {
        width: 100%;
        padding: 0.82rem;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 700;
        cursor: pointer;
        letter-spacing: 0.01em;
        transition: transform 0.15s, box-shadow 0.15s;
        box-shadow: 0 4px 16px rgba(59,130,246,0.35);
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        font-family: inherit;
        margin-top: 1.25rem;
    }
    .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 24px rgba(59,130,246,0.45); }
    .btn-login:active { transform: translateY(0); }
    .btn-login svg { width: 17px; height: 17px; }

    .login-link {
        text-align: center; margin-top: 1.25rem;
        font-size: 0.82rem; color: #64748b;
    }
    .login-link a {
        font-weight: 700; color: #3b82f6; text-decoration: none; transition: color 0.15s;
    }
    .login-link a:hover { color: #1d4ed8; text-decoration: underline; }

    .back-home {
        display: flex; align-items: center; justify-content: center; gap: 0.4rem;
        margin-top: 1.5rem;
        font-size: 0.75rem; color: #94a3b8; text-decoration: none; transition: color 0.15s;
    }
    .back-home:hover { color: #3b82f6; }
    .back-home svg { width: 13px; height: 13px; }

    /* Role section label */
    .section-label { font-size: 0.78rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem; }
</style>

{{-- Header --}}
<div class="login-header">
    <h2>Créer un compte 🚀</h2>
    <p>Rejoignez le réseau logistique TransportLink Maroc</p>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    {{-- Role selector --}}
    <div style="margin-bottom:1rem;">
        <p class="section-label">Vous êtes :</p>
        <div class="role-cards">
            <label class="role-card selected" id="card-client" data-role-select="client">
                <input type="radio" name="role" value="client" id="role-client" checked>
                <span class="role-emoji">📦</span>
                <span class="role-name">Expéditeur</span>
                <span class="role-desc">J'envoie des colis</span>
            </label>
            <label class="role-card" id="card-transporteur" data-role-select="transporteur">
                <input type="radio" name="role" value="transporteur" id="role-transporteur">
                <span class="role-emoji">🚚</span>
                <span class="role-name">Transporteur</span>
                <span class="role-desc">Je livre des marchandises</span>
            </label>
        </div>
        @error('role')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Full Name --}}
    <div class="field-group">
        <label for="name">Nom complet / Raison sociale</label>
        <div class="field-icon-wrap">
            <span class="field-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </span>
            <input id="name" class="field-input" type="text" name="name"
                   value="{{ old('name') }}" required autofocus
                   placeholder="Ex: Mohamed Alami">
        </div>
        @error('name')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

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
            <input id="email" class="field-input" type="email" name="email"
                   value="{{ old('email') }}" required
                   placeholder="vous@exemple.ma">
        </div>
        @error('email')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Phone + City --}}
    <div class="two-col">
        <div class="field-group" style="margin-bottom:0;">
            <label for="phone">Téléphone</label>
            <div class="field-icon-wrap">
                <span class="field-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.15 12 19.79 19.79 0 0 1 1.08 3.4a2 2 0 0 1 1.99-2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </span>
                <input id="phone" class="field-input" type="text" name="phone"
                       value="{{ old('phone') }}" placeholder="0661000000">
            </div>
            @error('phone')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field-group" style="margin-bottom:0;">
            <label for="city">Ville</label>
            <div class="field-icon-wrap">
                <span class="field-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </span>
                <input id="city" class="field-input" type="text" name="city"
                       value="{{ old('city') }}" placeholder="Casablanca">
            </div>
            @error('city')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Password --}}
    <div class="field-group" style="margin-top:1rem;">
        <label for="password">Mot de passe</label>
        <div class="field-icon-wrap">
            <span class="field-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </span>
            <input id="password" class="field-input" type="password" name="password"
                   required placeholder="Minimum 8 caractères">
        </div>
        @error('password')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="field-group">
        <label for="password_confirmation">Confirmer le mot de passe</label>
        <div class="field-icon-wrap">
            <span class="field-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                </svg>
            </span>
            <input id="password_confirmation" class="field-input" type="password"
                   name="password_confirmation" required placeholder="Répétez votre mot de passe">
        </div>
        @error('password_confirmation')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn-login">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="8.5" cy="7" r="4"/>
            <line x1="20" y1="8" x2="20" y2="14"/>
            <line x1="23" y1="11" x2="17" y2="11"/>
        </svg>
        Créer mon compte
    </button>
</form>

<div class="login-link">
    Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
</div>

<a href="{{ url('/') }}" class="back-home">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M19 12H5M12 19l-7-7 7-7"/>
    </svg>
    Retour à l'accueil
</a>

</x-guest-layout>
