const mix = require('laravel-mix');
const stylelint = require('stylelint');
const tailwindcss = require('tailwindcss');
const CleanPlugin = require('clean-webpack-plugin');

mix
    .js('resources/assets/js/main.js', 'public/js')
    .copy('resources/assets/js/experiments', 'public/js/experiments')
    .sass('resources/assets/sass/main.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [
            stylelint(),
            tailwindcss('tailwind.js'),
        ],
    })
    .version()
    .webpackConfig({
        output: {
            publicPath: '/',
            chunkFilename: 'js/chunks/[name].js',
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    use: ['babel-loader', 'eslint-loader'],
                    exclude: /node_modules/,
                },
                {
                    test: /\.vue$/,
                    use: [
                        {
                            loader: 'vue-loader',
                        },
                        'eslint-loader',
                    ],
                    exclude: /bower_components/,
                },
            ],
        },
        plugins: [
            new CleanPlugin(
                [
                    'public/js',
                    'public/css',
                ],
                {
                    dist: __dirname,
                    verbose: true,
                    dry: false,
                }
            ),
        ],
    });
