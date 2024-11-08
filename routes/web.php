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
    Route::get('style.xsl', 'HomeController@blogXsl')->name('blog.xsl');
    Route::get('{tag}', 'PostsController@show')->name('posts.show');
});

Route::prefix('now')->group(function () {
    Route::get('/', 'HomeController@now')->name('now');
    Route::get('rss.xml', 'HomeController@nowRss')->name('now.rss');
    Route::get('style.xsl', 'HomeController@nowXsl')->name('now.xsl');
});

Route::prefix('experiments')->group(function () {
    Route::get('/', 'HomeController@experiments')->name('experiments');
    Route::get('online-meeting', 'ExperimentsController@onlineMeeting')->name('experiments.online-meeting');
    Route::view('online-meeting/{roomKey}', 'experiments.online_meeting_room')
        ->name('experiments.online-meeting-room')
        ->middleware('semantic-seo:hide');
    Route::get('synonymizer', 'ExperimentsController@synonymizer')->name('experiments.synonymizer');
    Route::post('synonymize-text', 'ExperimentsController@synonymizeText')->name('experiments.synonymize_text');

    Route::permanentRedirect('freedom-calculator', 'https://freedom-calculator.noeldemartin.com')->name('experiments.freedom-calculator');
});

Route::prefix('tasks')->group(function () {
    Route::redirect('attending-laracon-us', 'attending-laracon-eu');
    Route::get('/', 'TasksController@index')->name('tasks.index');
    Route::get('{slug}', 'TasksController@show')->name('tasks.show');
});

Route::get('recipes/{slug}', 'RecipesController@show')->name('recipes.show');

Route::get('talks', 'HomeController@talks')->name('talks');
Route::get('japan-tips', 'HomeController@japanTips')->name('japan-tips');
Route::get('site', 'HomeController@site')->name('site');
Route::get('moodlenet', 'HomeController@moodlenet')->name('moodlenet');

Route::prefix('projects')->group(function () {
    Route::get('/', 'ProjectsController@index')->name('projects.index');
    Route::get('{slug}', 'ProjectsController@show')->name('projects.show');
});

Route::prefix('podcast')->group(function () {
    Route::get('/', 'PodcastController@index')->name('podcast.index');
    Route::get('feed.xml', 'PodcastController@feed')->name('podcast.feed');
    Route::get('style.xls', 'PodcastController@style')->name('podcast.style');
});

Route::get('health', 'HomeController@health')->name('health');

Route::redirect('solid-world', 'https://www.youtube.com/watch?v=cajBTJXmKhA');
Route::redirect('fosdem', 'https://www.youtube.com/watch?v=kPzhykRVDuI');
Route::redirect('solid-symposium-dx', 'https://www.youtube.com/watch?v=ghGmveKKe5Y');
Route::redirect('solid-symposium-crdts', 'https://www.youtube.com/watch?v=vYQmGeaQt8E');
Route::permanentRedirect('about', '/');
Route::permanentRedirect('posts/{tag?}', '/blog/{tag}');
