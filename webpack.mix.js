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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]).styles([
        'public/dashboard/vendor/bootstrap/css/bootstrap.min.css',
        'public/dashboard/vendor/fontawesome-free/css/all.min.css',
        'public/dashboard/vendor/owl-carousel/owl.carousel.css',
        'public/dashboard/vendor/owl-carousel/owl.theme.css',
        'public/dashboard/css/osahan.css',
        'public/app/style.css',
        'public/css/toastr.min.css',
    ], 'public/css/app.css')
    .scripts([
        'public/dashboard/vendor/jquery/jquery.min.js',
        'public/dashboard/vendor/jquery-easing/jquery.easing.min.js',
        'public/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'public/dashboard/vendor/owl-carousel/owl.carousel.js',
        'public/dashboard/js/custom.js',
        'public/js/axios.min.js',
        'public/js/toastr.min.js',
        'public/js/jquery.validate.min.js',
        'public/app/Config.js',
        'public/app/Core.js',
    ], 'public/js/app.js');

    if (mix.inProduction()) {
        mix.version();
    }
