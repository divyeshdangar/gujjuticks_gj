<div class="{{ $class ?? '' }}">
    @php
        $initials = \App\Helpers\CommonHelper::getInitials($data->title);
        $thumb = route('pages.image.cool', ['slug' => 'characters-' . $initials . '.jpg']);
        $excerpt = \Illuminate\Support\Str::limit(strip_tags($data->content ?? ''), 160);
        $href = !empty($data->link) ? $data->link : null;
    @endphp
    <article class="nw-story">
        <figure class="nw-story__media">
            <img src="{{ $thumb }}" alt="" width="320" height="200" loading="lazy" decoding="async">
        </figure>
        <div class="nw-story__body">
            <h3 class="nw-story__title">
                @if ($href)
                    <a href="{{ $href }}" rel="noopener noreferrer" target="_blank">{!! $data->title !!}</a>
                @else
                    {!! $data->title !!}
                @endif
            </h3>
            @if ($excerpt)
                <p class="nw-story__excerpt">{{ $excerpt }}</p>
            @endif
        </div>
    </article>
</div>
