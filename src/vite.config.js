import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import {quasar, transformAssetUrls} from '@quasar/vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: { transformAssetUrls: {
                base: null,
                includeAbsolute: false,
            }}
        }),
        quasar({
            sassVariables: 'resources/css/quasar-variables.sass',
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost',
            protocol: 'ws',
        }
    },
});
