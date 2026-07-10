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
mix.options({
    processCssUrls: false
});

mix.webpackConfig({
    stats: {
        warnings: false,
    }
});
mix.js('resources/js/app.js', 'public/js')
    .js('resources/metronic/js/custom/prismjs.bundle.js', 'public/js/custom/')
    //.js('resources/metronic/js/global/plugins.bundle.js', 'public/js/global/')
    .js('resources/metronic/js/scripts.bundle.js', 'public/js')
    .js('resources/js/datatable/data-local.js', 'public/js/datatable/')

    .sass('resources/sass/app.scss', 'public/css')

    .css('resources/metronic/css/aside/dark.rtl.css', 'public/css/aside/')
    .css('resources/metronic/css/base/light.rtl.css', 'public/css/base/')
    .css('resources/metronic/css/brand/dark.rtl.css', 'public/css/brand/')
    .css('resources/metronic/css/menu/light.rtl.css', 'public/css/menu/')
    .css('resources/metronic/css/plugins.bundle.rtl.css', 'public/css')
    .css('resources/metronic/css/login/login-5.rtl.css', 'public/css/login/')
    .css('resources/metronic/css/style.bundle.rtl.css', 'public/css')
    .sourceMaps();
