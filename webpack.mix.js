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


mix.js('resources/js/main_js.js', 'public/js')
    .postCss('resources/css/style.css', 'public/css')
    .browserSync({
        proxy: '127.0.0.1:8000',
        notify: {
            styles: {
                top: 'auto',
                bottom: '20px'
            }
        }
    });