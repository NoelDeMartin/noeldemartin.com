@extends('layouts.master')

@section('content')
    <article>

        <h1>Hi there!</h1>

        <p class="text-lg">
            My name is Noel, I am a developer and entrepreneur who loves to learn, solve problems and build
            <i title="From fun experiments to products that make an impact">stuff</i>. I have been working on the software industry
            since 2011 in all kinds of projects and I’m always looking for new challenges.
        </p>

        <p class="text-lg">
            It's awesome that you are here! Take your time to look around, and if you want to talk with me don't hesitate on
            <a href="mail:noeldemartin@gmail.com">sending an email</a>.
        </p>

        <h2 class="text-xl">If you want to learn how I...</h2>

        <div class="flex flex-col md:flex-row">

            <div class="flex-1 bg-grey-lightest m-2 p-4 items-center justify-center flex text-center flex-col">

                <h2>Think</h2>

                <span class="leading-normal">Go read my <a href="{{ route('blog') }}">Blog</a><br><br></span>

            </div>

            <div class="flex-1 bg-grey-lightest m-2 p-4 items-center justify-center flex text-center flex-col">

                <h2>Work</h2>

                <span class="leading-normal">
                    Check out my <a href="{{ route('experiments') }}">Experiments</a><br>
                    or browse my <a href="https://github.com/NoelDeMartin">GitHub</a>
                </span>

            </div>

            <div class="flex-1 bg-grey-lightest m-2 p-4 items-center justify-center flex text-center flex-col">

                <h2>Am</h2>

                <span class="leading-normal">Keep reading!<br><br></span>

            </div>

        </div>

        <h2>My values</h2>

        <p>
            <i>Values</i> is such an abstract concept, don't you think? Sometimes they may seem random words. But values are
            important to me. I try to embed them in my actions and are core to everything in my life. These are my values:
        </p>

        <ul>
            <li class="my-2">Work-life balance</li>
            <li class="my-2">Sustainability</li>
            <li class="my-2">Quality > quantity</li>
            <li class="my-2">Knowledge</li>
            <li class="my-2">Creativity</li>
            <li class="my-2">Privacy</li>
        </ul>

        <h2>Programming & Entrepreneurship</h2>

        <p>
            I have been a developer since 2011. My story is quite uncommon, because when I started studying computer science in university,
            I had no idea of what programming was (really, I didn't even know the concept of a "variable"). And the funny story is that I
            choose that degree because I liked to use photoshop and math. Soon I found how different it is to use software and build software.
            But luckily for me, I fell in love with programming. Since then, I have always been passionate about coding and to this day I
            still enjoy learning about it. If I had to say what I like so much about programming, it would be my drive to solve problems
            and how much I enjoy algorithmics and software architecture.
        </p>

        <p>
            The other side of the coin is Entrepreneurship. I'm not sure that I like the word, because it's the same as hacking, it can have
            so many connotations. What it means to me is not only thinking about a problem, but taking action and getting results. From early
            on I've always cared about the purpose of my work and how it would affect the people using it. I also champion innovation and
            creativity; I believe programming is an extremely creative activity, and I always try to challenge preconceptions and improve.
        </p>

        <h2>Beyond the code</h2>

        <p>
            Other than what this website is mostly about, I have multiple interests that I try to balance with everything else. I love to travel
            and find new places and cultures, and I'm always looking for an opportunity to do some hiking or mountain climbing. One country I am
            specially fond of is Japan, since I am also an avid manga reader, and I recently started learning Japanese.
        </p>

        <p>
            More interests include different ranges of rock and heavy metal music, doing sports, personal development and I should really start reading
            more books. My favorite book is the Sherlock Holmes Anthology.
        </p>

        <p class="text-lg">So, in a nutshell, that's me!</p>

    </article>
@stop
