@extends('layouts.master', ['minimal' => true])

@push('head')
    <link rel="stylesheet" href="{{ mix('css/code-highlighter.css') }}">
@endpush

@section('content')
    <article data-controller="code-highlighter blog-post" class="blog-post">

        <div class="max-w-readable overflow-hidden">

            <h1>{{ $post->title }}</h1>

            <div class="flex mb-4">

                <time
                    class="flex items-center text-blue-darker font-normal text-xs"
                    datetime="{{ $post->published_at->toDateTimeString() }}"
                >
                    @icon('calendar', 'h-4 fill-current')
                    <span class="ml-1">{{ $post->published_at->toFormattedDateString() }}</span>
                </time>

                <time
                    class="flex items-center text-blue-darker font-normal text-xs ml-2"
                    datetime="{{ $post->duration }}M"
                >
                    @icon('timer', 'h-4 fill-current')
                    <span class="ml-1">{{ $post->duration }} min.</span>
                </time>

            </div>

            {!! $post->text_html !!}

        </div>

        @if(!empty($post->landmarks))

            <aside
                data-target="blog-post.tableOfContents"
                data-turbolinks="false"
                class="fixed left-0 inset-y-0 overflow-y-auto z-40 bg-white shadow-md px-8 pt-4 transform -translate-x-full transition-transform duration-200"
            >
                <nav aria-label="Table of contents" class="blog-post--toc-menu">
                    <a
                        href="#main"
                        class="font-semibold text-blue-darkest mb-3 block text-lg"
                        aria-hidden="true"
                        data-action="click->blog-post#toggleTableOfContents"
                    >
                        {{ $post->title }}
                    </a>

                    @tableofcontents(['landmarks' => $post->landmarks])
                    @endtableofcontents
                </nav>
            </aside>

            <button
                type="button"
                class="blog-post--toc-button group fixed top-0 mr-4 mt-4 w-12 h-12 flex items-center justify-center md:mt-16 md:w-8 md:h-8"
                style="right: calc(max(0px, (100vw - 900px) / 2))"
                data-action="click->blog-post#toggleTableOfContents"
            >
                <div class="absolute inset-0 bg-grey-light rounded-full hidden group-hover:block"></div>
                <div class="blog-post--progress absolute inset-0 rounded-full p-1 md:p-.5">
                    <div class="w-full h-full bg-white rounded-full group-hover:bg-grey-light"></div>
                </div>

                @icon('list-bullet', 'relative w-6 h-6 md:w-5 md:h-5')
            </button>

        @endif

    </article>

    <div class="my-8 text-left md:text-right">
        <a href="{{ route('blog') }}">
            Read more posts →
        </a>
    </div>
@endsection
