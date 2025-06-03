@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
    @else
        <a class="btn btn-primary mx-1" href="{{ $paginator->previousPageUrl() }}" rel="prev"
            aria-label="@lang('pagination.previous')">@lang('pagination.previous')</a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="btn btn-primary mx-1" href="{{ $paginator->nextPageUrl() }}" rel="next"
            aria-label="@lang('pagination.next')">@lang('pagination.next')</a>
    @else
    @endif
@endif
