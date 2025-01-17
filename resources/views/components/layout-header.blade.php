<header
    style="background-color: hsl(120, 40%, 80%)"
    class="z-10 flex h-16 flex-col items-center md:h-32 lg:h-40"
>
    <div class="max-w-content flex w-full overflow-hidden">
        <a
            href="{{ sroute("home") }}"
            aria-label="Home"
            title="Home"
            class="flex"
            tabindex="-1"
        >
            <img
                src="/img/myface.png"
                alt=""
                class="mr-2 h-16/10 translate-y-[-15%] transform md:mr-4 lg:mr-8 print:h-full print:translate-y-0"
            />
            <div class="my-auto grow" style="height: 80%">
                <s:partial
                    src="icons/site-title"
                    class="h-full fill-current text-black"
                />
            </div>
        </a>
    </div>
    <nav aria-label="Site navigation" class="bg-overlay w-full">
        <div class="max-w-content mx-auto flex h-full justify-between">
            <div class="flex">
                <s:nav handle="main">
                    <a
                        href="{{ $url }}"
                        class="group hover:bg-overlay relative flex items-center p-2 font-bold text-black uppercase opacity-50 hover:opacity-100 focus:opacity-100 [&:is([aria-current])]:opacity-100"
                        @if ($is_current)
                            aria-current="page"
                        @endif
                    >
                        <s:partial :src="'icons/'.$icon" class="mr-2 size-5" />
                        <span
                            class="border-b-2 border-transparent group-hover:border-black [[aria-current]>&]:border-black"
                        >
                            {{ $title }}
                        </span>
                    </a>
                </s:nav>
            </div>
            <div class="flex">
                @foreach ($socials as $account)
                    <a
                        href="{{ $account->link }}"
                        aria-label="{{ $account->name }}"
                        title="{{ $account->name }}"
                        target="_blank"
                        class="hover:bg-overlay flex min-w-10 items-center justify-center px-2 opacity-50 hover:opacity-100 focus:opacity-100"
                        {{ $account->represent ? 'rel="me"' : "" }}
                    >
                        <s:partial
                            :src="'icons/' . $account->icon"
                            :class="($account->classes ?? '') . ' h-6'"
                        />
                        <span class="sr-only">{{ $account->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </nav>
</header>
