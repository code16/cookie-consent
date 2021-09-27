const mix = require('laravel-mix');

mix.js('resources/assets/js/index.js', 'cookie-consent.js')
    .js('resources/assets/js/bootstrap-vue/index.js', 'bootstrap-vue/cookie-consent.js')
    .sass('resources/assets/scss/cookie-consent.scss', 'cookie-consent.css')
    .setPublicPath('resources/assets/dist')
    .options({
        processCssUrls: false,
        terser: {
            extractComments: false,
        }
    })
    .babelConfig({
        presets: [
            [
                '@babel/preset-env',
                {
                    useBuiltIns: 'usage',
                    corejs: 3,
                }
            ]
        ],
    });

if(mix.inProduction()) {
    mix.version();
}
