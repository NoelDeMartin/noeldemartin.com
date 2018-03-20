<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\Invitation;
use Illuminate\Support\MessageBag;

class HomeController extends Controller
{
    public function blog()
    {
        // TODO pagination
        $posts =
            Post::where('published_at', '<', now())
                ->orderBy('published_at', 'desc')
                ->get();

        return view('home.blog', compact('posts'));
    }

    public function rss()
    {
        $posts =
            Post::where('published_at', '<', now())
                ->orderBy('published_at', 'desc')
                ->get();

        return response()
                    ->view('posts.rss', compact('posts'))
                    ->header('Content-Type', 'application/atom+xml');
    }

    public function health()
    {
        $status = 'Everything is OK';
        try {
            if (!app('db')->connection()) {
                $status = 'MySQL is not working correctly';
            }
        } catch (Exception $e) {
            $status = 'MySQL is not working correctly';
        }

        return $status;
    }

    public function login()
    {
        auth()->logout();

        return view('home.login');
    }

    public function processLogin()
    {
        $credential = request('credential');
        $password = request('password');
        $remember = request()->get('remember', false);

        // Credentials
        if (!auth()->attempt(['email' => $credential, 'password' => $password], $remember)) {
            if (!auth()->attempt(['username' => $credential, 'password' => $password], $remember)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(new MessageBag(['email' => 'Credentials were not correct']));
            }
        }

        return redirect()->home();
    }

    public function register($token)
    {
        auth()->logout();

        $invitation = Invitation::where('token', $token)->first();

        abort_if($invitation === null, 404);

        return view('home.register', compact('invitation'));
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->home();
    }
}
