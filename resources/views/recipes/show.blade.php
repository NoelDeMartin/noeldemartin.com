@extends('layouts.base')

@push('head')
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
@endpush

@section('content')
    <main>
        <article class="max-w-readable mx-auto p-4">
            {!! $recipeHtml !!}
        </article>
    </main>
@endsection
