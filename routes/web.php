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

Route::get('/posts', 'Blog\PostController@getAllPosts');

Route::get('/posts/{post_id}', 'Blog\PostController@getPost')
    ->where('post_id', '[0-9]+');

Route::match(['get', 'patch'],'posts/{post_id}/edit', 'Blog\PostController@editPost')
    ->where('post_id', '[0-9]+');

Route::delete('/posts/{post_id}', 'Blog\PostController@deletePost')
    ->where('post_id', '[0-9]+');

Route::group(['middleware' => 'auth'], function ()
{
    Route::match(['get', 'post'], '/posts/create', 'Blog\PostController@createPost');
    Route::post('/posts/{post_id}/comment', 'Blog\CommentController@storeComment');

    Route::get('/profile', 'HomeController@profile');
});

//----------------Admin

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function()
{
   Route::get('/admin', 'TrafficController@showTraffic');

   Route::get('/admin/categories', 'CategoryController@getCategories');
   Route::post('/admin/categories', 'CategoryController@createCategory');
   Route::patch('/admin/categories/{category_id}', 'CategoryController@editCategory');
});