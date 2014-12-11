<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 				['uses' => 'HomeController@index',			'as' => 'home']);
Route::get('/login',			['uses' => 'HomeController@login',			'as' => 'login']);
Route::post('/login',			['uses' => 'HomeController@processLogin',	'as' => 'process_login']);
Route::get('/register/{token}',	['uses' => 'HomeController@register',		'as' => 'register']);
Route::get('/logout',			['uses' => 'HomeController@logout', 		'as' => 'logout']);
Route::get('/blog',				['uses' => 'HomeController@blog',			'as' => 'blog']);
Route::get('/blog/rss.xml',		['uses' => 'HomeController@rss',			'as' => 'blog.rss']);
Route::get('/about',			['uses' => 'HomeController@about',			'as' => 'about']);
Route::get('/experiments',		['uses' => 'HomeController@experiments',	'as' => 'experiments']);

Route::resource('users', 'UsersController', ['only' => ['store']]);

Route::group(['before' => 'auth.admin'], function() {
	Route::resource('users', 'UsersController', ['except' => ['store']]);
	Route::resource('posts', 'PostsController', ['except' => ['index', 'show']]);
	Route::resource('invitations', 'InvitationsController', ['except' => 'show', 'edit', 'update']);
});

Route::group(['before' => 'auth.reviewer'], function() {
	Route::resource('posts', 'PostsController', ['only' => ['index']]);
});

Route::post('/posts/{id}/comment', ['uses' => 'PostsController@comment', 'as' => 'posts.comment']);
Route::resource('posts', 'PostsController', ['only' => ['show']]);
Route::get('/blog/{id}', ['uses' => 'PostsController@show', 'as' => 'blog.show']);

Route::group(['prefix' => 'experiments'], function() {
	Route::get('freedom-calculator', ['uses' => 'ExperimentsController@freedomCalculator', 'as' => 'experiments.freedom-calculator']);
});

if (!Config::get('app.debug')) {
	App::error(function($exception) {
		$controller = App::make('HomeController');
		if ($exception instanceof Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
			return $controller->notFound();
		} else {
			return $controller->error();
		}
	});
}
