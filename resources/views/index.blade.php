@extends('layouts.master')

@section('content')
    <article class="max-w-readable">

        <h1 class="hidden">Noel De Martin</h1>

        <span class="mb-4 text-3xl font-medium text-blue-darkest tracking-wide">
            Hi there!
        </span>

        <p class="text-lg">
            My name is Noel, I am a developer and entrepreneur who loves to learn,
            solve problems and build products that make an impact.
        </p>

        <p class="text-lg">
            It's awesome that you are here! Take your time to look around, and if you
            want to talk with me don't hesitate on
            <a href="{{ config('content.socials.email.url') }}">sending an email</a>.
        </p>

        <span class="block my-4 text-2xl text-center font-medium text-blue-darkest w-full">
            If you want to learn how I...
        </span>

        <div class="flex flex-col md:flex-row">

            <div class="flex-1 bg-grey-lighter border border-grey-light rounded m-2 p-4 items-center justify-center flex text-center flex-col">

                <span class="my-4 text-2xl font-medium text-blue-darkest">Am</span>

                <span class="leading-normal">Keep reading!<br><br></span>

            </div>

            <div class="flex-1 bg-grey-lighter border border-grey-light rounded m-2 p-4 items-center justify-center flex text-center flex-col">

                <span class="my-4 text-2xl font-medium text-blue-darkest">Think</span>

                <span class="leading-normal">Read my <a href="{{ route('blog') }}">Blog</a><br><br></span>

            </div>

            <div class="flex-1 bg-grey-lighter border border-grey-light rounded m-2 p-4 items-center justify-center flex text-center flex-col">

                <span class="my-4 text-2xl font-medium text-blue-darkest">Work</span>

                <span class="leading-normal">
                    Check out
                    <a href="{{ config('content.socials.github.url') }}" target="_blank">
                        my GitHub
                    </a>
                    or
                    <a href="{{ route('now') }}">What I'm doing now</a><br>
                </span>

            </div>

        </div>

        <h2 id="values">My values</h2>

        <p>
            Values are abstract concepts, and sometimes they can be perceived as
            buzzwords. But they are important to me and I try to embed them in my actions.
        </p>

        <p class="mb-2">These are my values:</p>

        <ul class="flex flex-wrap">
            <li class="my-1 w-full md:w-1/2">Autonomy</li>
            <li class="my-1 w-full md:w-1/2">Awareness</li>
            <li class="my-1 w-full md:w-1/2">Continuous improvement</li>
            <li class="my-1 w-full md:w-1/2">Openness</li>
            <li class="my-1 w-full md:w-1/2">Privacy</li>
            <li class="my-1 w-full md:w-1/2">Quality over quantity</li>
            <li class="my-1 w-full md:w-1/2">Self-expression and creativity</li>
            <li class="my-1 w-full md:w-1/2">Sustainability</li>
            <li class="my-1 w-full md:w-1/2">Work-life balance</li>
        </ul>

        <h2 id="programming-and-entrepreneurship">Programming & Entrepreneurship</h2>

        <p>
            I have been a developer since 2011. My story is quite uncommon, because when I started studying computer science in university,
            I had no idea of what programming was (really, I didn't even know the concept of a "variable"). And the funny story is that I
            choose that degree because I liked to use photoshop and math. Soon I found how different it is to use software and build software.
            But luckily for me, I fell in love with programming. Since then, I have always been passionate about coding and to this day I
            still enjoy learning about it. If I had to say why I like programming so much, it would be my drive to solve problems
            and how much I enjoy algorithmics and software architecture.
        </p>

        <p>
            The other side of the coin is Entrepreneurship. I'm not sure that I like the word, because it can have so many connotations.
            What it means to me is not only thinking about a problem, but taking action and working towards results. From early on I've
            always cared about the purpose of my work and how it would affect the people using it. I also champion innovation and creativity;
            I believe programming is an extremely creative activity, and I always try to challenge preconceptions and improve.
        </p>

        <h2 id="beyond-code">Beyond the code</h2>

        <p>
            Other than what this website is mostly about, I have multiple interests that I try to balance with everything else. I love to travel
            and find new places and cultures, and I'm always looking for an opportunity to do some hiking or mountain climbing. One country I am
            specially fond of is Japan, since I am also an avid manga reader, and I recently started learning Japanese.
        </p>

        <p>
            More interests include different ranges of rock and heavy metal music, doing sports and personal development.
            My favorite book is the Sherlock Holmes Anthology.
        </p>

        <p class="text-lg">So, in a nutshell, that's me!</p>

    </article>
@stop
