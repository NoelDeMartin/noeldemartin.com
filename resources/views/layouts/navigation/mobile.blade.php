@inject('router', 'Illuminate\Routing\Router')

<header
    data-controller="chamaleon menu"
    data-menu-collapsed="true"
    data-target="chamaleon.skin"
    style="background-color: #b8e0df"
    class="fixed pin-t pin-x h-12 flex items-center lg:hidden"
>

    <a
        class="px-2 mr-2 h-12 cursor-pointer flex items-center hover:bg-overlay"
        data-action="menu#toggle"
    >
        @icon('menu', 'h-8 fill-current')
    </a>

    <h1 class="font-comic font-medium text-xl">NOEL DE MARTIN</h1>

    <nav
        class="fixed pin-l pin-y bg-grey mt-12 z-20 flex flex-col min-w-sidebar"
        style="transform:translateX(-100%);transition:0.5s"
        data-target="chamaleon.skin menu.sidebar"
    >

        <ul class="list-reset flex flex-col">

            @foreach ($sections as $section)
                <li class="flex flex-grow">
                    <a
                        href="{{ route($section->route) }}"
                        @class(
                            '
                                group
                                p-4 no-underline
                                text-black font-bold uppercase
                                flex flex-grow items-center
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

        <div class="flex-grow"></div>

        <ul class="list-reset flex flex-col">

            @foreach ($socials as $social)
                <li class="flex flex-grow">
                    <a
                        href="{{ $social->url }}"
                        title="{{ $social->name }}"
                        class="px-2 h-12 min-w-10 flex flex-grow items-center justify-center opacity-50 hover:bg-overlay hover:opacity-100"
                    >
                        @icon($social->icon, 'h-6')
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