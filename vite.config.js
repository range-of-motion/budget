import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';

export default defineConfig({
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm.js',
        }
    },

    plugins: [
        laravel([
            'resources/assets/css/tailwind.css',
            'resources/assets/js/app.js',
        ]),
        vue(),
    ],
});
