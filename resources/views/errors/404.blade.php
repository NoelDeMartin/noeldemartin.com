@extends('layouts.master')

@push('head')
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
@endpush

@section('content')
    <div class="fixed inset-0 mt-12 flex items-center justify-center">
        <a href="https://xkcd.com/1969/" alt="Not Found" target="_blank">
            <img
                class="max-w-full max-h-full"
                src="https://imgs.xkcd.com/comics/not_available.png"
                alt="Not Found XKCD webcomic"
                title="Not Found"
            >
        </a>
    </div>
@endsection
