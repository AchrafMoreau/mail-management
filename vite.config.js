import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  build: {
    outDir: 'public/dist', // Dossier de sortie des fichiers build
    rollupOptions: {
      input: {
        main: 'resources/js/app.js', // Point d'entrée de l'application
      },
    },
  },
});
