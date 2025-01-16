@extends('layout')

@section('main')
    <h1 class="sr-only">Blog</h1>

    <s:collection :from="$mount" sort="publication_date:desc">
        <x-content-card :$title :$url :date="$publication_date">
            {!! $summary !!}
        </x-content-card>
    </s:collection>
@endsection
