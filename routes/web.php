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

Route::match(['get', 'post'],'/contact', 'HomeController@contact');

Route::auth();

//----------------Blog

Route::get('/posts', 'blog\PostController@getAllPosts');

Route::get('/post/{post_id}', 'blog\PostController@getPost')->where('post_id', '[0-9]+');

Route::match(['get', 'post'], '/post/create', 'blog\PostController@createPost')->middleware('auth');

Route::match(['get', 'post'], '/category/create', 'blog\CategoryController@createCategory')->middleware('auth');

Route::post('/post/{post_id}/comment', 'blog\CommentController@storeComment')->middleware('auth');

//----------------Profile

Route::get('/profile', 'HomeController@profile')->middleware('auth');