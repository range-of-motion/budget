import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel([
            'resources/assets/css/tailwind.css',
            'resources/assets/js/app.js',
        ]),
        vue(),
    ],
});
