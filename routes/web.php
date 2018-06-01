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

Route::get('/posts/{post_id}', 'blog\PostController@getPost')
    ->where('post_id', '[0-9]+');

Route::match(['get', 'patch'],'posts/{post_id}/edit', 'blog\PostController@editPost')
    ->where('post_id', '[0-9]+');

Route::delete('/posts/{post_id}', 'blog\PostController@deletePost')
    ->where('post_id', '[0-9]+');

Route::match(['get', 'post'], '/posts/create', 'blog\PostController@createPost')
    ->middleware('auth');

Route::match(['get', 'post'], '/category/create', 'blog\CategoryController@createCategory')
    ->middleware('auth');

Route::post('/posts/{post_id}/comment', 'blog\CommentController@storeComment')
    ->middleware('auth');

//----------------Profile

Route::get('/profile', 'HomeController@profile')
    ->middleware('auth');