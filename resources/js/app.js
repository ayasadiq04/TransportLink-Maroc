
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

document.addEventListener('click', (event) => {
    const link = event.target.closest('[data-notification-id]');

    if (!link) {
        return;
    }

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const token = csrfMeta ? csrfMeta.getAttribute('content') : null;

    if (!token) {
        return;
    }

    fetch(`/notifications/${link.dataset.notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
        },
        keepalive: true,
    });
});