@inject('router', 'Illuminate\Routing\Router')

<header
    data-controller="chamaleon"
    data-target="chamaleon.skin"
    style="background-color: hsl({{ (round(microtime(true) * 10) % 360) }}, 40%, 80%)"
    @class(
        'w-full pb-12 hidden lg:block',
        [
            'h-32 md:h-44 lg:h-60' => $header,
            'h-12'                 => ! $header,
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