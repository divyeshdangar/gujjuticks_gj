<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="mk-hero">
        <div class="mk-wrap mk-hero__inner">
            <p class="mk-crumbs">
                <a href="{{ route($hubRoute) }}">{{ $hubLabel }}</a>
                <span aria-hidden="true">/</span>
                <span>{{ $page['label'] }}</span>
            </p>
            <p class="mk-label">{{ $page['label'] }}</p>
            <h1 class="mk-title">{{ $page['heading'] }}</h1>
            <p class="mk-lead">{{ $page['lead'] }}</p>
            <div class="mk-actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route($hubRoute) }}">All {{ strtolower($hubLabel) }}</a>
            </div>
        </div>
    </section>

    <section class="mk-section">
        <div class="mk-wrap mk-prose">
            @foreach ($page['sections'] as $section)
                <article class="mk-block">
                    <h2>{{ $section['heading'] }}</h2>
                    @if (!empty($section['body']))
                        <p>{{ $section['body'] }}</p>
                    @endif
                    @if (!empty($section['bullets']))
                        <ul>
                            @foreach ($section['bullets'] as $bullet)
                                <li>{{ $bullet }}</li>
                            @endforeach
                        </ul>
                    @endif
                </article>
            @endforeach
        </div>
    </section>

    @if (!empty($siblings))
        <section class="mk-section mk-section--alt" aria-label="Related">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2>Related</h2>
                </div>
                <div class="mk-grid mk-grid--3">
                    @foreach ($siblings as $item)
                        <a href="{{ route($itemRoute, ['slug' => $item['slug']]) }}" class="mk-card">
                            @if (!empty($item['tag']))
                                <p class="mk-card__tag">{{ $item['tag'] }}</p>
                            @endif
                            <h3 class="mk-card__title">{{ $item['title'] }}</h3>
                            <p class="mk-card__summary">{{ $item['summary'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <p>Want something like this for your team?</p>
            <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Discuss your project</a>
        </div>
    </section>

</x-layouts.site>
