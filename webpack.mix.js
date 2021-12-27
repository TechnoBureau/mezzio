const mix = require('laravel-mix');

mix.disableNotifications();

mix.js('src/App/templates/js/technobureau.js', 'public/js')
    .sass('src/App/templates/sass/technobureau.scss', './public/css');
mix.extract();