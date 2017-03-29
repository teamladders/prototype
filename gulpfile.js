const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.copy('resources/assets/fonts', 'public/fonts')

    mix.sass('app.scss')
       .webpack('app.js');

    mix.sass('theme.scss')
       .sass('public.scss')
       .webpack('public.js');

    mix.version(['css/app.css', 'css/public.css', 'js/app.js', 'js/public.js']);
});
