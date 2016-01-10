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
    'bootswatch': './vendor/bower_components/bootstrap-theme-bootswatch-flatly/',
    'jquery': './vendor/bower_components/jquery/',
    'spinkit': './node_modules/spinkit/',
}

elixir(function(mix) {
	
    mix.sass('app.scss');

	mix.styles([
        paths.bootswatch + 'css/bootstrap.min.css',
        paths.spinkit + 'css/spinkit.css',
    ], 'public/css/app.css', './');

    mix.copy(paths.bootstrap + 'fonts/**', 'public/fonts');
    
    mix.scripts([paths.jquery + 'dist/jquery.min.js', paths.bootstrap + 'dist/js/bootstrap.min.js']);
    
    mix.browserify('bootstrap.js', 'public/js/app.js');
});
