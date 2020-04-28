const mix = require('laravel-mix');
const stylelint = require('stylelint');
const tailwindcss = require('tailwindcss');
const purgecss = require('@fullhuman/postcss-purgecss');
const CleanPlugin = require('clean-webpack-plugin');

mix
    .js('resources/assets/js/main.js', 'public/js')
    .copy('resources/assets/js/experiments', 'public/js/experiments')
    .sass('resources/assets/sass/main.scss', 'public/css', {}, [
        stylelint(),
        tailwindcss(),
        ...(
            process.env.NODE_ENV === 'production'
                ? [
                    purgecss({
                        content: [
                            './resources/views/**/*.blade.php',
                            './storage/recipes/**/*.md',
                            './resources/assets/sass/**/*.scss',
                        ],
                        defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || [],
                    }),
                ]
                : []
        ),
    ])
    .sass('resources/assets/sass/code-highlighter.scss', 'public/css')
    .options({ processCssUrls: false })
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
