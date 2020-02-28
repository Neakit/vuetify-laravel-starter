/*
* entry point for webpack mix
 */

if(process.env.APP_SECTION){
    require(`./webpack.mix.${process.env.APP_SECTION}.js`);
}
