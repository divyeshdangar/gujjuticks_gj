@props(['data', 'lang' => []])

@php
    $href = route('pages.blog.detail', ['slug' => $data->slug]);
    $image = URL::asset('/images/blog/' . $data->image);
    $excerpt = \Illuminate\Support\Str::limit(strip_tags($data->meta_description ?? ''), 140);
@endphp

<article>
    <a href="{{ $href }}" class="blogs-item">
        <figure class="blogs-item__media">
            <img src="{{ $image }}" alt="{{ $data->title }}" width="640" height="400" loading="lazy"
                decoding="async">
        </figure>
        <div class="blogs-item__body">
            <div class="blogs-item__meta">
                @if ($data->user)
                    <span>{{ ucwords($data->user->name) }}</span>
                @endif
                <time datetime="{{ $data->created_at->toAtomString() }}">
                    {{ $data->created_at->format('j M Y') }}
                </time>
                @if ($data->category)
                    <span>{{ $data->category->title }}</span>
                @endif
            </div>
            <h3 class="blogs-item__title">{{ $data->title }}</h3>
            @if ($excerpt)
                <p class="blogs-item__excerpt">{{ $excerpt }}</p>
            @endif
            <span class="blogs-item__more">Read article →</span>
        </div>
    </a>
</article>
