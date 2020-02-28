const mix = require('laravel-mix');

mix.setPublicPath('public/client/');

/*
* Defining client/web asset pipeline
*/

mix.js('resources/client/js/app.js', 'js')
    .sass('resources/client/sass/app.scss', 'css');
