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

Route::resource('users', 'UsersController', ['only' => ['store']]);

Route::group(['before' => 'auth.admin'], function (){
	Route::resource('users', 'UsersController', ['except' => ['store']]);
	Route::resource('posts', 'PostsController', ['except' => ['index', 'show']]);
	Route::resource('invitations', 'InvitationsController', ['except' => 'show', 'edit', 'update']);
});

Route::group(['before' => 'auth.reviewer'], function (){
	Route::resource('posts', 'PostsController', ['only' => ['index', 'show']]);
});
