<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="cs-hero">
        <div class="mk-wrap cs-hero__inner">
            <p class="mk-label">{{ $hub['label'] }}</p>
            <h1 class="mk-title">{{ $hub['heading'] }}</h1>
            <p class="mk-lead">{{ $hub['lead'] }}</p>
            @if (!empty($hub['intro']))
                <p class="cs-hub__intro">{{ $hub['intro'] }}</p>
            @endif
        </div>
    </section>

    <section class="mk-section" aria-label="Technology">
        <div class="mk-wrap">
            <div class="cs-hub__list">
                @foreach ($items as $item)
                    <a href="{{ route('pages.technology.show', ['slug' => $item['slug']]) }}" class="cs-hub__card">
                        <div class="cs-hub__card-top">
                            <p class="mk-card__tag">{{ $item['category'] }}</p>
                            @if (!empty($item['best_for']))
                                <span class="cs-hub__duration">{{ $item['best_for'] }}</span>
                            @endif
                        </div>
                        <h2 class="cs-hub__card-title">{{ $item['title'] }}</h2>
                        <p class="cs-hub__card-summary">{{ $item['summary'] }}</p>

                        @if (!empty($item['highlights']))
                            <div class="cs-hub__metrics">
                                @foreach (array_slice($item['highlights'], 0, 3) as $metric)
                                    <div>
                                        <p class="cs-hub__metric-value">{{ $metric['value'] }}</p>
                                        <p class="cs-hub__metric-label">{{ $metric['label'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if (!empty($item['tools']))
                            <ul class="cs-stack cs-stack--compact" aria-hidden="true">
                                @foreach (array_slice($item['tools'], 0, 4) as $tool)
                                    <li>{{ $tool }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <span class="mk-card__more">Explore stack</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mk-section mk-section--alt">
        <div class="mk-wrap">
            <div class="mk-section__head">
                <h2>How we choose technology</h2>
                <p>Stack decisions should serve the product — not the resume.</p>
            </div>
            <div class="cs-features">
                <article class="cs-features__item">
                    <h3>Fit over fashion</h3>
                    <p>We pick tools that match your timeline, team, and maintenance reality.</p>
                </article>
                <article class="cs-features__item">
                    <h3>One clear spine</h3>
                    <p>A solid backend and API make front-end and mobile work simpler.</p>
                </article>
                <article class="cs-features__item">
                    <h3>Ship with ops</h3>
                    <p>Hosting, SSL, and deploys are part of delivery — not an afterthought.</p>
                </article>
                <article class="cs-features__item">
                    <h3>Leave it extendable</h3>
                    <p>Code and docs your next engineer can grow without a rewrite.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <div>
                <p class="cs-cta__eyebrow">Talk stack</p>
                <p>Not sure which layer you need first? We will help you choose.</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">View services</a>
            </div>
        </div>
    </section>

</x-layouts.site>
