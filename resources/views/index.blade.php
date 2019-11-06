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
            <li class="my-1 w-full md:w-1/2">Education</li>
            <li class="my-1 w-full md:w-1/2">Openness</li>
            <li class="my-1 w-full md:w-1/2">Privacy</li>
            <li class="my-1 w-full md:w-1/2">Quality over quantity</li>
            <li class="my-1 w-full md:w-1/2">Self-expression and creativity</li>
            <li class="my-1 w-full md:w-1/2">Sustainability</li>
            <li class="my-1 w-full md:w-1/2">Work-life balance</li>
        </ul>

        <h2>My background</h2>

        <p>
            I have been a developer since 2011. I started a computer science degree in 2008
            following my interests in design (yeah you've read that right, design). I enjoyed
            using Photoshop, and some misguided counceling took me to pursue an engineering
            degree in order to understand the software better. I literally learned what a
            variable was in Programming 101, that's how clueless I was. Turns out it was a
            good choice, because I ended up falling in love with programming. In hindsight I
            appreciate learning that way, because I had 3 full years of incubation in an
            academic setting to build good foundations.
        </p>

        <p>
            I was very confortable in the academic environment, but I was missing doing
            something real and I still enjoyed the design part. That's when I started getting
            into web technologies (which wasn't included in the curriculum of my degree at the
            time). It was the perfect platform: fast development process, a fair ammount
            of visual design, easy to share my software with others, etc. Since then,
            I've been working mostly on building web and mobile apps.
        </p>

        <p>
            But there was also something else I was craving, I wanted my code to be useful for
            people. I enjoy programming in and of itself, but from an early stage I've cared
            about the end goal of the code I write. That's why I call myself a developer and
            an entrepreneur. Most of my experience has been in startups and bootstrapped
            projects, although as I write this (November 2019) I am migrating into
            mission-driven organizations. My main role is that of a developer, but I dabble
            in design, product and other parts of the business stack.
        </p>

        <p>
            If you want to learn more about my trajectory, be sure to check out my
            <a href="/cv.pdf">CV</a>.
        </p>

        <h2>My skills</h2>

        <p>
            I don't like talking about skills as something to showcase, because experience and
            first principles are what's really important. But skills have an impact on our
            daily lives and shape our way of thinking, so they are worth mentioning.
        </p>

        <p>
            I've been working mostly on mobile and web applications, doing both backend and
            frontend. So I guess that'd make me a fullstack developer. My framework of choice
            for the backend is Laravel, and Vue for the frontend. For mobile applications it
            depends on the requirements, but most of the time I prefer building PWAs or hybrid
            apps with Ionic Framwork or from scratch.
        </p>

        <p>
            Even thou those are my tools of choice, I've had experience with other
            technologies: Express, Angular, React, React Native, Ionic Framework, Android, etc.
            Funnily enough, my favorite programming language is Java, but I haven't used it
            much since I stopped developing native Android applications.
        </p>

        <h2 id="beyond-code">Beyond the code</h2>

        <p>
            This website and my online persona are mostly about my career and professional life.
            But maybe you'd like to see a little bit behind the curtain.
        </p>

        <p>
            I am an avid manga reader and I occasionally watch anime as well. I also enjoy
            watching movies and TV shows, but I cannot say that I have a favorite genre.
            Music is a big part of my life, and I listen to styles ranging from Death Metal
            all the way to Folk.
        </p>

        <p>
            On ocasion I like going for a hike, and I love travelling and learning about other
            cultures. Maybe you'd like to know that my two favorite novels are The Sherlock
            Holmes Anthology and Musashi. I enjoy many art forms, and I have more content
            pending to consume than I'll probably be able to in my life-time. Which makes for a
            very fun ride :).
        </p>

        <p>So there you have it, now you know more about me than you cared to know!</p>

    </article>
@stop
