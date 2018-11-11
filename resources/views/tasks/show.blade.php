@extends('layouts.master', ['header' => false])

@section('content')
    <article>

        <h1>{{ $task->name }}</h1>

        <table>
            <tr>
                <th>Started:</th>
                <td>
                    {{ $task->created_at->display('date') }}
                    @if ($task->isOngoing())
                        (Ongoing)
                    @endif
                </td>
            </tr>
            @if ($task->isCompleted())
                <tr>
                    <th>Completed:</th>
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

        <hr>

        <ul class="list-reset">

            <li class="mb-2 bg-grey-lighter p-2 overflow-hidden">
                <p>Task created</p>
                <time
                    class="float-right text-sm italic mt-4"
                    datetime="{{ $task->created_at->toDateTimeString() }}"
                >
                    {{ $task->created_at->display('datetime') }}
                </time>
            </li>

            @foreach ($task->comments as $comment)

                <li class="mb-2 bg-grey-lighter p-2 overflow-hidden">
                    {!! $comment->text_html !!}
                    <time
                        class="float-right text-sm italic mt-4"
                        datetime="{{ $comment->created_at->toDateTimeString() }}"
                    >
                        {{ $comment->created_at->display('datetime') }}
                    </time>
                </li>

            @endforeach

            @if ($task->isCompleted())

                <li class="mb-2 bg-grey-lighter p-2 overflow-hidden">
                    <p>Task completed</p>
                    <time
                        class="float-right text-sm italic mt-4"
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
