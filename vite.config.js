import { defineConfig } from 'vite'

export default defineConfig(({ command }) => {
  const isProduction = command === 'build'

  return {
    plugins: [
      // Modern browsers only - no legacy support needed
    ],
    // Disable public directory feature since CodeIgniter handles static files
    publicDir: false,
    build: {
      // Output directory for built assets
      outDir: 'public/assets',
      // Generate manifest for asset mapping
      manifest: true,
      // Emit assets to separate directory structure
      assetsDir: 'assets',
      rollupOptions: {
        // Define entry points
        input: {
          main: 'resources/js/app.js',
          style: 'resources/css/app.css'
        },
        output: {
          // Better asset naming for caching
          chunkFileNames: 'js/[name]-[hash].js',
          entryFileNames: 'js/[name]-[hash].js',
          assetFileNames: ({ name }) => {
            if (/\.(gif|jpe?g|png|svg)$/.test(name ?? '')) {
              return 'images/[name]-[hash][extname]'
            }
            if (/\.css$/.test(name ?? '')) {
              return 'css/[name]-[hash][extname]'
            }
            return 'assets/[name]-[hash][extname]'
          }
        }
      }
    },
    // Configure dev server
    server: {
      port: 3000,
      open: false,
      host: 'localhost'
    },
    // Base URL for assets - different for dev and production
    base: isProduction ? '/assets/' : '/',
    // CSS configuration
    css: {
      devSourcemap: true
    }
  }
})
