<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="mk-hero">
        <div class="mk-wrap mk-hero__inner">
            <p class="mk-label">{{ $page['label'] }}</p>
            <h1 class="mk-title">{{ $page['heading'] }}</h1>
            <p class="mk-lead">{{ $page['lead'] }}</p>
            @if (!empty($page['updated']))
                <p class="mk-meta">Last updated {{ $page['updated'] }}</p>
            @endif
        </div>
    </section>

    <section class="mk-section">
        <div class="mk-wrap mk-prose mk-prose--narrow">
            @foreach ($page['sections'] as $section)
                <article class="mk-block">
                    <h2>{{ $section['heading'] }}</h2>
                    <p>{{ $section['body'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

</x-layouts.site>
