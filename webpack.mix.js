const mix = require('laravel-mix');
const stylelint = require('stylelint');
const tailwindcss = require('tailwindcss');

mix
    .copy('resources/assets/fonts', 'public/fonts')
    .copy('resources/assets/img', 'public/images')
    .sass('resources/assets/sass/main.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [
            stylelint(),
            tailwindcss('tailwind.js'),
        ],
    });