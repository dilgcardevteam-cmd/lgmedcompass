import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/login.css',
                'resources/css/register.css',
                'resources/css/document.css',
                'resources/css/account-management.css',
                'resources/css/my-task.css',
                'resources/css/calendar-modal.css',
                'resources/css/calendar-responsiveness.css',
                'resources/css/archive.css',
                'resources/css/calendar.css',
                'resources/css/style.css',
                'resources/css/profile.css',
                'resources/js/bootstrap.js',
                'resources/js/script.js',
            ],
            refresh: true,
        }),
    ],

    build: {
        outDir: 'public/build',
    },

    server: {
        host: 'localhost',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost',
        },
    },
});