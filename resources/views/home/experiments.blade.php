@extends('layouts.master')

@section('content')
    <article>

        <h1>Experiments</h1>

        <p>
            Here you will find small projects I have done when I wanted to explore an idea. Some are useful, some are
            an itch that needed to be scratched, and some are just exploring something I was interested in.

            Maybe they don't work in your browser because my point when doing these wasn't compatibility (specially the ones testing new APIs),
            but at least I hope they can pique your interest :D.
        </p>

        <div class="border-1 mb-8 border-grey rounded">

            <h2 class="border-b-1 border-grey rounded-t bg-grey-light my-0 p-2 flex items-center justify-between">
                <div class="flex">
                    <a
                        href="{{ route('experiments.freedom-calculator') }}"
                        class="flex items-center text-blue-darkest hover:text-blue"
                    >
                        Freedom Calculator
                    </a>
                    <time>
                        @icon('calendar', 'h-4 fill-current')
                        <span class="ml-2">December 2014</span>
                    </time>
                </div>
                <a
                    href="{{ route('experiments.freedom-calculator') }}"
                    title="Freedom Calculator"
                    class="flex items-center text-blue-darkest hover:text-blue"
                >
                    @icon('link-round', 'h-8 fill-current')
                </a>
            </h2>

            <div class="p-4">
                <p>
                    This a <i>Financial</i> Freedom Calculator (yeah I don't know how to calculate personal freedom yet, I'll let you know when I do ;D).
                    Indicate how much money you have and how much you spend every day/week/month, and you will know when your cash runs out!
                </p>
                <p>
                    It's not difficult to calculate this yourself, but doing it visually with the exact deadline can be helpful. I created it when I
                    wanted to quit my job, to know how much time I could stay unemployed (that's why it has this pretentious name). But it turned out to
                    be more useful than I thought because I have used it for multiple things since then: to control cash spending when backpacking, to see
                    how long it would take to pay something in parts, etc.
                </p>
                <p>
                    You don't have to worry about me knowing anything on your finances, since I don't record any information (in fact, I don't even use
                    analytics on the site).
                </p>
            </div>

        </div>

        <div class="border-1 mb-8 border-grey rounded">

            <h2 class="border-b-1 border-grey rounded-t bg-grey-light my-0 p-2 flex items-center justify-between">
                <div class="flex">
                    <a
                        href="{{ route('experiments.online-meeting') }}"
                        class="flex items-center text-blue-darkest hover:text-blue"
                    >
                        Online Meeting
                    </a>
                    <time>
                        @icon('calendar', 'h-4 fill-current')
                        <span class="ml-2">April 2015</span>
                    </time>
                </div>
                <a
                    href="{{ route('experiments.online-meeting') }}"
                    title="Online Meeting"
                    class="flex items-center text-blue-darkest hover:text-blue"
                >
                    @icon('link-round', 'h-8 fill-current')
                </a>
            </h2>

            <div class="p-4">
                <p>
                    Back in 2015 I learned about <a href="https://webrtc.org/" target="_blank">WebRTC</a>. The first thing that came to mind were
                    online meetings. I was suffering the typical issues with online communication: bad connection, problems signing up,
                    etc. So when I saw this, I thought it would be great to have a website that gives you a link to invite people and thats it!
                </p>
                <p>
                    I ended up implementing a web app that not only connects audio, but it also has a chat and a drawing board. The cool part is that
                    almost everything runs on the browser, except for the handshake. So data is stored on users' browsers and all chat history and
                    drawings are removed when users disconnect. For the handshake, I used
                    <a href="https://firebase.google.com/docs/database/" target="_blank">Firebase</a> so that I didn't have to support any load on my
                    server. Not that many people use it (probably nobody other than me), but this is theorically a text-voice-drawing chat that
                    <i>scales</i>. Cool, not bad for an experiment.
                </p>
                <p>
                    WebRTC seems to have mainstrem support today, so this should be even more viable. However, since the code is the same I wrote back in
                    2015, some things have probably changed and it may be even more unstable than it was before. So take it as a proof of concept, I tried
                    now in 2018 and it seems to work in Firefox and Chrome in desktop. I may clean it up and upload it to Github some day, but until then you can
                    see <a href="{{ asset('js/experiments/online-meeting.js') }}" target="_blank">this file</a> and inspect inline scripts on the website.
                </p>
            </div>

        </div>

        <div class="border-1 mb-8 border-grey rounded">

            <h2 class="border-b-1 border-grey rounded-t bg-grey-light my-0 p-2 flex items-center justify-between">
                <div class="flex">
                    <a
                        href="{{ route('experiments.synonymizer') }}"
                        class="flex items-center text-blue-darkest hover:text-blue"
                    >
                        Random Synonymizer
                    </a>
                    <time>
                        @icon('calendar', 'h-4 fill-current')
                        <span class="ml-2">April 2016</span>
                    </time>
                </div>
                <a
                    href="{{ route('experiments.synonymizer') }}"
                    title="Random Synonymizer"
                    class="flex items-center text-blue-darkest hover:text-blue"
                >
                    @icon('link-round', 'h-8 fill-current')
                </a>
            </h2>

            <div class="p-4">
                <p>
                    Well, this is just silly. I was using <a href="http://www.thesaurus.com" target="_blank">Thesaurus</a> for searching synonims,
                    when it ocurred to me: Wouldn't it be funny to have a website were you introduce a sentence and it substitutes random words with
                    synonims? (Probably not)
                </p>
                <p>
                    There isn't much to this one. It simply takes your sentence and substitues random words for synonims found in thesaurus, that's it.
                    It doesn't even work as it should; the point was to give a different "funny" meaning to a sentence, but most of the time what happens
                    is that you get something that doesn't even make sense. This could be improved with some NLP and such, but I guess this is were I'll
                    leave it.
                </p>
            </div>

        </div>

        <div class="border-1 mb-8 border-grey rounded">

            <h2 class="border-b-1 border-grey rounded-t bg-grey-light my-0 p-2 flex items-center justify-between">
                <div class="flex">
                    <a
                        href="https://noeldemartin.github.io/DC-Motor-Sandbox/"
                        class="flex items-center text-blue-darkest hover:text-blue"
                    >
                        DC Motor Sandbox
                    </a>
                    <time>
                        @icon('calendar', 'h-4 fill-current')
                        <span class="ml-2">March 2018</span>
                    </time>
                </div>
                <div class="flex">
                    <a
                        href="https://github.com/NoelDeMartin/DC-Motor-Sandbox/"
                        title="DC Motor Sandbox on Github"
                        class="flex items-center text-blue-darkest hover:text-blue"
                    >
                        @icon('github', 'h-8 fill-current')
                    </a>
                    <a
                        href="https://noeldemartin.github.io/DC-Motor-Sandbox/"
                        title="DC Motor Sandbox"
                        class="ml-2 flex items-center text-blue-darkest hover:text-blue"
                    >
                        @icon('link-round', 'h-8 fill-current')
                    </a>
                </div>
            </h2>

            <div class="p-4">
                <p>
                    I have always wanted to work with robotics, since Artificial Intelligence and Computer Vision were my favourite subjects in
                    university. That's why I started working on an experiment involving wheels with DC motors (I'll publish about it here if I
                    ever get something "decent" to show). And the first problem I found was how to know which motor is needed for the task.
                    Turns out it's not as straight-forward as one may think (at least for me who knows close to 0 about electronics), so I made this
                    tool to calculate all that I learned about it.
                </p>
                <p>
                    Basically, it has different inputs to introduce specifications about a DC motor used for vehicle wheels (Voltage, Gearbox
                    reduction, number of wheels, etc.) and calculates the maximum load the vehicle would handle. I guess there may be some things that
                    don't make sense, but I didn't find anything similar to this online so at least it'll be useful to me.
                </p>
            </div>

        </div>

    </article>
@stop
