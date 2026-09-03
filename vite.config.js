import { defineConfig } from 'vite'

// Assets are built into public/dist and read back through the manifest in
// public/index.php. No framework plugin: the fixture is plain PHP on purpose.
export default defineConfig({
  // The docroot is not a Vite public dir: it must not be copied into the build.
  publicDir: false,
  base: '/dist/',
  build: {
    manifest: true,
    outDir: 'public/dist',
    emptyOutDir: true,
    rollupOptions: {
      input: ['src/js/app.js', 'src/css/app.css'],
    },
  },
})
