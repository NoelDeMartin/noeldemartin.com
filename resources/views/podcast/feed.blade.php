<?php echo '<?xml version="1.0" encoding="utf-8" ?>' . "\n"; ?>
<?php echo '<?xml-stylesheet type="text/xsl" href="' . route('podcast.style') . '" ?>' . "\n"; ?>
<rss xmlns:podcast="https://podcastindex.org/namespace/1.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" xml:lang="en" version="2.0">
    <channel>
        <title>Noel De Martin</title>
        <description>I don't really have a podcast, but I published an episode once generated with NotebookLM.</description>
        <link>{{ route('podcast.index') }}</link>
        <atom:link href="{{ route('podcast.feed') }}" rel="self" type="application/rss+xml"/>
        <lastBuildDate>Fri Nov 08 2024 11:18:48 GMT+0700</lastBuildDate>
        <language>en-us</language>
        <itunes:image href="{{ asset('img/myface.png') }}"/>
        <podcast:guid>8651f507-c9eb-518b-a4dc-19296559426f</podcast:guid>
        <image>
            <url>{{ asset('img/myface.png') }}</url>
            <title>Noel De Martin</title>
            <link>{{ route('podcast.index') }}</link>
        </image>
        <itunes:author>Noel De Martin</itunes:author>
        <itunes:owner>
            <itunes:name>Noel De Martin</itunes:name>
        </itunes:owner>
        <itunes:explicit>false</itunes:explicit>
        <podcast:medium>podcast</podcast:medium>
        @foreach (trans('podcast.episodes') as $episode)
            <item>
                <title>{{ $episode['title'] }}</title>
                <itunes:title>{{ $episode['title'] }}</itunes:title>
                <description><![CDATA[{!! markdown_cdata($episode['content']) !!}]]></description>
                <link>{{ route('podcast.index') }}</link>
                <enclosure url="{{ url('/downloads/podcast/' . $episode['filename']) }}" length="{{ $episode['filelength'] }}" type="audio/mpeg"/>
                <guid>{{ url('/downloads/podcast/' . $episode['filename']) }}</guid>
                <itunes:duration>{{ $episode['duration'] }}</itunes:duration>
                <itunes:episodeType>full</itunes:episodeType>
                <itunes:episode>0</itunes:episode>
                <podcast:episode>0</podcast:episode>
                <itunes:explicit>false</itunes:explicit>
                <pubDate>Fri Nov 08 2024 11:18:48 GMT+0700</pubDate>
                <itunes:image href="{{ asset('img/myface.png') }}"/>
            </item>
        @endforeach
    </channel>
</rss>
