let collapsed = document.querySelector('header').dataset.collapsed;

document.addEventListener('turbo:before-render', (event) => {
    const newHeader = event.detail.newBody.querySelector('header');
    const newCollapsed = newHeader.dataset.collapsed;

    newHeader.dataset.collapsed = collapsed;

    if (newCollapsed === collapsed) {
        return;
    }

    document.addEventListener(
        'turbo:render',
        () => {
            collapsed = newCollapsed;
            newHeader.dataset.collapsed = newCollapsed;
        },
        { once: true },
    );
});
