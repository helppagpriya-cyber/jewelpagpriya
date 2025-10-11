
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css', // Your CSS entry point
        'resources/js/app.js',   // Your JS entry point
      ],
      refresh: true,
    }),
  ],
  server: {
    hmr: {
      overlay: true, // Keep this to show errors in the browser
    },
  },
});