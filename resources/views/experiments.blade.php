@extends('layouts.master')

@section('content')
    <article>

        <h1>Welcome to my lab</h1>

        <p>
            Here you will find small projects I have done when I wanted to explore an idea. Some are useful, some are an itch that needed to be
            scratched, and some are just exploring a topic I was interested in. I hope they can also pique your interest :D.
        </p>

        <p>
            If you want to see more, you can also find finished products in <a href="https://lincolnschilli.com/" target="_blank">Lincoln's Chilli</a>.
            I call it my "Entrepreneurial Sandbox", because I use it to publish MVPs and test the waters.
        </p>

        <div data-controller="expandable-items-list">

            @experiment([
                'name'     => 'DC Motor Sandbox',
                'date'     => 'March 2018',
                'datetime' => '2018-03',
                'url'      => 'https://noeldemartin.github.io/DC-Motor-Sandbox/',
                'extras'   => [
                    (object) [
                        'name' => 'Github',
                        'icon' => 'github',
                        'url'  => 'https://github.com/NoelDeMartin/DC-Motor-Sandbox/'
                    ],
                ],
            ])
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
            @endexperiment

            @experiment([
                'name'     => 'Zazen Meditation Timer',
                'date'     => 'September 2017',
                'datetime' => '2017-09',
                'url'      => 'https://noeldemartin.github.io/zazen-meditation-timer/',
                'extras'   => [
                    (object) [
                        'name' => 'Github',
                        'icon' => 'github',
                        'url'  => 'https://github.com/NoelDeMartin/zazen-meditation-timer/'
                    ],
                ],
            ])
                <p>
                    I had been meditating on and off for a couple of years, and one of the reasons why I didn't do it as much was that my setup was
                    quite bad. I played an audio file with a fixed length on my phone, so I couldn't change the time, and there was a nasty white-noise
                    on the background. The solutions I found didn't really convince me, and I had recently been thinking about PWA (Progressive Web Apps),
                    so this was the perfect chance to try doing one and also improve my meditation setup.
                </p>
                <p>
                    The final result is quite simple (and that was the idea), but the cool part is the architecture. It is a PWA, which means it can be
                    hosted in <a href="https://pages.github.com" target="_blank">github pages</a> for free, an deploying is done straight from the repository.
                    Another cool feature I added more recently is offline support with service workers. With this two aspects combined, this is really
                    equivalent to a native app without any appstores! If you have an Android device, try visiting the app url with Google Chrome and use the option
                    <i>Add to Home screen</i>. After doing that, you'll have the web app installed on your device and it'll work even if you don't have
                    internet connection.
                </p>
                <p>
                    Oh and yes, since then I did find a solution that I liked for meditating, so if you are interested check out the
                    <a href="https://insighttimer.com/" target="_blank">Insight Timer</a> app. And if you don't meditate, I suggest that you do, it really
                    has a ton of benefits :D.
                </p>
            @endexperiment

            @experiment([
                'name'     => 'Japanese Character Recognition',
                'date'     => 'June 2017',
                'datetime' => '2017-06',
                'extras'   => [
                    (object) [
                        'name' => 'Github',
                        'icon' => 'github',
                        'url'  => 'https://github.com/NoelDeMartin/Japanese-Character-Recognition'
                    ],
                ],
            ])
                <p>
                    Something I have always loved working on is artificial intelligence, so when I started reading about
                    <a href="https://www.tensorflow.org/" target="_blank">TensorFlow</a> I inmediatly wanted to get my hands dirty with that, in particular
                    how to use it in practical scenarios like within an Android application.
                </p>
                <p>
                    A more exhaustive description can be found in the Github repo, but in a nutshell what I did was obtain a free dataset of hand-written
                    japanese characters and use them to train a Convolutional Neural Network implemented in python using tensorflow libraries. Once the
                    model had been trained, I included it in an Android application in order to recognize characters drawn on the screen.
                </p>
                <p>
                    The end result is something decent, but suffers heavily from overfitting. This can be happening for different reasons, one of which may
                    be the training dataset being too small or not diverse enough. Some day I may continue working on this experiment, but for now that's
                    how it'll stay since I completed my goal of learning the basics of tensorflow and its integration with Android.
                </p>
            @endexperiment

            @experiment([
                'name'     => 'Synonymizer',
                'date'     => 'April 2016',
                'datetime' => '2016-04',
                'url'      => route('experiments.synonymizer'),
            ])
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
            @endexperiment

            @experiment([
                'name'     => 'Online Meeting',
                'date'     => 'April 2015',
                'datetime' => '2015-04',
                'url'      => route('experiments.online-meeting'),
            ])
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
            @endexperiment

            @experiment([
                'name'     => 'Freedom Calculator',
                'date'     => 'December 2014',
                'datetime' => '2014-12',
                'url'      => route('experiments.freedom-calculator'),
            ])
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
                    You don't have to worry about me knowing anything on your finances, since I don't record any information (furthermore, I don't even use
                    analytics on the site).
                </p>
            @endexperiment

        </div>

    </article>
@endsection
