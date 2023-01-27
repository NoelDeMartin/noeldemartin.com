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

Route::get('sitemap.xml', 'HomeController@sitemap')->name('sitemap');

Route::prefix('blog')->group(function () {
    Route::get('/', 'HomeController@blog')->name('blog');
    Route::get('rss.xml', 'HomeController@blogRss')->name('blog.rss');
    Route::get('{tag}', 'PostsController@show')->name('posts.show');
});

Route::prefix('now')->group(function () {
    Route::get('/', 'HomeController@now')->name('now');
    Route::get('rss.xml', 'HomeController@nowRss')->name('now.rss');
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
    Route::redirect('attending-laracon-us', 'attending-laracon-eu');
    Route::get('/', 'TasksController@index')->name('tasks.index');
    Route::get('{slug}', 'TasksController@show')->name('tasks.show');
});

Route::get('recipes/{slug}', 'RecipesController@show')->name('recipes.show');

Route::get('site', 'HomeController@site')->name('site');
Route::get('moodlenet', 'HomeController@moodlenet')->name('moodlenet');

Route::prefix('projects')->group(function () {
    Route::get('/', 'ProjectsController@index')->name('projects.index');
    Route::get('{slug}', 'ProjectsController@show')->name('projects.show');
});

Route::get('health', 'HomeController@health')->name('health');

Route::redirect('solid-world', 'https://speakerdeck.com/noeldemartin/media-kraken-at-solid-world');
Route::redirect('fosdem', 'https://fosdem.org/2023/schedule/event/sovcloud_from_zero_to_hero_with_solid/');
Route::permanentRedirect('about', '/');
Route::permanentRedirect('posts/{tag?}', '/blog/{tag}');
