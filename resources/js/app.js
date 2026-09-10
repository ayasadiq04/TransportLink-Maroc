import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('submit', (event) => {
    const form = event.target;

    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    if (!form.hasAttribute('data-loading')) {
        return;
    }

    if (form.dataset.loading === 'true') {
        event.preventDefault();
        return;
    }

    const submitter = event.submitter || form.querySelector('button[type="submit"], input[type="submit"], button:not([type])');

    if (!submitter) {
        return;
    }

    form.dataset.loading = 'true';
    form.setAttribute('aria-busy', 'true');
    submitter.disabled = true;

    const label = submitter.dataset.loadingLabel || 'Envoi...';

    const spinner = [
        '<svg class="loading-spinner" style="width:1em;height:1em" viewBox="0 0 24 24" fill="none" aria-hidden="true">',
        '  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity="0.25"></circle>',
        '  <path fill="currentColor" opacity="0.75" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>',
        '</svg>'
    ].join('');

    if (submitter.tagName.toLowerCase() === 'button') {
        submitter.dataset.originalContent = submitter.innerHTML;
        submitter.innerHTML = `<span class="inline-flex items-center justify-center gap-2">${spinner}<span>${label}</span></span>`;
    } else {
        submitter.dataset.originalValue = submitter.value;
        submitter.value = label;
    }
});

document.addEventListener('click', (event) => {
    const toggle = event.target.closest('[data-password-toggle]');

    if (toggle) {
        const input = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (!input || !eyeIcon) {
            return;
        }

        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        eyeIcon.innerHTML = isHidden
            ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
            : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
});

document.addEventListener('click', (event) => {
    const card = event.target.closest('[data-role-select]');

    if (!card) {
        return;
    }

    const role = card.dataset.roleSelect;
    const input = document.getElementById('role-' + role);
    const clientCard = document.getElementById('card-client');
    const transporteurCard = document.getElementById('card-transporteur');

    if (!input || !clientCard || !transporteurCard) {
        return;
    }

    input.checked = true;
    clientCard.classList.toggle('selected', role === 'client');
    transporteurCard.classList.toggle('selected', role === 'transporteur');
});

document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-mobile-menu-toggle]');

    if (!button) {
        return;
    }

    const menu = document.getElementById('mobile-menu');

    if (menu) {
        menu.classList.toggle('hidden');
    }
});

document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-confirm]');

    if (button && !window.confirm(button.dataset.confirm)) {
        event.preventDefault();
    }
});

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', (event) => {
        const target = document.querySelector(anchor.getAttribute('href'));

        if (target) {
            event.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

const contactForm = document.getElementById('contact-form');

if (contactForm) {
    contactForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const button = document.getElementById('contact-submit-btn');
        button.textContent = '✅ Message envoyé !';
        button.style.background = 'linear-gradient(135deg,#10b981,#059669)';
        button.disabled = true;

        setTimeout(() => {
            button.textContent = 'Envoyer le message ✈️';
            button.style.background = '';
            button.disabled = false;
            contactForm.reset();
        }, 3000);
    });
}