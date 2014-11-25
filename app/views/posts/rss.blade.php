<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Noel De Martin Blog</title>
		<link>{{ url('blog') }}</link>
		<atom:link href="{{ url('blog.rss') }}" rel="self" type="application/rss+xml" />
		<description>Personal Blog of Noel De Martin - Developer Entrepreneur</description>
		<language>en-us</language>
		<webMaster>noeldemartin@gmail.com</webMaster>
		@foreach($posts as $post)
			<item>
				<title>{{ $post->title }}</title>
				<link>{{ route('posts.show', $post->tag) }}</link>
				<guid>{{ route('posts.show', $post->tag) }}</guid>
				<pubDate>{{ $post->published_at->format(DateTime::RFC822) }}</pubDate>
				<author>noeldemartin@gmail.com (Noel De Martin)</author>
			</item>
		@endforeach
	</channel>
</rss>