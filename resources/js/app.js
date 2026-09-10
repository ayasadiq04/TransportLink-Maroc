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