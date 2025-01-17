import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/assets/css/main.css',
                'resources/assets/js/main.js',
            ],
            refresh: true,
        }),
    ],
});
