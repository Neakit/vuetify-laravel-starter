const mix = require('laravel-mix');

mix.setPublicPath('public/admin/');

/*
* Defining admin asset pipeline
*/

mix.js('resources/admin/js/entry.js', 'js')
    .sass('resources/admin/sass/app.scss', 'css');

mix.options({
    processCssUrls: false
});
