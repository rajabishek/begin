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
	'bootstrap': './node_modules/bootstrap/',
    'bootswatch': './node_modules/bootswatch/',
    'jquery': './node_modules/jquery/',
    'spinkit': './node_modules/spinkit/',
}

elixir(function(mix) {
	
    mix.sass('app.scss');

	mix.styles([
        paths.bootswatch + 'flatly/bootstrap.min.css',
        paths.spinkit + 'css/spinkit.css',
    ], 'public/css/app.css', './');

    mix.copy(paths.bootswatch + 'fonts/**', 'public/fonts');
    
    mix.scripts([paths.jquery + 'dist/jquery.min.js', paths.bootstrap + 'dist/js/bootstrap.min.js']);
    
    mix.browserify('bootstrap.js', 'public/js/app.js');
});
