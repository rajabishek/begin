var elixir = require('laravel-elixir');
var gulp = require('gulp');

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
    'fontAwesome': './node_modules/font-awesome/',
	'bootstrap': './node_modules/bootstrap/',
    'bootswatch': './node_modules/bootswatch/',
    'jquery': './node_modules/jquery/',
    'spinkit': './node_modules/spinkit/',
}

elixir(function(mix) {
	
    mix.sass('app.scss');

	mix.styles([
        paths.fontAwesome + 'css/font-awesome.min.css',
        paths.bootswatch + 'flatly/bootstrap.min.css',
        paths.spinkit + 'css/spinkit.css',
    ], 'public/css/app.css', './');

    mix.copy(paths.bootstrap + 'fonts/**', 'public/fonts');
    mix.copy(paths.fontAwesome + 'fonts/**', 'public/fonts');
    
    mix.scripts([paths.jquery + 'dist/jquery.min.js', paths.bootstrap + 'dist/js/bootstrap.min.js']);
    
    mix.browserify('bootstrap.js', 'public/js/app.js');
});

gulp.task('heroku:', ['default']);
