@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
    @else
        <a class="btn btn-warning mx-1" style="color: rgb(19, 19, 19) !important;" href="{{ $paginator->previousPageUrl() }}" rel="prev"
            aria-label="@lang('pagination.previous')">@lang('pagination.previous')</a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="btn btn-warning mx-1" style="color: rgb(19, 19, 19) !important;" href="{{ $paginator->nextPageUrl() }}" rel="next"
            aria-label="@lang('pagination.next')">@lang('pagination.next')</a>
    @else
    @endif
@endif
