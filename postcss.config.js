/**
 * PostCSS Configuration
 * Used by postcss-cli for CSS compilation
 *
 * Pipeline: postcss-import → postcss-calc → tailwindcss/nesting → tailwindcss → autoprefixer
 */
module.exports = {
  plugins: [
    require('postcss-import'),
    require('postcss-calc'),
    require('tailwindcss/nesting'),
    require('tailwindcss'),
    require('autoprefixer'),
  ]
}
