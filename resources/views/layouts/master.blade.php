<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>@yield('title', 'Noel De Martin')</title>

        @stack('meta')

        <meta name="pocket-site-verification" content="a7da21e29497dd96109d3eaf4d2529">
        <meta name="description" content="Noel De Martin's personal website">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">

        <script type="text/javascript" src="{{ mix('js/main.js') }}" async></script>

        @stack('head')

    </head>

    <body class="bg-white pt-12 lg:pt-0">

        @php

            $sections = [
                (object) [
                    'route' => 'blog',
                    'icon'  => 'blog',
                    'text'  => 'Blog'
                ],
                (object) [
                    'route' => 'about',
                    'icon'  => 'about',
                    'text'  => 'About me'
                ],
                (object) [
                    'route' => 'experiments',
                    'icon'  => 'experiments',
                    'text'  => 'Experiments'
                ],
            ];

            $socials = [
                (object) [
                    'url'  => 'https://lincolnschilli.com',
                    'icon' => 'lincolnschilli',
                    'name' => "Lincoln's Chilli",
                ],
                (object) [
                    'url'  => 'https://twitter.com/NoelDeMartin',
                    'icon' => 'twitter',
                    'name' => 'My Twitter',
                ],
                (object) [
                    'url'  => 'https://github.com/NoelDeMartin',
                    'icon' => 'github',
                    'name' => 'My Github',
                ],
                (object) [
                    'url'  => 'https://www.linkedin.com/in/noeldemartin',
                    'icon' => 'linkedin',
                    'name' => 'My Linkedin',
                ],
                (object) [
                    'url'  => 'mailto:noeldemartin@gmail.com',
                    'icon' => 'gmail',
                    'name' => 'My Email',
                ],
            ];

        @endphp

        @include('layouts.navigation.desktop', compact('sections', 'socials'))

        @include('layouts.navigation.mobile', compact('sections', 'socials'))

        <main class="max-w-content mx-auto px-4 py-8">

            @if (session()->has('message'))
                <div class="alert mb-4" role="alert">
                    <p>{!! session('message') !!}</p>
                </div>
            @endif

            @yield('content')

        </main>

    </body>

</html>
