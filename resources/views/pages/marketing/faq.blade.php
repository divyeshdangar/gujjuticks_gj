<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="cs-hero">
        <div class="mk-wrap cs-hero__inner">
            <p class="mk-label">{{ $page['label'] }}</p>
            <h1 class="mk-title">{{ $page['heading'] }}</h1>
            <p class="mk-lead">{{ $page['lead'] }}</p>
            @if (!empty($page['intro']))
                <p class="cs-hub__intro">{{ $page['intro'] }}</p>
            @endif
            <div class="mk-actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Ask a question</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">Browse services</a>
            </div>
        </div>
    </section>

    @foreach ($page['groups'] ?? [] as $group)
        <section class="mk-section {{ $loop->even ? 'mk-section--alt' : '' }}" aria-labelledby="faq-group-{{ $loop->index }}">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="faq-group-{{ $loop->index }}">{{ $group['heading'] }}</h2>
                </div>
                <div class="sv-faq">
                    @foreach ($group['items'] as $item)
                        <details class="sv-faq__item">
                            <summary>{{ $item['q'] }}</summary>
                            <p>{{ $item['a'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    <section class="mk-section">
        <div class="mk-wrap">
            <div class="mk-section__head">
                <h2>Related pages</h2>
                <p>More detail on process, buying, and proof.</p>
            </div>
            <div class="mk-grid mk-grid--3">
                <a href="{{ route('pages.how-we-work') }}" class="mk-card">
                    <p class="mk-card__tag">Process</p>
                    <h3 class="mk-card__title">How we work</h3>
                    <p class="mk-card__summary">Discovery through launch and support.</p>
                </a>
                <a href="{{ route('pages.engagements') }}" class="mk-card">
                    <p class="mk-card__tag">Buy</p>
                    <h3 class="mk-card__title">Engagements</h3>
                    <p class="mk-card__summary">Workshop, build, or retainer.</p>
                </a>
                <a href="{{ route('pages.work') }}" class="mk-card">
                    <p class="mk-card__tag">Proof</p>
                    <h3 class="mk-card__title">Work</h3>
                    <p class="mk-card__summary">Selected case studies.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <div>
                @if (!empty($page['cta']['eyebrow']))
                    <p class="cs-cta__eyebrow">{{ $page['cta']['eyebrow'] }}</p>
                @endif
                <p>{{ $page['cta']['text'] ?? 'Ask us directly.' }}</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
            </div>
        </div>
    </section>

</x-layouts.site>
