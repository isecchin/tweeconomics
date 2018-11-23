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

mix.js('resources/js/core.js', 'public/js/main.js')
    .combine([
        'public/js/main.js',
        'resources/js/plugins/*.js',
        'resources/js/models/*.js',
        'resources/js/utils.js',
        'resources/js/main.js'
    ], 'public/js/main.js')
   .sass('resources/sass/core.scss', 'public/css/main.css')
       .combine([
        'public/css/main.css',
        'resources/sass/dashboard.css'
    ], 'public/css/main.css');
