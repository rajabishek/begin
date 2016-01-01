var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

require('laravel-elixir-vueify');

var paths = {
	'bootstrap': './vendor/bower_components/bootstrap/',
    'bootswatch': './vendor/bower_components/bootstrap-theme-bootswatch-flatly/'
}

elixir(function(mix) {
	
	mix.styles([
        paths.bootswatch + 'css/bootstrap.min.css',
    ], 'public/css/app.css', './');

    mix.copy(paths.bootstrap + 'fonts/**', 'public/fonts');

    mix.version('public/css/app.css');

    mix.browserify('bootstrap.js', 'public/js/app.js');
});
