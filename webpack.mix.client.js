const mix                 = require('laravel-mix');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

mix.setPublicPath('public/client/');

/*
* Defining client asset pipeline
*/

Mix.listen('configReady', config => {
    const scssRule = config.module.rules.find(r => r.test.toString() === /\.scss$/.toString());
    const scssOptions = scssRule.loaders.find(l => l.loader === 'sass-loader').options;
    scssOptions.data = '@import "./resources/client/sass/styles.scss";';

    const sassRule = config.module.rules.find(r => r.test.toString() === /\.sass$/.toString());
    const sassOptions = sassRule.loaders.find(l => l.loader === 'sass-loader').options;
    sassOptions.data = '@import "./resources/client/sass/styles.scss"';
})

mix
    .options({
        extractVueStyles: true,
    })
    .webpackConfig({
        plugins: [new VuetifyLoaderPlugin()]
    })
    .js('resources/client/js/app.js', 'js')
    .sass('resources/client/sass/app.scss', 'css')

