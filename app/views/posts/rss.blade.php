<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
	<channel>
		<title>Noel De Martin Blog</title>
		<link>{{ url('blog') }}</link>
		<description>Personal Blog of Noel De Martin - Developer Entrepreneur</description>
		<language>en-us</language>
		<webMaster>noeldemartin@gmail.com</webMaster>
		@foreach($posts as $post)
			<item>
				<title>{{ $post->title }}</title>
				<link>{{ route('posts.show', $post->tag) }}</link>
				<pubDate>{{ $post->published_at->toFormattedDateString() }}</pubDate>
				<author>noeldemartin@gmail.com</author>
			</item>
		@endforeach
	</channel>
</rss>