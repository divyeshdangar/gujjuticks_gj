<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="cs-hero">
        <div class="mk-wrap cs-hero__inner">
            <p class="mk-label">{{ $hub['label'] }}</p>
            <h1 class="mk-title">{{ $hub['heading'] }}</h1>
            <p class="mk-lead">{{ $hub['lead'] }}</p>
            @if (!empty($hub['intro']))
                <p class="cs-hub__intro">{{ $hub['intro'] }}</p>
            @endif
            <div class="mk-actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">Browse services</a>
            </div>
        </div>
    </section>

    <section class="mk-section" aria-label="Decision guides" id="compare-list">
        <div class="mk-wrap">
            <div class="mk-section__head">
                <h2>Decision guides</h2>
                <p>Answer-first comparisons for common buying questions.</p>
            </div>
            <div class="mk-grid mk-grid--2">
                @foreach ($items as $item)
                    <a href="{{ route('pages.compare.show', ['slug' => $item['slug']]) }}" class="mk-card">
                        @if (!empty($item['tag']))
                            <p class="mk-card__tag">{{ $item['tag'] }}</p>
                        @endif
                        <h2 class="mk-card__title">{{ $item['title'] }}</h2>
                        <p class="mk-card__summary">{{ $item['summary'] }}</p>
                        <span class="mk-card__more">Read guide</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <div>
                <p class="cs-cta__eyebrow">Already know the path?</p>
                <p>Tell us what you want to launch — we typically reply within one business day.</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.stack') }}">Tech stack quiz</a>
            </div>
        </div>
    </section>

</x-layouts.site>
