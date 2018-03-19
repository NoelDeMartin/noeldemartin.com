@inject('router', 'Illuminate\Routing\Router')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        @if ($router->is('posts.show') && isset($post))
            <title>{{ $post->title }} | Noel De Martin</title>
            @include('assets.post_meta', $post)
        @else
            <title>Noel De Martin</title>
        @endif

        <meta name="pocket-site-verification" content="a7da21e29497dd96109d3eaf4d2529">
        <meta name="description" content="Noel De Martin's personal website">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">

        @yield('styles')
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

        @include('layouts.desktop-navigation', compact('sections', 'socials'))

        @include('layouts.mobile-navigation', compact('sections', 'socials'))

        <main class="max-w-content mx-auto px-4 py-8">
            @if (session()->has('message'))
                <div class="alert" role="alert">
                    <p>{!! session('message') !!}</p>
                </div>
            @endif
            @yield('content')
        </main>

        <!-- JQuery and Bootstrap with fallbacks - http://eddmann.com/posts/providing-local-js-and-css-resources-for-cdn-fallbacks/ -->
        <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>window.jQuery.fn.modal || document.write('<script src="js/bootstrap.min.js"><\/script>')</script>

        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

        @yield('scripts')
    </body>
</html>
