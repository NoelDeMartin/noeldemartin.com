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

Route::get('/', 'HomeController@about')->name('home');
Route::get('about', 'HomeController@about')->name('about');
Route::get('now', 'HomeController@now')->name('now');

Route::get('sitemap.xml', 'HomeController@sitemap')->name('sitemap');

Route::view('login', 'auth.login')->middleware('semantic-seo:hide');
Route::post('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::prefix('blog')->group(function () {
    Route::get('/', 'HomeController@blog')->name('blog');
    Route::get('rss.xml', 'HomeController@rss')->name('blog.rss');
    Route::get('{idOrTag}', 'PostsController@show')->name('posts.show');
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

    Route::middleware(['auth.admin', 'semantic-seo:hide'])->group(function () {
        Route::view('create', 'tasks.create')->name('tasks.create');
        Route::post('/', 'TasksController@store')->name('tasks.store');

        Route::put('{task}/complete', 'TasksController@complete')->name('tasks.complete');

        Route::post('{task}/comment', 'TaskCommentsController@store')->name('task-comments.store');
    });

    Route::get('{slug}', 'TasksController@show')->name('tasks.show');
});

Route::middleware(['auth.admin', 'semantic-seo:hide'])->group(function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('posts', 'PostsController', ['except' => ['index', 'show', 'create']]);
    Route::view('posts/create', 'posts.create')->name('posts.create');
});

Route::prefix('posts')->middleware(['auth.reviewer', 'semantic-seo:hide'])->group(function () {
    Route::get('/', 'PostsController@index')->name('posts.index');
});

Route::prefix('posts')->middleware('semantic-seo:hide')->group(function () {
    Route::get('{id}', 'PostsController@show');
    Route::post('{id}/comment', 'PostsController@comment')->name('posts.comment');
});

Route::get('health', 'HomeController@health')->name('health');
