let mix = require('laravel-mix');

mix
    .sass('resources/assets/sass/app.scss', 'public/css')
    .postCss('resources/assets/css/tailwind.css', 'public/css', [
        require("tailwindcss"),
    ])
    .js('resources/assets/js/app.js', 'public/js').vue();
