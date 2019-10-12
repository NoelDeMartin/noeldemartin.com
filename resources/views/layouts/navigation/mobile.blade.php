@inject('router', 'Illuminate\Routing\Router')

<header
    data-controller="chamaleon menu"
    data-menu-collapsed="true"
    data-target="chamaleon.skin"
    style="background-color: hsl({{ (round(microtime(true) * 10) % 360) }}, 40%, 80%)"
    class="fixed top-0 inset-x-0 h-12 flex items-center lg:hidden"
>

    <a
        class="px-2 mr-2 h-12 cursor-pointer flex items-center hover:bg-overlay"
        data-action="menu#toggle"
    >
        @icon('menu', 'h-8 fill-current')
    </a>

    <span class="font-comic font-medium text-xl">NOEL DE MARTIN</span>

    <nav
        class="fixed left-0 inset-y-0 bg-grey mt-12 z-20 flex flex-col min-w-sidebar"
        style="transform:translateX(-100%);transition:0.5s"
        data-target="chamaleon.skin menu.sidebar"
    >

        <ul class="flex flex-col">

            @foreach ($sections as $i => $section)
                <li class="flex">
                    <a
                        href="{{ route($section->route) }}"
                        title="{{ $section->text }}"
                        @class(
                            '
                                group
                                p-4
                                text-black font-bold uppercase
                                flex flex-grow items-center
                                hover:bg-overlay
                            ',
                            [ 'bg-overlay' => $router->is($section->route) || $i == 0 && $router->is('home')]
                        )
                    >
                        @icon($section->icon, 'h-6 mr-2 fill-current')
                        <span
                            @class(
                                'border-b-2 border-transparent group-hover:border-black',
                                [ 'border-black' => $router->is($section->route) || $i == 0 && $router->is('home') ]
                            )
                        >
                            {{ $section->text }}
                        </span>
                    </a>
                </li>
            @endforeach

        </ul>

        <ul class="flex flex-col">

            @foreach ($socials as $social)
                <li class="flex flex-grow">
                    <a
                        href="{{ $social->url }}"
                        title="{{ $social->name }}"
                        class="px-2 h-12 min-w-10 text-black-light text-sm flex flex-grow items-center justify-start hover:bg-overlay"
                        @attrs($social->extras)
                    >
                        @icon($social->icon, 'min-w-10 h-6') {{ $social->name }}
                    </a>
                </li>
            @endforeach

        </ul>

    </nav>

    <div
        class="bg-overlay fixed pin mt-12 hidden z-10"
        style="transition:5s"
        data-target="menu.overlay"
        data-action="click->menu#toggle"
    ></div>

</header>
