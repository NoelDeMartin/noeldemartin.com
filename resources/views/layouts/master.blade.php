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

    <body class="bg-white">

        <header
            style="background-color: #b8e0df"
            @class(
                'w-full pb-12',
                [
                    'h-32 md:h-44 lg:h-60' => ! $router->is('posts.show'),
                    'h-12'                 =>   $router->is('posts.show'),
                ]
            )
        >

            <div class="container h-full overflow-hidden mx-auto flex items-center justify-start">
                <img
                    src="/img/myface.png"
                    alt="My Face"
                    class="h-48 ml-4 mt-4 md:h-64 md:mt-6 lg:h-76 lg:mt-8"
                />
                <h1 class="font-comic font-medium text-4xl ml-4 md:text-5xl md:ml-10 lg:ml-12 lg:text-7xl">NOEL<br>DE MARTIN</h1>
            </div>

            <nav class="h-12 bg-overlay">

                <div class="max-w-content h-full mx-auto flex justify-between">

                    <!-- Sections -->

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
                    @endphp

                    <ul class="list-reset flex">

                        @foreach ($sections as $section)
                            <li class="flex">
                                <a
                                    href="{{ route($section->route) }}"
                                    @class(
                                        '
                                            group
                                            p-2 no-underline
                                            text-black font-bold uppercase
                                            flex items-center
                                            opacity-50
                                            hover:opacity-100 hover:bg-overlay
                                        ',
                                        [ 'opacity-100' => $router->is($section->route) ]
                                    )
                                >
                                    @icon($section->icon, 'h-6 mr-2 fill-current')
                                    <span
                                        @class(
                                            'border-b-2 border-transparent group-hover:border-black',
                                            [ 'border-black' => $router->is($section->route) ]
                                        )
                                    >
                                        {{ $section->text }}
                                    </span>
                                </a>
                            </li>
                        @endforeach

                    </ul>

                    <!-- Socials -->

                    @php
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

                    <ul class="list-reset flex">

                        @foreach ($socials as $social)
                            <li class="flex">
                                <a
                                    href="{{ $social->url }}"
                                    title="{{ $social->name }}"
                                    class="px-2 min-w-10 flex items-center justify-center opacity-50 hover:bg-overlay hover:opacity-100"
                                >
                                    @icon($social->icon, 'h-6')
                                </a>
                            </li>
                        @endforeach

                    </ul>

                </div>

            </nav>

        </header>

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
