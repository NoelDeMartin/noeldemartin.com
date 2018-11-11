@extends('layouts.master')

@section('content')
    <h1>Create Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST" role="form">

        @csrf

        <div
            data-controller="task-editor"
            data-task-editor-name="{{ old('name') }}"
            data-task-editor-description="{{ old('description_markdown') }}"
        ></div>

        @foreach ($errors->all() as $error)
            <p class="text-error my-2">{{ $error }}</p>
        @endforeach

    </form>
@endsection
