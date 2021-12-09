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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'TimeController@index');
    Route::get('/times/create', 'TimeController@create');
    Route::post('/times/start_store/{study_site}', 'TimeController@start_store');
    Route::post('/times/stop_store', 'TimeController@stop_store');
    Route::get('times/store', 'TimeController@store');
    Route::get('/times/show', 'TimeController@show');
    Route::get('/times/{time}/edit', 'TimeController@edit');
    Route::put('/times/{time}', 'TimeController@update');
    Route::delete('/times/{time}', 'TimeController@delete');
    
    // Route::post('/tweets/goal_store', 'TweetController@goal_store');
    Route::post('/tweets/store', 'TweetController@store');
    Route::post('/tweets/review_store', 'TweetController@review_store');
    
    Route::get('/user/{study_site_id}', 'UserController@index');
    Route::get('/user/{time}/edit', 'UserController@edit');
    Route::put('/user/{time}', 'UserController@update');

    Route::post('/study_sites/store', 'StudySiteController@store'); //サイトのtitleとurlを保存
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@delete');
    Route::get('/posts', 'PostController@index');
    Route::get('/posts/{post}/edit', 'PostController@edit');
    Route::get('/posts/create', 'PostController@create');
    Route::post('posts/store', 'PostController@store');
    
    
    
    Route::get('/comments/{post_id}', 'CommentController@index');
    Route::post('/comments/create', 'CommentController@create');
    Route::post('/comments/store/{post_id}', 'CommentController@store');
    Route::get('/comments/reply/{comment_id}', 'CommentController@reply');
    Route::post('/comments/reply/store/{comment_id}', 'CommentController@reply_store');
    
    
    Route::get('/ranking', 'TimeController@ranking');
    Route::post('/ranking/tweet', 'TimeController@tweet');
});

Auth::routes();




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
