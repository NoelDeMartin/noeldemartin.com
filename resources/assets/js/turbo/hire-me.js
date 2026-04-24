const aside = document.querySelector('#hire-me');

document.addEventListener('turbo:frame-load', (event) => {
    const frameData = event.target.firstElementChild.dataset;

    aside.dataset.collapsed = frameData.minimalLayout;
});

document.querySelector('#hire-me button').addEventListener('click', () => {
    document.cookie = 'hire_me_dismissed=true; max-age=604800; path=/';
    aside.dataset.collapsed = 'true';

    setTimeout(() => aside.remove(), 1000);
});
