@extends('layouts.master')

@section('content')

	@foreach ($posts as $post)
		<article class="mb-4 pb-2 border-grey-lightest border-b-1">
			<h1>
				<a
					href="{{ route('posts.show', $post->tag) }}"
					class="text-blue-darkest text-3xl"
				>
					{{ $post->title }}
				</a>
			</h1>
			<div class="my-2 post-body">
				{!! $post->summary !!}
			</div>
			<p class="flex justify-between">
				<a href="{!! route('posts.show', [$post->tag]) !!}" class="text-sm text-grey-darker">
					Read more...
				</a>
				<time class="font-normal text-grey-dark text-xs">
					{{ $post->published_at->toFormattedDateString() }}
				</time>
			</p>
		</article>
	@endforeach

	<div class="alert mt-4">
		<p>@icon('rss', 'h-4 fill-current') You can add <a href="{!! route('blog.rss') !!}">this</a> to your rss feed to keep up to date.</p>
	</div>

@stop
