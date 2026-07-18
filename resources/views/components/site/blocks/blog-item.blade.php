@props(['data', 'lang' => [], 'search' => null])

@php
    $href = route('pages.blog.detail', ['slug' => $data->slug]);
    $image = !empty($data->image)
        ? URL::asset('/images/blog/' . $data->image)
        : asset('files/images/blogs-listing-page.png');
    $excerpt = \Illuminate\Support\Str::limit(strip_tags($data->meta_description ?? ''), 110);
    $term = $search ?? request('search');
@endphp

<article>
    <a href="{{ $href }}" class="jn-card">
        <figure class="jn-card__media">
            <img src="{{ $image }}" alt="" width="640" height="360" loading="lazy" decoding="async">
        </figure>
        <div class="jn-card__body">
            <div class="jn-meta">
                @if ($data->category)
                    <span>{{ $data->category->title }}</span>
                    <span class="jn-meta__dot" aria-hidden="true"></span>
                @endif
                <time datetime="{{ $data->created_at->toAtomString() }}">
                    {{ $data->created_at->format('M j, Y') }}
                </time>
            </div>
            <h3 class="jn-card__title">{!! \App\Helpers\CommonHelper::highlightKeywords($data->title, $term) !!}</h3>
            @if ($excerpt)
                <p class="jn-card__excerpt">{!! \App\Helpers\CommonHelper::highlightKeywords($excerpt, $term) !!}</p>
            @endif
        </div>
    </a>
</article>
