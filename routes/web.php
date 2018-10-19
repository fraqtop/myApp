<?php

Route::get('/', 'HomeController@index');

Route::match(['get', 'post'],'/contact', 'HomeController@contact');

Route::auth();

Route::get('/posts', 'Blog\PostController@getAllPosts');
Route::get('/posts/{post_id}', 'Blog\PostController@getPost')
    ->where('post_id', '[0-9]+');

//---------------Auth

Route::group(['middleware' => 'auth'], function ()
{
    //--------------Blog
    Route::group(['namespace' => 'Blog'], function (){
        Route::match(['get', 'patch'],'posts/{post_id}/edit', 'PostController@editPost')
            ->where('post_id', '[0-9]+');
        Route::delete('/posts/{post_id}', 'PostController@deletePost')
            ->where('post_id', '[0-9]+');
        Route::match(['get', 'post'], '/posts/create', 'PostController@createPost');
        Route::post('/posts/{post_id}/comment', 'CommentController@storeComment');
        Route::get('test/',function(){
           return 'test passed';
        });
    });

    Route::get('/profile', 'HomeController@profile');

    //---------------Football

    Route::group(['namespace' => 'Football'], function(){
        Route::get('/football', 'LeagueController@get');
        Route::match(['get', 'patch'],'/football/{league_id}', 'LeagueController@getStandings')
            ->where('league_id', '[0-9]+');
        Route::get('/football/team/{team_id}', 'TeamController@get');
        Route::get('/football/refresh', 'LeagueController@refreshLeagues');
    });

    //----------------Admin

    Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function()
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
});
