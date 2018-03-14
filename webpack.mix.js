let mix = require('laravel-mix');

mix
    .copy('resources/assets/css', 'public/css')
    .sass('resources/assets/sass/app.scss', 'public/css');