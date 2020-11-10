const dotenvExpand = require('dotenv-expand')
dotenvExpand(require('dotenv').config({ path: '../../.env' /*, debug: true*/ }))

const mix = require('laravel-mix')

require('laravel-mix-merge-manifest')

mix.setPublicPath('../../public').mergeManifest()

mix.js(__dirname + '/Resources/js/app.js', 'modules/WeChat/app.js').sass(__dirname + '/Resources/sass/app.scss', 'modules/WeChat/app.css')

mix.copyDirectory(__dirname + '/Resources/static', '../../public/modules/WeChat/static')
