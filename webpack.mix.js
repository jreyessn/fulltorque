const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.react('resources/js/app.js', 'public/js')
    .react('resources/js/blade/header-standalone.js', 'public/js/blade')
    .react('resources/js/blade/footer-standalone.js', 'public/js/blade')
    .sass('resources/sass/app.scss', 'public/css');
