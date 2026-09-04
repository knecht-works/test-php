import { defineConfig } from 'vite'

// Assets are built into public/dist and read back through the manifest in
// public/index.php. No framework plugin: the fixture is plain PHP on purpose.
export default defineConfig(({ command }) => ({
  // The docroot is not a Vite public dir: it must not be copied into the build.
  publicDir: false,
  // The dev server serves from the root: public/index.php builds the dev URLs
  // as <dev server>/<source path>.
  base: command === 'serve' ? '/' : '/dist/',
  build: {
    manifest: true,
    outDir: 'public/dist',
    emptyOutDir: true,
    rollupOptions: {
      input: ['src/js/app.js', 'src/css/app.css'],
    },
  },
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    allowedHosts: true,
    cors: {
      origin: /https?:\/\/([A-Za-z0-9\-\.]+)?(localhost|\.local|\.test|\.site)(?::\d+)?$/,
    },
  },
}))
