@props(['data', 'lang' => []])

@php
    $href = route('pages.blog.detail', ['slug' => $data->slug]);
    $image = URL::asset('/images/blog/' . $data->image);
    $excerpt = \Illuminate\Support\Str::limit(strip_tags($data->meta_description ?? ''), 110);
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
            <h3 class="jn-card__title">{{ $data->title }}</h3>
            @if ($excerpt)
                <p class="jn-card__excerpt">{{ $excerpt }}</p>
            @endif
        </div>
    </a>
</article>
