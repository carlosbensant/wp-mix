const { mix } = require('laravel-mix')
const path = require('path')

const THEME_DIR = 'public/wp-content/themes/default';
const HOME_URL = 'http://wp-demo.test';

/*
 |--------------------------------------------------------------------------
 | Asset Management
 |--------------------------------------------------------------------------
 |
 | This file defines the building steps of the application. Here's where the
 | client-side technologies are configured according to the needs. Steps such
 | as JSX or SASS processing also happens here.
 |
 | In our case, we're using laravel mix to manage most of the hassle of manually
 | setting theses rules. We're also using a custom webpack config which allows
 | us to add any additional babel plugin that we may need (such as babel decorators).
 |
 */

mix
    .browserSync({
        open: false,
        proxy: HOME_URL,
        notify: false,
        stream: true,
        files: [
            'style.css',
            'js/{*,**/*}.js',
            '{*,**/*}.php'
        ]
    })
    .options({
        processCssUrls: false
    })
    .webpackConfig({
        resolve: {
            modules: [
                path.resolve(`${THEME_DIR}/assets/scripts`),
                path.resolve('./node_modules')
            ],
        }
    })
    .sass(`${THEME_DIR}/assets/scss/application.scss`, `${THEME_DIR}/style.css`)
    .js(`${THEME_DIR}/assets/scripts/application.js`, `${THEME_DIR}/application.js`)
