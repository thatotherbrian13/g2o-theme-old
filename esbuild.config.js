const esbuild = require('esbuild');
const path = require('path');

// Build configuration
const config = {
  entryPoints: ['source/scripts/scripts.js'],
  bundle: true,
  outfile: 'build/js/scripts.js',
  format: 'iife',
  target: ['es2020', 'chrome90', 'firefox90', 'safari14', 'edge90'],
  minify: process.env.NODE_ENV === 'production',
  sourcemap: process.env.NODE_ENV !== 'production',

  // GSAP and Alpine.js need to be available globally
  globalName: 'G2OBundle',

  // Define globals that are expected (Splitting is loaded via CDN)
  define: {
    'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV || 'development')
  },

  // Log build info
  logLevel: 'info',
};

// Run build
esbuild.build(config).then(() => {
  console.log('✓ JavaScript build complete: build/js/scripts.js');
}).catch((error) => {
  console.error('Build failed:', error);
  process.exit(1);
});
