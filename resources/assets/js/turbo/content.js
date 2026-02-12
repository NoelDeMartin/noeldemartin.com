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
