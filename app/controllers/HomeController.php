<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		if (Auth::check()) {
			$user = Auth::user();
			if ($user->isAdmin()) {
				return View::make('home.index');
			} else if ($user->isReviewer()) {
				return Redirect::route('posts.index');
			}
		}
		return View::make('home.under_construction');
	}

	public function login()
	{
		return View::make('home.login');
	}

	public function processLogin()
	{
		$credential = Input::get('credential');
		$password = Input::get('password');
		$remember = Input::get('remember', false);

		// Credentials
		if (!Auth::attempt(['email' => $credential, 'password' => $password], $remember)) {
			if (!Auth::attempt(['username' => $credential, 'password' => $password], $remember)) {
				return Redirect::back()
							->withInput()
							->withErrors(new Illuminate\Support\MessageBag(['email' => 'Credentials were not correct']));
			}
		}

		return Redirect::home();
	}

	public function logout() {
		Auth::logout();
		return Redirect::home();
	}

}
