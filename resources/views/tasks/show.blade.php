@extends('layouts.master', ['minimal' => true])

@push('head')
    <link rel="stylesheet" href="{{ mix('css/code-highlighter.css') }}">
@endpush

@section('content')
    <article class="max-w-readable" data-controller="code-highlighter">

        <h1>{{ $task->name }}</h1>

        <div class="flex items-center text-blue-darker font-normal text-xs">
            @icon('calendar', 'h-4 mr-2 fill-current')
            <time
                class="mr-2"
                datetime="{{ $task->created_at->toDateTimeString() }}"
            >
                {{ $task->created_at->display('date') }}
            </time>
            @if ($task->isOngoing())
                <span>(Ongoing)</span>
            @else
                <span class="mr-2">–</span>
                <time datetime="{{ $task->completed_at->toDateTimeString() }}">
                    {{ $task->completed_at->display('date') }}
                </time>
            @endif
        </div>

        {!! $task->description_html !!}

        <hr class="w-full mt-2 bg-grey-lighter hidden md:block">

        <h2 class="text-xl mb-6">Activity</h2>

        @foreach ($task->display_comments as $comment)

            @comment([
                'date' => $comment->created_at,
                'short' => !$comment->exists,
                'attributes' => [
                    'id' => 'comment-' . ($loop->index + 1),
                ],
            ])
                {!! $comment->text_html !!}
            @endcomment

        @endforeach

        @if(!empty($task->landmarks))

            <div class="table-of-contents" data-controller="table-of-contents" data-turbolinks="false">

                <aside
                    data-target="table-of-contents.menu"
                    class="
                        fixed left-0 inset-y-0 overflow-y-auto z-40 bg-white shadow-md px-8 pt-4
                        transform -translate-x-full transition-transform duration-200
                        w-screen md:w-auto
                    "
                >
                    <button
                        type="button"
                        aria-label="Close"
                        data-action="click->table-of-contents#toggleMenu"
                        class="absolute right-0 top-0 mt-5 mr-4 md:hidden"
                    >
                        @icon('close', 'w-4 h-4')
                    </button>
                    <nav aria-label="Table of contents" class="table-of-contents--menu">
                        <a
                            href="#main"
                            class="font-semibold text-blue-darkest mb-3 block text-lg pr-2 md:pr-0"
                            aria-hidden="true"
                            data-action="click->table-of-contents#toggleMenu"
                        >
                            {{ $task->name }}
                        </a>

                        @tableofcontents(['landmarks' => $task->landmarks])
                        @endtableofcontents
                    </nav>
                </aside>

                <div
                    data-target="table-of-contents.overlay"
                    class="bg-overlay-dark fixed inset-0 z-10 hidden transition-opacity duration-300 opacity-0"
                    data-action="click->table-of-contents#toggleMenu"
                ></div>

                <button
                    type="button"
                    class="table-of-contents--button group fixed top-0 mr-4 mt-4 w-12 h-12 flex items-center justify-center md:mt-16 md:w-8 md:h-8"
                    style="right: calc(max(0px, (100vw - 900px) / 2))"
                    data-action="click->table-of-contents#toggleMenu"
                >
                    <div class="absolute inset-0 bg-grey-light rounded-full hidden group-hover:block"></div>
                    <div class="table-of-contents--progress absolute inset-0 rounded-full p-1 md:p-125rem">
                        <div class="w-full h-full bg-white rounded-full group-hover:bg-grey-light"></div>
                    </div>

                    @icon('list-bullet', 'relative w-6 h-6 md:w-5 md:h-5')
                </button>

            </div>

        @endif

    </article>
@endsection
