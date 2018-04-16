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

Route::get('/posts', 'blog\PostController@getAllPosts');

Route::get('/post/{post_id}', 'blog\PostController@getPost');

Route::match(['get', 'post'], '/createpost', 'blog\PostController@createPost');

Route::match(['get', 'post'], '/createcategory', 'blog\CategoryController@createCategory');

//----------------Profile

Route::get('/profile', 'HomeController@profile');