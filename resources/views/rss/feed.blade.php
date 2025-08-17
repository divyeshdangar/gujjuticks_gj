{!! '<?xml version="1.0" encoding="UTF-8" ?>' !!}
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
<channel>
    <title>Insights and Stories from GujjuTicks Blogs</title>
    <link>{{ route('pages.blog.list') }}</link>
    <description>Explore insightful blogs on Gujju culture, traditions, cuisine, and more. Discover fascinating stories and tips that celebrate the vibrant spirit of Gujarat, brought to you by GujjuTicks.</description>

    @foreach ($blogs as $blog)
        <item>
            <title><![CDATA[{{ $blog->title }}]]></title>
            <link>{{ route('pages.blog.detail', ['slug' => $blog->slug]) }}</link>
            <description><![CDATA[{!! Str::limit($blog->meta_description, 150) !!}]]></description>
            <pubDate>{{ $blog->created_at->toRssString() }}</pubDate>
            @if(!empty($blog->image))
                <enclosure url="{{ URL::asset('/images/blog/' . $blog->image) }}" type="image/png" />
            @endif
        </item>
    @endforeach
</channel>
</rss>
