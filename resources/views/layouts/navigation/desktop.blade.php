@inject('router', 'Illuminate\Routing\Router')

<header
    data-controller="chamaleon"
    data-target="chamaleon.skin"
    style="background-color: hsl({{ (round(microtime(true) * 10) % 360) }}, 40%, 80%)"
    @class(
        'w-full pb-10 hidden lg:block',
        [
            'h-24 md:h-32 lg:h-40' => $header,
            'h-10'                 => ! $header,
        ]
    )
>

    <div class="max-w-content h-full overflow-hidden mx-auto flex items-center justify-start">
        <img
            src="/img/myface.png"
            alt="My Face"
            class="h-32 ml-4 mt-4 md:h-48 md:mt-6 lg:h-40 lg:mt-8"
        />
        <span
            class="
                font-comic font-medium text-4xl ml-4
                md:text-4xl md:ml-10
                lg:text-5xl lg:ml-12
            "
        >
            NOEL<br>
            DE MARTIN
        </span>
    </div>

    <nav class="h-10 bg-overlay">

        <div class="max-w-content h-full mx-auto flex justify-between">

            <ul class="flex">

                @foreach ($sections as $i => $section)
                    <li class="flex">
                        <a
                            href="{{ route($section->route) }}"
                            title="{{ $section->text }}"
                            @class(
                                '
                                    group
                                    p-2
                                    text-black font-bold uppercase
                                    flex items-center
                                    opacity-50
                                    hover:opacity-100 hover:bg-overlay
                                ',
                                [ 'opacity-100' => $router->is($section->route) || $i == 0 && $router->is('home') ]
                            )
                        >
                            @icon($section->icon, 'h-5 mr-2 fill-current')
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

            <ul class="flex">

                @foreach ($socials as $social)
                    <li class="flex">
                        <a
                            href="{{ $social->url }}"
                            title="{{ $social->name }}"
                            class="px-2 min-w-10 flex items-center justify-center opacity-50 hover:bg-overlay hover:opacity-100"
                            @attrs($social->extras)
                        >
                            @icon($social->icon, 'h-6')
                        </a>
                    </li>
                @endforeach

            </ul>

        </div>

    </nav>

</header>
