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

elixir(function(mix){
    mix.sass('main.scss');
});


elixir(function(mix) {
    mix.browserSync();
});


elixir(function(mix){
  mix.scripts([
     'jquery.js',
      'main.js',
      'bootstrap.js'
  ]);
});