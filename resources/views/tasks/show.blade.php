@extends('layouts.master', ['header' => false])

@section('content')
    <article>

        <h1>{{ $task->name }}</h1>

        <table class="text-sm">
            <tr>
                <th class="text-right">Started:</th>
                <td>
                    {{ $task->created_at->display('date') }}
                    @if ($task->isOngoing())
                        (Ongoing)
                    @endif
                </td>
            </tr>
            @if ($task->isCompleted())
                <tr>
                    <th class="text-right">Completed:</th>
                    <td>{{ $task->completed_at->display('date') }}</td>
                </tr>
            @endif
        </table>

        @if($task->isOngoing() && auth()->check())
            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" role="form">

                @csrf
                @method('PUT')

                <button
                    type="submit"
                    class="bg-blue-dark hover:bg-blue-darker text-white font-bold py-2 px-4 rounded"
                >
                    Complete
                </button>
            </form>
        @endif

        {!! $task->description_html !!}

        <h2 class="text-xl">Activity</h2>

        <ul class="list-reset">

            <li id="comment-1" class="mb-2 border-b-1 border-grey-light p-2 overflow-hidden rounded">
                <p>Started working on it.</p>
                <time
                    class="float-right text-sm italic"
                    datetime="{{ $task->created_at->toDateTimeString() }}"
                >
                    {{ $task->created_at->display('datetime') }}
                </time>
            </li>

            @foreach ($task->comments as $i => $comment)

                <li id="comment-{{ $i+2 }}" class="mb-2 border-b-1 border-grey-light p-2 overflow-hidden rounded">
                    {!! $comment->text_html !!}
                    <time
                        class="float-right text-sm italic"
                        datetime="{{ $comment->created_at->toDateTimeString() }}"
                    >
                        {{ $comment->created_at->display('datetime') }}
                    </time>
                </li>

            @endforeach

            @if ($task->isCompleted())

                <li id="comment-{{ $task->comments->count() + 2 }}" class="mb-2 p-2 overflow-hidden rounded">
                    <p>Task completed 🎉</p>
                    <time
                        class="float-right text-sm italic"
                        datetime="{{ $task->completed_at->toDateTimeString() }}"
                    >
                        {{ $task->completed_at->display('datetime') }}
                    </time>
                </li>

            @endif

        </ul>

        @auth()
            <form action="{{ route('task-comments.store', $task->id) }}" method="POST" role="form">

                @csrf

                <div
                    data-controller="task-comment-editor"
                    data-task-editor-text="{{ old('text') }}"
                ></div>

                @foreach ($errors->all() as $error)
                    <p class="text-error my-2">{{ $error }}</p>
                @endforeach
            </form>
        @endauth

    </article>
@endsection
