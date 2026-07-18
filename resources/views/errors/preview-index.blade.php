@php
    $metaData = [
        'title' => 'Error page previews | GujjuTicks',
        'description' => 'Local preview links for redesigned HTTP error pages.',
        'url' => url('/dev/errors'),
        'robots' => 'noindex, nofollow',
    ];
    $pages = [
        ['code' => 403, 'name' => 'Forbidden', 'hint' => 'Access not available'],
        ['code' => 404, 'name' => 'Not Found', 'hint' => 'Page not available'],
        ['code' => 419, 'name' => 'Page Expired', 'hint' => 'Session not available'],
        ['code' => 429, 'name' => 'Too Many Requests', 'hint' => 'Rate limited'],
        ['code' => 500, 'name' => 'Server Error', 'hint' => 'Something went wrong'],
        ['code' => 503, 'name' => 'Service Unavailable', 'hint' => 'Temporarily unavailable'],
    ];
@endphp

<x-layouts.site :metaData="$metaData" page="error">
    <div class="er-page">
        <section class="er-shell" style="grid-template-columns: 1fr; max-width: 40rem;">
            <div class="er-copy">
                <p class="er-kicker"><span class="er-kicker__dot"></span> Local only</p>
                <h1 class="er-title" id="er-title">Error page previews</h1>
                <p class="er-lead">
                    Open each link to review the redesigned status pages. These routes are available in local only.
                </p>
                <ul class="er-preview-list">
                    @foreach ($pages as $page)
                        <li>
                            <a href="{{ url('/dev/errors/' . $page['code']) }}">
                                <strong>{{ $page['code'] }}</strong>
                                <span>{{ $page['name'] }} — {{ $page['hint'] }}</span>
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ url('/this-page-does-not-exist-demo') }}">
                            <strong>404*</strong>
                            <span>Natural miss — any unknown URL</span>
                        </a>
                    </li>
                </ul>
                <div class="er-actions">
                    <a class="er-btn er-btn--solid" href="{{ route('home') }}">Back to home</a>
                </div>
            </div>
        </section>
    </div>
</x-layouts.site>
