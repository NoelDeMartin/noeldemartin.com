@inject('router', 'Illuminate\Routing\Router')

@php
    $hue = round(microtime(true) * 10) % 360;

    $sections = [
        (object) [
            'route' => 'home',
            'icon'  => 'about',
            'text'  => 'About me'
        ],
        (object) [
            'route' => 'blog',
            'icon'  => 'blog',
            'text'  => 'Blog'
        ],
        (object) [
            'route' => 'experiments',
            'icon'  => 'experiments',
            'text'  => 'Experiments'
        ],
        (object) [
            'route' => 'now',
            'icon'  => 'now',
            'text'  => 'Now',
        ],
    ];
@endphp

<header
    data-controller="chamaleon navigation"
    data-target="chamaleon.skin"
    style="background-color: hsl({{ $hue }}, 40%, 80%)"
    class="flex flex-col items-center h-16 md:h-32 lg:h-40"
>

    <div class="max-w-content flex overflow-hidden">

        <a
            class="px-3 mr-2 h-full cursor-pointer flex items-center hover:bg-overlay md:hidden"
            data-action="navigation#toggle"
        >
            @icon('menu', 'h-8 fill-current')
        </a>

        <img
            src="/img/myface.png"
            alt="My Face"
            class="mr-2 md:mr-4 lg:mr-8"
            style="height:160%;transform:translateY(-15%)"
        />

        @icon('site-title', 'self-center fill-current', ['style' => 'height: 80%'])

    </div>

    <!-- styled on resources/assets/sass/components/header-nav.scss -->
    <nav
        data-target="chamaleon.skin navigation.nav"
        style="background-color: hsl({{ $hue }}, 40%, 80%)"
    >

        <div class="wrapper">

            <div class="sections">
                @foreach ($sections as $i => $section)
                    <a
                        href="{{ route($section->route) }}"
                        title="{{ $section->text }}"
                        @class(['active' => $router->is($section->route)])
                    >
                        @icon($section->icon, 'h-5 mr-2 fill-current')
                        <span>{{ $section->text }}</span>
                    </a>
                @endforeach
            </div>

            <div class="socials">
                @foreach (content_socials() as $social)
                    <a
                        href="{{ $social->url }}"
                        title="{{ $social->name }}"
                        @attrs($social->extras)
                    >
                        @icon($social->icon, 'h-6')
                        <span>{{ $social->name }}</span>
                    </a>
                @endforeach
            </div>

        </div>

    </nav>

</header>