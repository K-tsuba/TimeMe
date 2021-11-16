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

// Route::group(['middleware' => 'auth'], function(){
//     Route::get('/', 'PostController@index');
//     Route::get('/posts/create', 'PostController@create');
//     Route::get('/posts/{post}/edit', 'PostController@edit');
//     Route::put('/posts/{post}', 'PostController@update');
//     Route::delete('/posts/{post}', 'PostController@delete');
//     Route::get('/posts/{post}', 'PostController@show');
//     Route::post('/posts', 'PostController@store');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/user', 'UserController@index');




// Route::get('/times', 'TimeController@index');

// Route::get('/times', function () {
//     return view('times/index');
// });

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
    Route::get('/user', 'UserController@index');
    Route::post('/study_sites/store', 'StudySiteController@store'); //サイトのtitleとurlを保存
    Route::get('/ranking', 'TimeController@ranking');
    Route::get('/posts/create', 'PostController@create');
    // Route::post('/study_site/study_site_store/{study_site}', 'TimeController@study_site_store'); //勉強するを押したらstudy_site_idの保存
});

Auth::routes();



