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

Route::get('/', 'HomeController@index')->name('home');
Route::get('now', 'HomeController@now')->name('now');

Route::get('sitemap.xml', 'HomeController@sitemap')->name('sitemap');

Route::view('login', 'auth.login')->middleware('semantic-seo:hide');
Route::post('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::prefix('blog')->group(function () {
    Route::get('/', 'HomeController@blog')->name('blog');
    Route::get('rss.xml', 'HomeController@rss')->name('blog.rss');
    Route::get('{tag}', 'PostsController@show')->name('posts.show');
});

Route::prefix('experiments')->group(function () {
    Route::get('/', 'HomeController@experiments')->name('experiments');
    Route::get('freedom-calculator', 'ExperimentsController@freedomCalculator')->name('experiments.freedom-calculator');
    Route::get('online-meeting', 'ExperimentsController@onlineMeeting')->name('experiments.online-meeting');
    Route::view('online-meeting/{roomKey}', 'experiments.online_meeting_room')
        ->name('experiments.online-meeting-room')
        ->middleware('semantic-seo:hide');
    Route::get('synonymizer', 'ExperimentsController@synonymizer')->name('experiments.synonymizer');
    Route::post('synonymize-text', 'ExperimentsController@synonymizeText')->name('experiments.synonymize_text');
});

Route::prefix('tasks')->group(function () {
    Route::get('/', 'TasksController@index')->name('tasks.index');
    Route::get('{slug}', 'TasksController@show')->name('tasks.show');
});

Route::get('site', 'HomeController@site')->name('site');

Route::get('health', 'HomeController@health')->name('health');

Route::permanentRedirect('about', '/');
Route::permanentRedirect('posts/{tag?}', '/blog/{tag}');
