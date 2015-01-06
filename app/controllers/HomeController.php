<?php

class HomeController extends BaseController {

	public function index() {
		return Redirect::to('blog');
	}

	public function blog() {
		$posts = Post::where('published_at', '<', Carbon\Carbon::now())
							->orderBy('published_at', 'desc')
							->get();
		return View::make('home.blog', compact('posts'));
	}

	public function rss() {
		$posts = Post::where('published_at', '<', Carbon\Carbon::now())
						->orderBy('published_at', 'desc')
						->get();
		$view = View::make('posts.rss', compact('posts'));
		$response = Response::make($view);
		$response->header('Content-Type', 'application/atom+xml');
		return $response;
	}

	public function error() {
		return View::make('home.error');
	}

	public function notFound() {
		return View::make('home.404');
	}

	public function about() {
		return View::make('home.about');
	}

	public function experiments() {
		return View::make('home.experiments');
	}

	public function login() {
		Auth::logout();
		return View::make('home.login');
	}

	public function processLogin() {
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

	public function register($token) {
		Auth::logout();

		$invitation = Invitation::where('token', $token)->first();
		if ($invitation == null) {
			App::abort(404);
		}

		return View::make('home.register', compact('invitation'));
	}

	public function logout() {
		Auth::logout();
		return Redirect::home();
	}

}
