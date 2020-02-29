@extends('layouts.master')

@section('content')
    <article>

        <h1 class="hidden">Noel De Martin</h1>

        <span class="mb-4 text-3xl font-medium text-blue-darkest tracking-wide">
            Hi there!
        </span>

        <p class="text-xl">
            My name is Noel, I am a developer and entrepreneur who loves to learn,
            solve problems and build products that make an impact.
        </p>

        <p class="text-xl">
            Welcome to my personal website. Take your time to look around, and if you
            want to talk with me don't hesitate on
            <a href="{{ config('content.socials.email.url') }}">sending an email</a>.
        </p>

        <span class="block my-4 text-2xl text-center font-medium text-blue-darkest w-full">
            If you want to learn how I...
        </span>

        <div class="flex flex-col md:flex-row">

            @component('components.call-to-action-card', ['title' => 'Am'])
                Keep reading!
            @endcomponent

            @component('components.call-to-action-card', ['title' => 'Think'])
                Read my <a href="{{ route('blog') }}">Blog</a>
            @endcomponent

            @component('components.call-to-action-card', ['title' => 'Work'])
                Check out
                <a href="{{ config('content.socials.github.url') }}" target="_blank">
                    my GitHub
                </a><br>
                or
                <a href="{{ route('now') }}">What I'm doing now</a>
            @endcomponent

        </div>

        <h2 class="md:mt-10">My values</h2>

        <div class="flex w-full">

            <div class="max-w-readable">

                <p class="mt-0">
                    Values are abstract concepts, and sometimes they are perceived as buzzwords.
                    But values are important to me and I try to embed them in my actions.
                </p>

                <p class="mb-2">These are my values:</p>

                <ul class="flex flex-wrap">
                    <li class="my-1 w-full md:w-1/2"><strong class="font-medium">Autonomy</strong></li>
                    <li class="my-1 w-full md:w-1/2"><strong class="font-medium">Awareness</strong></li>
                    <li class="my-1 w-full md:w-1/2"><strong class="font-medium">Continuous improvement</strong></li>
                    <li class="my-1 w-full md:w-1/2"><strong class="font-medium">Education</strong></li>
                    <li class="my-1 w-full md:w-1/2"><strong class="font-medium">Openness</strong></li>
                    <li class="my-1 w-full md:w-1/2"><strong class="font-medium">Privacy</strong></li>
                    <li class="my-1 w-full md:w-1/2"><strong class="font-medium">Quality over quantity</strong></li>
                    <li class="my-1 w-full md:w-1/2"><strong class="font-medium">Self-expression and creativity</strong></li>
                    <li class="my-1 w-full md:w-1/2 md:mb-0"><strong class="font-medium">Sustainability</strong></li>
                    <li class="my-1 w-full md:w-1/2 md:mb-0"><strong class="font-medium">Work-life balance</strong></li>
                </ul>

            </div>

            <div class="relative flex-grow self-stretch ml-4 hidden md:block">
                <div class="absolute flex items-center justify-center inset-0 m-8">
                    @icon('my-values', 'w-full')
                </div>
            </div>

        </div>

        <h2 class="md:mt-10">My background</h2>

        <div class="flex w-full">

            <div class="relative flex-grow self-stretch mr-4 hidden md:block">
                <div class="absolute flex items-center justify-center inset-0 m-8">
                    @icon('my-background', 'w-full')
                </div>
            </div>

            <div class="max-w-readable">

                <p class="mt-0">
                    I have been working in the software industry since 2011. I enjoy programming
                    in and of itself, but I've always cared about the impact of my code. That's
                    what led me to entrepreneurship. For the most part of my career I've been
                    involved with startups and bootstrapped projects. Although I am now migrating
                    into mission-driven organizations.
                </p>

                <p>
                    I don't like showcasing my skills, because experience and first principles are
                    what's really important. But skills have an impact on our daily lives and shape
                    our way of thinking, so they are worth mentioning. I've worked as a
                    <strong class="font-medium">Fullstack developer</strong> for mobile and web
                    applications, and I love interacting with UI and UX designers. My frameworks
                    of choice are
                    <a href="https://laravel.com/" target="_blank"><strong class="font-medium">Laravel</strong></a>
                    for the backend and
                    <a href="https://vuejs.org/" target="_blank"><strong class="font-medium">Vue</strong></a>
                    for the frontend. For mobile I prefer building PWAs or hybrid apps.
                    Whenever possible, I rely on The Web and open technologies.
                </p>

                <p class="mb-0">
                    If you want to learn more about my skills and background check out my
                    <a href="/cv.pdf">CV</a>.
                </p>

            </div>

        </div>

        <h2 class="md:mt-10">Beyond the code</h2>

        <div class="flex w-full">

            <div class="max-w-readable">

                <p class="mt-0">
                    This website and my online persona are mostly about my career and professional life.
                    But maybe you'd like to see a little bit behind the curtain.
                </p>

                <p>
                    I am an avid Manga reader and I occasionally watch Anime as well. I also watch
                    Movies and TV Shows often, but I cannot say that I have a favorite genre.
                    Music is a big part of my life, and I listen to styles ranging from Death Metal
                    all the way to Folk.
                </p>

                <p class="mb-0">
                    On occasion I like going for a hike, and I love traveling and learning about other
                    cultures. You may like to know that my two favorite novels are
                    <a href="https://en.wikipedia.org/wiki/Canon_of_Sherlock_Holmes" target="_blank">The Sherlock Holmes Anthology</a>
                    and <a href="{{ url('blog/lessons-learned-musashi-by-eiji-yoshikawa') }}">Musashi</a>.
                    I enjoy many art forms, and I have more content pending to consume than I'll
                    be able in my life-time. Which makes for a very fun ride :).
                </p>

            </div>

            <div class="relative flex-grow self-stretch ml-4 hidden md:block">
                <div class="absolute inset-0 m-8">
                    @icon('beyond-code', 'w-full')
                </div>
            </div>

        </div>

        <p class="mt-10 text-lg text-center">
            There you have it, now you know more about me than you cared about!
        </p>

    </article>
@stop
