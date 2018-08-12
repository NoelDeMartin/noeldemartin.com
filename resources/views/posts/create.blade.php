@extends('layouts.master')

@section('content')
    <h1>Create Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" role="form">

        @csrf

        <div
            data-controller="post-editor"
            data-post-editor-title="{{ old('title') }}"
            data-post-editor-text="{{ old('text_markdown') }}"
            data-post-editor-date="{{ old('published_at') }}"
        ></div>

        @foreach ($errors->all() as $error)
            <p class="text-error my-2">{{ $error }}</p>
        @endforeach

    </form>
@endsection
