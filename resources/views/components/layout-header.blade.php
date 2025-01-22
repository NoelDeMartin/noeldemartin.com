<header
    class="bg-chamaleon {{ $collapsed ? "md:mt-[calc(theme('height.5')+2*theme('height.2')-theme('height.32'))] lg:mt-[calc(theme('height.5')+2*theme('height.2')-theme('height.40'))]" : "" }} z-10 flex h-16 flex-col items-center transition-colors duration-300 md:h-32 lg:h-40"
    :class="navigationOpen ? 'fixed top-0 inset-x-0' : ''"
    x-chamaleon
>
    <div class="max-w-content flex w-full overflow-hidden">
        <a
            class="hover:bg-overlay mr-2 flex h-full cursor-pointer items-center px-3 md:hidden print:hidden"
            @click="navigationOpen = !navigationOpen"
        >
            <s:partial src="icons/menu" class="h-8 fill-current" />
        </a>

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
    <nav
        aria-label="Site navigation"
        class="md:bg-overlay bg-chamaleon fixed top-16 bottom-0 w-full -translate-x-full transition-colors transition-transform duration-300 md:relative md:top-0 md:translate-x-0"
        :class="{
            'translate-x-0': navigationOpen,
            '-translate-x-full md:translate-x-0': !navigationOpen,
        }"
    >
        <div
            class="md:max-w-content max-h-full overflow-auto md:mx-auto md:flex md:h-full md:justify-between"
        >
            <div class="md:flex">
                <s:nav handle="main">
                    <a
                        href="{{ $url }}"
                        class="group hover:bg-overlay relative flex items-center px-4 py-3 font-bold text-black uppercase hover:opacity-100 focus:opacity-100 md:px-2 md:py-2 md:opacity-50 [&:is([aria-current])]:opacity-100"
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
            <div class="md:flex">
                @foreach ($socials as $account)
                    <a
                        href="{{ $account->link }}"
                        aria-label="{{ $account->name }}"
                        title="{{ $account->name }}"
                        target="_blank"
                        class="hover:bg-overlay flex min-w-10 items-center justify-start px-4 py-3 hover:opacity-100 focus:opacity-100 md:justify-center md:px-2 md:py-0 md:opacity-50"
                        {{ $account->represent ? 'rel="me"' : "" }}
                    >
                        <s:partial
                            :src="'icons/' . $account->icon"
                            :class="($account->classes ?? '') . ' h-6'"
                        />
                        <span class="ml-2 md:sr-only">
                            {{ $account->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </nav>
</header>
