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
            'route' => 'projects',
            'icon'  => 'projects',
            'text'  => 'Projects'
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
    class="flex flex-col items-center z-10 h-16 md:h-32 lg:h-40"
>

    <div class="w-full max-w-content flex overflow-hidden">

        <a
            class="px-3 mr-2 h-full cursor-pointer flex items-center hover:bg-overlay md:hidden print:hidden"
            data-action="navigation#toggle"
        >
            @icon('menu', 'h-8 fill-current')
        </a>

        <a href="{{ route('home') }}" aria-label="Home" title="Home" class="flex" tabindex="-1">
            <img
                src="/img/myface.png"
                alt="My Face"
                class="mr-2 transform md:mr-4 lg:mr-8 h-16/10 translate-y-m15/100 print:h-full print:translate-y-0"
            />

            <div class="flex-grow my-auto" style="height:80%">
                @icon('site-title', 'h-full text-black fill-current')
            </div>
        </a>

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
                        aria-label="{{ $section->text }}"
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
                        aria-label="{{ $social->name }}"
                        title="{{ $social->name }}"
                        target="_blank"
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
