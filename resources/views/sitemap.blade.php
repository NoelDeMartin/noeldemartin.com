<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('blog') }}</loc>
        <priority>1.0</priority>
    </url>
    @foreach($posts as $post)
        <url>
            <loc>{{ route('posts.show', $post->tag) }}</loc>
            <lastmod>{{ $post->modified_at->toW3cString() }}</lastmod>
            <priority>1.0</priority>
        </url>
    @endforeach
    <url>
        <loc>{{ route('projects.index') }}</loc>
        <priority>1.0</priority>
    </url>
    @foreach($projects as $project)
        <url>
            <loc>{{ route('projects.show', $project) }}</loc>
            <priority>0.8</priority>
        </url>
    @endforeach
    <url>
        <loc>{{ route('talks') }}</loc>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('experiments') }}</loc>
        <priority>0.4</priority>
    </url>
    <url>
        <loc>{{ route('experiments.synonymizer') }}</loc>
        <priority>0.2</priority>
    </url>
    <url>
        <loc>{{ route('experiments.online-meeting') }}</loc>
        <priority>0.2</priority>
    </url>
    <url>
        <loc>{{ route('experiments.freedom-calculator') }}</loc>
        <priority>0.2</priority>
    </url>
    <url>
        <loc>{{ route('now') }}</loc>
        <lastmod>{{ $lastModificationDate->toW3cString() }}</lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('tasks.index') }}</loc>
        <lastmod>{{ $tasks->last()->created_at->toW3cString() }}</lastmod>
        <priority>0.8</priority>
    </url>
    @foreach($tasks as $task)
        <url>
            <loc>{{ $task->url }}</loc>
            <lastmod>{{ $task->modified_at->toW3cString() }}</lastmod>
            <priority>0.6</priority>
        </url>
    @endforeach
    <url>
        <loc>{{ route('site') }}</loc>
        <priority>0.4</priority>
    </url>
</urlset>
