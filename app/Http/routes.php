<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
    return view('index');
});

Route::get('/posts', 'BlogController@posts');

Route::get('/posts/create', 'BlogController@createPost')->middleware('auth');

Route::post('/posts/create', 'BlogController@storePost')->middleware('auth');

Route::get('/posts/{postId}', 'BlogController@getPost');

Route::post('/posts/{postId}/addcomment', 'BlogController@storeComment')->middleware('auth');

Route::auth();