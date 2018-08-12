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
        <loc>{{ route('experiments') }}</loc>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('experiments.synonymizer') }}</loc>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('experiments.online-meeting') }}</loc>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('experiments.freedom-calculator') }}</loc>
        <priority>0.6</priority>
    </url>
</urlset>
