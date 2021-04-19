const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/admin/app.js', 'public/js/admin').vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.js('resources/js/enduser/app.js', 'public/js/enduser').vue()
    .postCss('resources/css/enduser.css', 'public/css/', [
        //
    ]);

mix.version();