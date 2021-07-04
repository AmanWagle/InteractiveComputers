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

mix.js('resources/js/admin/app.js', 'public/admin/js').vue()
    .sass('resources/sass/admin/app.scss', 'public/admin/css')
    .sourceMaps();

mix.js('resources/js/website/app.js', 'public/website/js').vue()
    .sass('resources/sass/website/app.scss', 'public/website/css')
    .sourceMaps();
