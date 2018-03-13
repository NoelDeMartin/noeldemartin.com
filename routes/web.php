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

Route::redirect('/', 'blog')->name('home');
Route::get('login', 'HomeController@login')->name('login');
Route::post('login', 'HomeController@processLogin')->name('process_login');
Route::get('register/{token}', 'HomeController@register')->name('register');
Route::get('logout', 'HomeController@logout')->name('logout');

Route::prefix('blog')->group(function() {
    Route::get('/', 'HomeController@blog')->name('blog');
    Route::get('rss.xml', 'HomeController@rss')->name('blog.rss');
});

Route::resource('users', 'UsersController', ['only' => ['store']]);

Route::group(['middleware' => 'auth.admin'], function() {
    Route::resource('users', 'UsersController', ['except' => ['store']]);
    Route::resource('posts', 'PostsController', ['except' => ['index', 'show']]);
    Route::resource('invitations', 'InvitationsController', ['except' => 'show', 'edit', 'update']);
});

Route::prefix('posts')->group(function() {
    Route::get('/', 'PostsController@index')->middleware('auth.reviewer')->name('posts.index');
    Route::get('{id}', 'PostsController@show')->name('posts.show');
    Route::post('{id}/comment', 'PostsController@comment')->name('posts.comment');
});

Route::view('about', 'home.about')->name('about');

Route::prefix('experiments')->group(function() {
    Route::view('/', 'home.experiments')->name('experiments');
    Route::get('freedom-calculator', 'ExperimentsController@freedomCalculator')->name('experiments.freedom-calculator');
    Route::get('online-meeting', 'ExperimentsController@onlineMeeting')->name('experiments.online-meeting');
    Route::get('online-meeting/{roomKey}', 'ExperimentsController@onlineMeetingRoom')->name('experiments.online-meeting-room');
    Route::get('synonymizer', 'ExperimentsController@synonymizer')->name('experiments.synonymizer');
    Route::post('synonymize-text', 'ExperimentsController@synonymizeText')->name('experiments.synonymize_text');
});

Route::get('health', 'HomeController@health')->name('health');
