const mix = require('laravel-mix');

mix.js('resources/assets/js/index.js', 'cookie-consent.js')
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