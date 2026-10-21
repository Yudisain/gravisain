import { defineConfig } from 'vite';
import { resolve, dirname } from 'path';
import { fileURLToPath } from 'url';
import react from '@vitejs/plugin-react';
import { viteStaticCopy } from 'vite-plugin-static-copy';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

export default defineConfig({
  plugins: [
    react(),
    viteStaticCopy({
      targets: [
        {
          src: 'src/images/*',
          dest: 'images'
        }
      ]
    })
  ],
  build: {
    outDir: 'assets',
    emptyOutDir: true,
    manifest: 'manifest.json',
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/js/main.js'),
        style: resolve(__dirname, 'src/css/main.css'),
        customizer: resolve(__dirname, 'src/js/customizer.js'),
        'customizer-style': resolve(__dirname, 'src/css/customizer.css'),
        'customizer-controls': resolve(__dirname, 'src/js/customizer-controls.js'),
        'customizer-react': resolve(__dirname, 'src/js/customizer-react.jsx'),
        'customizer-controls-style': resolve(__dirname, 'src/css/customizer-controls.css'),
        'customize-preview': resolve(__dirname, 'src/js/customize-preview.js')
      },
      output: {
        entryFileNames: 'js/[name]-[hash].js',
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: 'css/[name]-[hash].[ext]'
      }
    }
  }
});
