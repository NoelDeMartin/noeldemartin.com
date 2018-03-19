const mix = require('laravel-mix');
const stylelint = require('stylelint');
const tailwindcss = require('tailwindcss');

mix
    .js('resources/assets/js/main.js', 'public/js')
    .sass('resources/assets/sass/main.scss', 'public/css')
    .copy('resources/assets/fonts', 'public/fonts')
    .copy('resources/assets/img', 'public/images')
    .options({
        processCssUrls: false,
        postCss: [
            stylelint(),
            tailwindcss('tailwind.js'),
        ],
    })
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.js$/,
                    use: ['babel-loader', 'eslint-loader'],
                    exclude: /node_modules/,
                },
            ],
        },
    });
