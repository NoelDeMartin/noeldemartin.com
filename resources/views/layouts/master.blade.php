@extends('layouts.base')

@push('head')

    <meta name="pocket-site-verification" content="a7da21e29497dd96109d3eaf4d2529">

    <meta name="turbolinks-cache-control" content="no-preview">

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">

    <script src="{{ mix('js/main.js') }}" async></script>

@endpush

@section('body-class', 'bg-white')

@section('content')

    @include('components.header')

    <main class="max-w-content mx-auto p-4 pt-8">

        @if (session()->has('message'))
            <div class="alert mb-4" role="alert">
                <p>{!! session('message') !!}</p>
            </div>
        @endif

        @yield('content')

    </main>

    <!-- Sites Verification -->

    <div class="hidden">
        <a rel="me" href="https://community.thoughtshrapnel.com/@noeldemartin">
            Thought Shrapnel Mastodon
        </a>
    </div>

@overwrite
