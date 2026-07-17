{!! '<?xml version="1.0" encoding="UTF-8" ?>' !!}
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
<channel>
    <title>Insights from GujjuTicks — Software, Tech & AI</title>
    <link>{{ route('pages.blog.list') }}</link>
    <description>Articles from GujjuTicks on software, technology, AI products, and building digital tools for modern businesses.</description>

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
