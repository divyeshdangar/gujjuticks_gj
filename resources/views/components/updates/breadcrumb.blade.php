@props(['items'])

@once
    <style>
        .breadcrumb-updates {
            text-align: left;
        }
        .breadcrumb-updates .breadcrumb-item {
            text-transform: none;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .breadcrumb-updates .breadcrumb-item::before {
            content: none !important;
            font-family: inherit !important;
            padding-right: 0;
        }
        .breadcrumb-updates .breadcrumb-item + .breadcrumb-item::before {
            content: "/" !important;
            color: var(--bs-secondary-color);
            float: left;
            padding-right: 0.5rem;
        }
        .breadcrumb-updates .breadcrumb-item a {
            color: var(--bs-warning);
            text-decoration: none;
        }
        .breadcrumb-updates .breadcrumb-item a:hover {
            color: var(--bs-warning);
            text-decoration: underline;
        }
        .breadcrumb-updates .breadcrumb-item.active {
            color: var(--bs-secondary-color);
        }
    </style>
@endonce

<nav aria-label="breadcrumb" {{ $attributes }}>
    <ol class="breadcrumb breadcrumb-updates mb-0">
        @foreach($items as $item)
            @if($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
