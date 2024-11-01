import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  publicDir: '../public',
  build: {
    outDir: '../build',  // Change this as needed
    rollupOptions: {
        input:"src/Index.jsx",
        
      output: {
        entryFileNames: `[name].js`,
        assetFileNames: `[name].[ext]`,
      },
      
    },
  },
server: {
    open:true,
    hmr:true,
    host: 'localhost',
    port: 3001,
    proxy: {
      '/': {
        target: 'http://localhost/finalTouch/wp-admin',
        changeOrigin: true,
        secure: false,
      }
    }
  }
});
