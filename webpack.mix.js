const mix = require('laravel-mix');

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .postCss('resources/assets/css/tailwind.css', 'public/css', [
        require("tailwindcss"),
    ])
    .js('node_modules/chart.js/auto/auto.js', 'public/js/chartjs.js')
    .js('resources/assets/js/app.js', 'public/js').vue();
