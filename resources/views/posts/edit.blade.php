@extends('layouts.master')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" role="form">

        @csrf
        @method('put')

        <div
            data-controller="post-editor"
            data-post-editor-title="{{ old('title', $post->title) }}"
            data-post-editor-text="{{ old('text_markdown', $post->text_markdown) }}"
            data-post-editor-date="{{ old('published_at', $post->published_at->toW3cString()) }}"
        ></div>

        @foreach ($errors->all() as $error)
            <p class="text-error my-2">{{ $error }}</p>
        @endforeach

    </form>
@endsection
