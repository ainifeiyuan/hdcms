const mix = require('laravel-mix')

require('laravel-mix-merge-manifest')
mix.setPublicPath('../../public').mergeManifest()

mix.js('Resources/js/app.js', '../../public/modules/Shop/app.js')
    .sass('Resources/sass/app.scss', '../../public/modules/Shop/app.css')
    .options({
        postCss: [require('postcss-css-variables')(), require('postcss-import'), require('tailwindcss')]
    })
    .webpackConfig(require('./webpack.config'))

mix.copyDirectory('Resources/static', '../../public/modules/Shop/static')