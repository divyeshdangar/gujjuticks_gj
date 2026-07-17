@props(['item'])

@php
    $detailUrl = $item->detailUrl();
@endphp

<a href="{{ $detailUrl }}" class="d-block text-decoration-none updates-similar-item">
    <div class="p-2 rounded border h-100" style="transition: border-color .2s ease;">
        <div class="d-flex flex-wrap gap-1 align-items-center mb-1">
            <x-updates.type-badge :type="$item->type" class="small" />
            @if($item->category)
                <span class="small text-muted">{{ $item->category->name }}</span>
            @endif
        </div>
        <span class="d-block small fw-semibold text-dark">{{ Str::limit($item->title, 72) }}</span>
        <span class="small text-muted">{{ $item->city?->name }} · {{ $item->created_at?->diffForHumans() }}</span>
    </div>
</a>

@once
    <style>
        .updates-similar-item:hover > div {
            border-color: var(--bs-warning) !important;
        }
    </style>
@endonce
