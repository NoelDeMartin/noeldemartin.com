import { after } from '@noeldemartin/utils';

let lastClickedUrl;

document.querySelectorAll('.heading-permalink').forEach((heading) => {
    heading.dataset.turbo = false;
});

document.addEventListener('turbo:click', (event) => {
    lastClickedUrl = event.detail.url;
});

document.addEventListener('turbo:load', async () => {
    // Wait for header animation to finish.
    await after({ ms: 500 });

    if (
        !lastClickedUrl ||
        window.location.href === lastClickedUrl ||
        !lastClickedUrl.startsWith(window.location.href)
    ) {
        return;
    }

    window.location.href = lastClickedUrl;
});
