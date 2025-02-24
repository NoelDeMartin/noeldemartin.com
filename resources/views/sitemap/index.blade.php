<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ sroute('home') }}</loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ sroute('blog') }}</loc>
        <priority>1.0</priority>
    </url>
    @foreach ($posts as $post)
        <url>
            <loc>{{ $post->url() }}</loc>
            <lastmod>
                {{ ($post->modification_date ?? $post->publication_date)->toW3cString() }}
            </lastmod>
            <priority>1.0</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ sroute('projects') }}</loc>
        <priority>1.0</priority>
    </url>
    @foreach ($projects as $project)
        <url>
            <loc>{{ $project->url() }}</loc>
            <priority>0.8</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ sroute('talks') }}</loc>
        <priority>0.6</priority>
    </url>

    @foreach ($talks as $talk)
        <url>
            <loc>{{ $talk->slidesUrl }}</loc>
            <priority>0.4</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ sroute('japan-tips') }}</loc>
        <priority>0.4</priority>
    </url>
    <url>
        <loc>{{ sroute('now') }}</loc>
        <lastmod>{{ $lastModificationDate->toW3cString() }}</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ sroute('tasks') }}</loc>
        <lastmod>
            {{ $tasks->last()->modification_date->toW3cString() }}
        </lastmod>
        <priority>0.8</priority>
    </url>
    @foreach ($tasks as $task)
        <url>
            <loc>{{ $task->url }}</loc>
            <lastmod>{{ $task->modification_date->toW3cString() }}</lastmod>
            <priority>0.6</priority>
        </url>
    @endforeach

    <url>
        <loc>{{ sroute('site') }}</loc>
        <priority>0.4</priority>
    </url>
</urlset>
