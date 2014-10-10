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

Route::get('/', 		['uses' => 'HomeController@index',			'as' => 'home']);
Route::get('/login',	['uses' => 'HomeController@login',			'as' => 'login']);
Route::post('/login',	['uses' => 'HomeController@processLogin',	'as' => 'process_login']);
Route::get('/logout',   ['uses' => 'HomeController@logout', 		'as' => 'logout']);

Route::group(['before' => 'auth.admin'], function (){
	Route::resource('users', 'UsersController');
	Route::resource('posts', 'PostsController', ['except' => ['index', 'show']]);
});

Route::group(['before' => 'auth.reviewer'], function (){
	Route::resource('posts', 'PostsController', ['only' => ['index', 'show']]);
});
