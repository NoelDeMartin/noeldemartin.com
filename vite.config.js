import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/assets/css/code.css',
                'resources/assets/css/main.css',
                'resources/assets/js/code.js',
                'resources/assets/js/main.js',
                'resources/assets/js/slides.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'node_modules/pdfjs-dist/build/pdf.worker.min.mjs',
                    dest: 'assets',
                    rename: 'slides.worker.js',
                },
            ],
        }),
    ],
});
