<?php

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

//---------------Auth

Route::group(['middleware' => 'auth'], function ()
{
    Route::match(['get', 'post'], '/posts/create', 'Blog\PostController@createPost');
    Route::post('/posts/{post_id}/comment', 'Blog\CommentController@storeComment');

    Route::get('/profile', 'HomeController@profile');

    Route::get('/leagues', function (){
        print_r(Football::getLeague(2003));
    });
});

//----------------Admin

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function()
{
   Route::get('/admin', 'TrafficController@getTraffic');

   Route::get('/admin/categories', 'CategoryController@get');
   Route::post('/admin/categories', 'CategoryController@create');
   Route::patch('/admin/categories/{category_id}', 'CategoryController@update');
   Route::delete('/admin/categories/{category_id}', 'CategoryController@delete');

   Route::get('/admin/tasks', 'TaskController@get');
   Route::post('/admin/tasks/create', 'TaskController@create');
   Route::delete('/admin/tasks/{task_id}', 'TaskController@delete');
});