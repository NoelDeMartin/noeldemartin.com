@extends('layout')

@section('main')
    <h1 class="sr-only">Blog</h1>

    <statamic:collection :from="$mount">
        <x-content-card :$title :$url :date="$publication_date">
            {!! $summary !!}
        </x-content-card>
    </statamic:collection>
@endsection
