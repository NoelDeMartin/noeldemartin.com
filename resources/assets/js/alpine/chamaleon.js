import Alpine from 'alpinejs';

function updateColor(el) {
    el.style.setProperty(
        '--color-chamaleon',
        'hsl(' + ((Date.now() / 100) % 360) + ', 40%, 80%)',
    );

    requestAnimationFrame(() => updateColor(el));
}

Alpine.directive('chamaleon', (el) => {
    updateColor(el);
    setTimeout(() => {
        const tintedElements = Array.from(el.querySelectorAll('.bg-chamaleon'));

        if (el.matches('.bg-chamaleon')) {
            tintedElements.push(el);
        }

        tintedElements.forEach((tintedElement) => {
            tintedElement.classList.remove('transition-colors');
        });
    }, 1000);
});
