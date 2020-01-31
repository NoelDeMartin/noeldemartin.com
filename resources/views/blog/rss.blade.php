<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title type="text">Noel De Martin</title>
    <subtitle type="text">Problem Solver, Software Architect, Entrepreneur</subtitle>
    <updated>{!! $posts->first()->published_at->format(DateTime::ATOM) !!}</updated>
    <id>{!! route('blog') !!}</id>
    <link type="text/html" href="{!! route('blog') !!}" />
    <link type="application/atom+xml" rel="self" href="{!! route('blog.rss') !!}" />
    <category term="entrepreneurship"/>
    <category term="development"/>
    <icon>{!! asset('favicon.ico') !!}</icon>
    <logo>{!! asset('img/myface-small.png') !!}</logo>
    <author>
        <name>Noel De Martin</name>
        <email>noeldemartin@gmail.com</email>
        <uri>{!! route('home') !!}</uri>
    </author>
    @foreach($posts as $post)
        <entry>
            <title type="text">{!! $post->title !!}</title>
            <author>
                <name>Noel De Martin</name>
                <email>noeldemartin@gmail.com</email>
                <uri>{!! route('home') !!}</uri>
            </author>
            <link href="{!! route('posts.show', $post->tag) !!}" />
            <id>{!! route('posts.show', $post->tag) !!}</id>
            <published>{!! $post->published_at->format(DateTime::ATOM) !!}</published>
            <updated>{!! $post->updated_at->format(DateTime::ATOM) !!}</updated>
            <summary type="html">{!! htmlspecialchars($post->summary_html) !!}</summary>
            <content type="html" xml:base="{!! route('posts.show', $post->tag) !!}">
                {!! htmlspecialchars($post->text_html) !!}
            </content>
        </entry>
    @endforeach
</feed>
