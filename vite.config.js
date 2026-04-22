import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  server: {
    port: 5173,
    hmr: {
      host: 'localhost',
      port: 5173,
    },
  },
  build: {
    outDir: 'public/build',
    manifest: true,
    rollupOptions: {
      input: {
        app: 'resources/js/app.js',
        dropdown: 'resources/css/dropdown.css',
      },
    },
  },
})
