<?php

namespace App\Http\Controllers;

use Mail;
use Validator;
use App\Models\Post;
use App\SemanticSEO\Logo;
use App\Models\PostComment;
use Illuminate\Support\Carbon;
use App\SemanticSEO\NoelDeMartin;
use App\Http\Requests\PostRequest;
use App\SemanticSEO\NoelDeMartinOrganization;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class PostsController extends Controller
{
    public function index()
    {
        if (auth()->check() && (auth()->user()->is_reviewer || auth()->user()->is_admin)) {
            $posts = Post::orderBy('published_at', 'desc')
                ->get();
        } else {
            $posts = Post::where('published_at', '<', Carbon::now())
                ->orderBy('published_at', 'desc')
                ->get();
        }

        return view('posts.index', compact('posts'));
    }

    public function show($idOrTag)
    {
        if (is_numeric($idOrTag)) {
            $post = Post::with('comments')->findOrFail($idOrTag);
        } else {
            $post = Post::with('comments')->where('tag', $idOrTag)->first();
        }

        if (
            $post === null ||
            (!$post->isPublished() && (!auth()->check() || !(auth()->user()->is_reviewer || auth()->user()->is_admin)))
        ) {
            abort(404);
        }

        SemanticSEO::canonical(route('posts.show', $post->tag));

        SemanticSEO::article()
            ->name($post->title)
            ->headline($post->title)
            ->description($post->summary)
            ->image(is_null($post->image_url) ? Logo::class : $post->image_url)
            ->wordCount($post->word_count)
            ->articleSection('Blog')
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->mainEntityOfPage(route('home'))
            ->datePublished($post->published_at)
            ->dateCreated($post->published_at)
            ->dateModified(max($post->published_at, $post->updated_at));

        return view('posts.show', compact('post'));
    }

    public function comment($id)
    {
        $post = Post::findOrFail($id);
        $validator = Validator::make($data = request()->all(), PostComment::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $author = trim($data['author']);
        $author_link = trim($data['author_link']);

        $comment = new PostComment($data);
        if (strlen($author) === 0) {
            $comment->author = 'Anonymous';
        }
        if (strlen($author_link) === 0) {
            unset($comment->author_link);
        } elseif (filter_var($author_link, FILTER_VALIDATE_EMAIL) !== false) {
            $comment->author_link = 'mailto:' . $author_link;
        }
        $comment->post_id = $post->id;
        $comment->save();

        // Send Email
        Mail::send('emails.post_comment', ['post' => $post, 'comment' => $comment], function ($message) use ($post) {
            $message->to('noeldemartin@gmail.com')->subject('New comment in post ' . $post->title);
        });

        return redirect()->route('posts.show', $post->tag);
    }

    public function store(PostRequest $request)
    {
        Post::create([
            'tag'           => Post::createTitleTag(request('title')),
            'title'         => request('title'),
            'text_html'     => request('text_html'),
            'text_markdown' => request('text_markdown'),
            'author_id'     => auth()->id(),
            'published_at'  => Carbon::parse(request('published_at')),
        ]);

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->update([
            'title'         => request('title'),
            'text_html'     => request('text_html'),
            'text_markdown' => request('text_markdown'),
            'published_at'  => Carbon::parse(request('published_at')),
        ]);

        session()->flash('message', 'The post was updated correctly');

        return redirect()->route('posts.index');
    }
}
