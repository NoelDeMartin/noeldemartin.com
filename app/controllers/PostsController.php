<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of posts
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check() && (Auth::user()->is_reviewer || Auth::user()->is_admin)) {
			$posts = Post::orderBy('published_at', 'desc')
							->get();
		} else {
			$posts = Post::where('published_at', '<', Carbon\Carbon::now())
							->orderBy('published_at', 'desc')
							->get();
		}

		return View::make('posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new post
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}

	/**
	 * Store a newly created post in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// Create Post
		// TODO: html should be scaped or something (do we trust the view?)...
		$post = new Post($data);
		$post->tag = Post::createTitleTag($data['title']);
		$post->author_id = 1; // TODO user session
		$post->published_at = Carbon\Carbon::createFromFormat(Post::DATE_FORMAT, $data['published_at'])->toDateTimeString();
		$post->save();

		return Redirect::route('posts.index');
	}

	/**
	 * Display the specified post.
	 *
	 * @param  int|string  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(is_numeric($id)) {
			$post = Post::with('comments')->findOrFail($id);
		} else {
			$post = Post::with('comments')->where('tag', $id)->firstOrFail();
		}

		if (!$post->isPublished() && (!Auth::check() || !Auth::user()->is_reviewer)) {
			App::abort(404);
		}

		return View::make('posts.show', compact('post'));
	}

	/**
	 * Add a new comment to a post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function comment($id) {

		$post = Post::findOrFail($id);
		$validator = Validator::make($data = Input::all(), PostComment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$comment = new PostComment($data);
		if (strlen(trim($data['author'])) == 0) {
			$comment->author = 'Anonymous';
		}
		if (strlen(trim($data['author_link'])) == 0) {
			unset($comment->author_link);
		}
		$comment->post_id = $post->id;
		$comment->save();

		// Send Email
		Mail::send('emails.post_comment', ['post' => $post, 'comment' => $comment], function($message) use($post) {
			$message->to('noeldemartin@gmail.com')->subject('New comment in post ' . $post->title);
		});

		return Redirect::route('posts.show', $post->tag);
	}

	/**
	 * Show the form for editing the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);

		return View::make('posts.edit', compact('post'));
	}

	/**
	 * Update the specified post in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$post = Post::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$post->update($data);

		return Redirect::route('posts.index');
	}

	/**
	 * Remove the specified post from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Post::destroy($id);

		return Redirect::route('posts.index');
	}

}
