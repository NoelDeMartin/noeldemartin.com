document.addEventListener('turbo:click', () => {
    Turbo.navigator.delegate.adapter.progressBar.setValue(0);
    Turbo.navigator.delegate.adapter.progressBar.show();
});

document.addEventListener('turbo:frame-load', (event) => {
    const header = document.querySelector('header');
    const frameData = event.target.firstElementChild.dataset;
    const currentNav = header.querySelector('[aria-current]');

    header.dataset.collapsed = frameData.collapsedHeader;

    if (currentNav?.href !== frameData.currentPath) {
        currentNav?.removeAttribute('aria-current');
        header
            .querySelector(`[href="${frameData.currentPath}"]`)
            ?.setAttribute('aria-current', 'page');
    }

    Turbo.navigator.delegate.adapter.progressBar.hide();
});
