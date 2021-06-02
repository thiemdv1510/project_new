/* eslint-disable linebreak-style */
/* eslint-disable no-undef */
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

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            'scss@': path.resolve('resources/assets/admin/sass'),
            '@': path.resolve('resources/assets/admin/js'),
        },
    },
});

mix.js('resources/assets/admin/js/app.js', 'public/admin/js')
    .copyDirectory('node_modules/admin-lte/dist/', 'public/dist/')
    .copyDirectory('node_modules/admin-lte/plugins/', 'public/plugins/')
    .copyDirectory('resources/assets/admin/image', 'public/admin/image')
    .sass('resources/assets/admin/sass/app.scss', 'public/admin/css');

mix.version();
// mix.extract(['vue']);
mix.disableNotifications();