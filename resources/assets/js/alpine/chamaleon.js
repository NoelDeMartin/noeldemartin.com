import Alpine from 'alpinejs';

const start = Date.now();

function updateColor(el) {
    el.style.setProperty(
        '--color-chamaleon',
        'hsl(' + ((((Date.now() - start) / 100) % 360) + 180) + ', 40%, 80%)',
    );

    requestAnimationFrame(() => updateColor(el));
}

Alpine.directive('chamaleon', (el) => updateColor(el));
