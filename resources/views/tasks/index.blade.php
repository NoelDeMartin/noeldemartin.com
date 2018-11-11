@extends('layouts.master')

@section('content')
    <article>

        <h1>All Tasks</h1>

        <ul>

            @foreach ($tasks as $task)

                <li>
                    <a href="{{ $task->url }}">{{ $task->name }}</a>
                </li>

            @endforeach

        </ul>

    </article>
@endsection
