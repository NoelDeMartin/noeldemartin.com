@extends('layouts.master')

@section('content')
    <h1 class="flex items-center justify-between">
        Posts
        <a
            href="{{ route('posts.create') }}"
            class="tracking-normal bg-blue-dark text-white text-base font-bold py-2 px-4 rounded hover:bg-blue-darker hover:text-white"
        >
            Write new post
        </a>
    </h1>

    <table class="table">

        <thead>

            <tr>

                <th>Title</th>

                @if (auth()->check() && auth()->user()->is_admin)
                    <th></th>
                @endif

                <th>Publication Date</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($posts as $post)
                <tr>

                    <td>
                        <a href="{{ route('posts.show', [$post->tag]) }}">
                            {{ $post->title }}
                        </a>
                    </td>

                    @if (auth()->check() && auth()->user()->is_admin)
                        <td><a href="{{ route('posts.edit', [$post->id]) }}">edit</a></td>
                    @endif

                    <td>
                        @if ($post->isPublished())
                            {{ $post->published_at->toFormattedDateString() }}
                        @else
                            {{ $post->published_at->toFormattedDateString() }} (Not Published)
                        @endif
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
@endsection
