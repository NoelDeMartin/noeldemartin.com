@extends('layouts.master')

@section('content')
    <article>
        <h1>MoodleNet</h1>

        <p>
            <a href="https://moodle.net" target="_blank">MoodleNet</a> is a federated social media
            platform for educators built by <a href="https://moodle.com" target="_blank">Moodle</a>.
        </p>

        <p>
            Back in 2020, <a href="/tasks/configuring-a-moodlenet-instance">I hosted my own instance</a> at
            <code>https://learn.noeldemartin.social</code> to play around with it. It was my intention to
            host it for a while, and maybe even end up being the home for my educational resources.
        </p>

        <p>
            However, most of my interest in MoodleNet lay in the fact that it used
            <a href="https://www.w3.org/TR/activitypub/" target="_blank">ActivityPub</a>, a protocol that
            powers other decentralized social media platforms like <a href="https://joinmastodon.org/"
            target="_blank">Mastodon</a> or <a href="https://pleroma.social/" target="_blank">Pleroma</a>.
            But in 2021, <a
            href="https://moodle.org/mod/forum/discuss.php?d=422885" target="_blank">MoodleNet moved
            away from ActivityPub</a>, so I lost interest in using it any further.
        </p>

        <p>
            Currently, I don't have any intention to host a new instance or anything else for this purpose. But
            I'm writing this down in case you stumble upon the dead link and wonder what happened with it.
        </p>

        <p>Now you know :).</p>
    </article>
@endsection
