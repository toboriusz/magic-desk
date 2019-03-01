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

mix
  .js('resources/js/app.js', 'public/js/app.js')
  .sass('resources/sass/app.sass', 'public/css/app.css')
  //.options({ processCssUrls: false })
  .webpackConfig({
      resolve: {
          alias: {
              '@':            path.resolve(__dirname, 'resources/js'),    
              'Style':        path.resolve(__dirname, 'resources/sass'),
              'Assets':       path.resolve(__dirname, 'resources/assets'),
              'Router':       path.resolve(__dirname, 'resources/js/router'),
              'Api':     			path.resolve(__dirname, 'resources/js/api'),
              'Views':        path.resolve(__dirname, 'resources/js/views'),
              'Layouts':      path.resolve(__dirname, 'resources/js/layouts'),
              'Components':   path.resolve(__dirname, 'resources/js/components'),
              'Store':        path.resolve(__dirname, 'resources/js/store'),
              'StoreModules': path.resolve(__dirname, 'resources/js/store/modules'),
              'Utils':        path.resolve(__dirname, 'resources/js/utils'),
              'Plugins':      path.resolve(__dirname, 'resources/js/plugins'),
          },
      }
  })
  .sourceMaps()
  .version();

var LiveReloadPlugin = require('webpack-livereload-plugin');

mix.webpackConfig({
    plugins: [
        new LiveReloadPlugin()
    ]
});