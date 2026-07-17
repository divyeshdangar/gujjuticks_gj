@props(['item'])

@php
    $detailUrl = $item->detailUrl();
@endphp

<article class="card blog-grid-box h-100 border shadow-sm updates-feed-card">
    @if($item->type === 'image' && $item->image)
        <a href="{{ $detailUrl }}" class="d-block overflow-hidden">
            <img src="{{ asset('images/updates/' . $item->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $item->title }}" loading="lazy">
        </a>
    @elseif($item->type === 'youtube')
        <div class="card-img-top d-flex align-items-center justify-content-center bg-dark" style="height: 120px;">
            <span class="text-white-50 small text-uppercase fw-semibold">YouTube update</span>
        </div>
    @elseif($item->type === 'poll')
        <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 120px; background: linear-gradient(135deg, rgba(255,193,7,.15), rgba(255,193,7,.05));">
            <span class="text-warning small text-uppercase fw-semibold">Community poll</span>
        </div>
    @endif

    <div class="card-body d-flex flex-column">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
            <div class="d-flex flex-wrap gap-1 align-items-center">
                <x-updates.type-badge :type="$item->type" />
                @if($item->privacy === 'private')
                    <span class="badge bg-dark">Private</span>
                @endif
                @if($item->category?->is_important)
                    <span class="badge bg-danger">Important</span>
                @endif
            </div>
            <time class="text-muted small" datetime="{{ $item->created_at?->toIso8601String() }}">{{ $item->created_at?->diffForHumans() }}</time>
        </div>

        <h2 class="h5 card-title mb-2">
            <a href="{{ $detailUrl }}" class="text-decoration-none text-dark">{{ $item->title }}</a>
        </h2>

        <p class="small text-muted mb-2">
            <span>{{ $item->city?->name }}</span>
            <span class="mx-1">·</span>
            <span>{{ $item->category?->name }}</span>
            @if($item->creator?->name)
                <span class="mx-1">·</span>
                <span>{{ $item->creator->name }}</span>
            @endif
        </p>

        @if($item->description)
            <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit(strip_tags($item->description), 160) }}</p>
        @else
            <div class="flex-grow-1"></div>
        @endif

        <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-auto">
            <span class="small text-muted">
                {{ $item->comments_count }} {{ Str::plural('comment', $item->comments_count) }}
                <span class="mx-1">·</span>
                {{ $item->reactions_count }} {{ Str::plural('reaction', $item->reactions_count) }}
            </span>
            <a href="{{ $detailUrl }}" class="btn btn-warning btn-sm" style="color: rgb(19, 19, 19) !important;">Read update</a>
        </div>
    </div>
</article>
