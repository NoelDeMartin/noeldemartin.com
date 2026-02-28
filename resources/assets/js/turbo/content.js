import { after } from '@noeldemartin/utils';

let lastClickedUrl;
let isClickNavigation = false;

document.querySelectorAll('.heading-permalink').forEach((heading) => {
    heading.dataset.turbo = false;
});

document.addEventListener('turbo:click', (event) => {
    lastClickedUrl = event.detail.url;
    isClickNavigation = true;
});

document.addEventListener('turbo:before-visit', (event) => {
    if (event.detail.action !== 'restore') {
        return;
    }

    // Clear redirects on browser navigation
    isClickNavigation = false;
    lastClickedUrl = null;
});

document.addEventListener('turbo:fetch-request-error', async (event) => {
    if (event.originalTarget?.tagName !== 'TURBO-FRAME') {
        return;
    }

    // Handle redirects that may be causing CORS errors.
    const manualResponse = await fetch(event.detail.request.url, {
        redirect: 'manual',
    });

    if (manualResponse.type === 'opaqueredirect') {
        window.open(event.detail.request.url, '_blank');
        Turbo.navigator.delegate.adapter.progressBar.hide();
    }
});

document.addEventListener('turbo:load', async () => {
    if (!isClickNavigation) {
        lastClickedUrl = null;

        return;
    }

    // Wait for header animation to finish.
    await after({ ms: 500 });

    if (
        !lastClickedUrl ||
        window.location.href === lastClickedUrl ||
        !lastClickedUrl.startsWith(window.location.href)
    ) {
        isClickNavigation = false;
        lastClickedUrl = null;

        return;
    }

    window.location.href = lastClickedUrl;
    isClickNavigation = false;
    lastClickedUrl = null;
});
