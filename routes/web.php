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

Route::view('/', 'about')->name('home');

Route::view('login', 'auth.login');
Route::post('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::prefix('blog')->group(function () {
    Route::get('/', 'HomeController@blog')->name('blog');
    Route::get('rss.xml', 'HomeController@rss')->name('blog.rss');
    Route::get('{id}', 'PostsController@show')->name('posts.show');
});

Route::view('about', 'about')->name('about');

Route::prefix('experiments')->group(function () {
    Route::view('/', 'experiments')->name('experiments');
    Route::view('freedom-calculator', 'experiments.freedom_calculator')->name('experiments.freedom-calculator');
    Route::view('online-meeting', 'experiments.online_meeting')->name('experiments.online-meeting');
    Route::view('online-meeting/{roomKey}', 'experiments.online_meeting_room')->name('experiments.online-meeting-room');
    Route::view('synonymizer', 'experiments.synonymizer')->name('experiments.synonymizer');
    Route::post('synonymize-text', 'ExperimentsController@synonymizeText')->name('experiments.synonymize_text');
});

Route::middleware('auth.admin')->group(function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('posts', 'PostsController', ['except' => ['index', 'show', 'create']]);
    Route::view('posts/create', 'posts.create')->name('posts.create');
});

Route::prefix('posts')->middleware('auth.reviewer')->group(function () {
    Route::get('/', 'PostsController@index')->name('posts.index');
});

Route::prefix('posts')->group(function () {
    Route::get('{id}', 'PostsController@show');
    Route::post('{id}/comment', 'PostsController@comment')->name('posts.comment');
});

Route::get('health', 'HomeController@health')->name('health');
