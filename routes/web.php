<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index');

Route::auth();

//----------------Blog

Route::get('/posts', 'BlogController@posts');

Route::get('/post/{post_id}', 'BlogController@getPost');

Route::match(['get', 'post'], '/createpost', 'BlogController@createPost');

Route::match(['get', 'post'], '/createcategory', 'BlogController@createCategory');

//----------------Profile

Route::get('/profile', 'HomeController@profile');