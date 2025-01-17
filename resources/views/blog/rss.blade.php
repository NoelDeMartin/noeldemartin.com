<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>

<?php echo '<?xml-stylesheet type="text/xsl" href="' .
    route('blog.xsl') .
    '" ?>' .
    "\n"; ?>

<feed xmlns="http://www.w3.org/2005/Atom">
    <title type="text">Noel De Martin</title>
    <subtitle type="text">
        Problem Solver, Software Architect, Entrepreneur
    </subtitle>
    <updated>
        {!! $posts[0]->publication_date->format(DateTime::ATOM) !!}
    </updated>
    <id>{!! sroute('blog') !!}</id>
    <link type="text/html" href="{!! sroute('blog') !!}" />
    <link type="application/xml" rel="self" href="{!! route('blog.rss') !!}" />
    <category term="entrepreneurship" />
    <category term="development" />
    <icon>{!! asset('favicon.ico') !!}</icon>
    <logo>{!! asset('img/myface-small.png') !!}</logo>
    <author>
        <name>Noel De Martin</name>
        <email>{{ sglobal('contact.email') }}</email>
        <uri>{!! sroute('home') !!}</uri>
    </author>
    @foreach ($posts as $post)
        <entry>
            <title type="text">{!! $post->title !!}</title>
            <author>
                <name>Noel De Martin</name>
                <email>{{ sglobal('contact.email') }}</email>
                <uri>{!! sroute('home') !!}</uri>
            </author>
            <link href="{!! sroute('blog', $post->slug) !!}" />
            <id>{!! sroute('blog', $post->slug) !!}</id>
            <published>
                {!! $post->publication_date->format(DateTime::ATOM) !!}
            </published>
            <updated>
                {!! ($post->modification_date ?? $post->publication_date)->format(DateTime::ATOM) !!}
            </updated>
            <summary type="html">
                {!! htmlspecialchars($post->summary) !!}
            </summary>
            <content
                type="html"
                xml:base="{!! sroute('blog', $post->slug) !!}"
            >
                {!! htmlspecialchars($post->content) !!}
            </content>
        </entry>
    @endforeach
</feed>
