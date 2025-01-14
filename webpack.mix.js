let mix = require('laravel-mix');

require('./mix');

mix
    .setPublicPath('dist')
    .js('resources/js/tool.js', 'js')
    .vue({
        version: 3
    })
    .nova('bavyhappy/nova-cashier-overview-plan-details');
