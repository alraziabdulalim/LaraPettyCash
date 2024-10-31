import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '193.168.0.4',
        port: 9001,
        // hmr: {
        //     host: '193.168.0.4',
        //     port: 9001,
        // },
        hmr: false, // Disable HMR to stop automatic reloading
    },
});
