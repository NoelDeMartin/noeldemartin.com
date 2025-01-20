<?php echo '<?xml version="1.0" encoding="utf-8" ?>' . "\n"; ?>
<?php echo '<?xml-stylesheet type="text/xsl" href="' . route('now.xsl') . '" ?>' . "\n"; ?>

<feed xmlns="http://www.w3.org/2005/Atom">
    <title type="text">Noel De Martin [Journal]</title>
    <subtitle type="text">A stream of all my activity</subtitle>
    <updated>{!! $events[0]->date->format(DateTime::ATOM) !!}</updated>
    <id>{!! sroute('now') !!}</id>
    <link type="text/html" href="{!! sroute('now') !!}" />
    <link type="application/xml" rel="self" href="{!! route('now.rss') !!}" />
    <category term="entrepreneurship" />
    <category term="development" />
    <icon>{!! asset('favicon.ico') !!}</icon>
    <logo>{!! asset('img/myface-small.png') !!}</logo>
    <author>
        <name>Noel De Martin</name>
        <email>{{ sglobal('contact.email') }}</email>
        <uri>{!! sroute('home') !!}</uri>
    </author>
    @foreach ($events as $event)
        <entry>
            <title type="text">{!! $event->title !!}</title>
            <author>
                <name>Noel De Martin</name>
                <email>{{ sglobal('contact.email') }}</email>
                <uri>{!! sroute('home') !!}</uri>
            </author>
            <link href="{!! $event->url !!}" />
            <id>{!! $event->url !!}</id>
            <published>{!! $event->date->format(DateTime::ATOM) !!}</published>
            <updated>{!! $event->date->format(DateTime::ATOM) !!}</updated>
            <summary type="html">
                {!! htmlspecialchars($event->description) !!}
            </summary>
            <content type="html">
                {!! htmlspecialchars($event->longDescription) !!}
            </content>
        </entry>
    @endforeach
</feed>
