import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; // إذا كنت تستخدم Vue

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css', // إذا كان لديك ملف CSS رئيسي
        'resources/js/app.js',   // نقطة الدخول JS
      ],
      refresh: true,
    }),
    vue(), // إذا كنت تستخدم Vue
  ],
});
