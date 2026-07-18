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
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.brief') }}">Build a brief</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.estimate') }}">Rough estimate</a>
                <a class="mk-btn mk-btn--ghost" href="#service-list">Browse services</a>
            </div>
        </div>
    </section>

    @if (!empty($hub['highlights']))
        <section class="cs-highlights" aria-label="Service highlights">
            <div class="mk-wrap cs-highlights__grid">
                @foreach ($hub['highlights'] as $item)
                    <div class="cs-highlights__item">
                        <p class="cs-highlights__value">{{ $item['value'] }}</p>
                        <p class="cs-highlights__label">{{ $item['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="mk-section" id="service-list" aria-label="Services">
        <div class="mk-wrap">
            <div class="mk-section__head">
                <h2>Choose a service</h2>
                <p>Three ways we help — each with a clear path from brief to launch.</p>
            </div>
            <div class="cs-hub__list">
                @foreach ($items as $item)
                    <a href="{{ route('pages.services.show', ['slug' => $item['slug']]) }}" class="cs-hub__card">
                        <div class="cs-hub__card-top">
                            <p class="mk-card__tag">{{ $item['tag'] }} · {{ $item['category'] }}</p>
                            @if (!empty($item['timeline']))
                                <span class="cs-hub__duration">{{ $item['timeline'] }}</span>
                            @endif
                        </div>
                        <h2 class="cs-hub__card-title">{{ $item['title'] }}</h2>
                        <p class="cs-hub__card-summary">{{ $item['summary'] }}</p>

                        @if (!empty($item['ideal_for']))
                            <p class="sv-hub__ideal"><span>Ideal for</span> {{ $item['ideal_for'] }}</p>
                        @endif

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

                        <span class="mk-card__more">Explore {{ strtolower($item['title']) }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @if (!empty($hub['who']))
        <section class="mk-section mk-section--alt" aria-labelledby="svc-who-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="svc-who-heading">{{ $hub['who']['heading'] }}</h2>
                    <p>Whether you are launching something new or fixing how work runs today.</p>
                </div>
                <div class="cs-features cs-features--3">
                    @foreach ($hub['who']['items'] as $item)
                        <article class="cs-features__item">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($hub['process']))
        <section class="mk-section" aria-labelledby="svc-process-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="svc-process-heading">From brief to launch</h2>
                    <p>The same delivery rhythm across apps, websites, and software.</p>
                </div>
                <ol class="cs-timeline">
                    @foreach ($hub['process'] as $step)
                        <li class="cs-timeline__item">
                            <span class="cs-timeline__phase">{{ $step['phase'] }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>
    @endif

    @if (!empty($hub['principles']))
        <section class="mk-section mk-section--alt" aria-labelledby="svc-principles-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="svc-principles-heading">{{ $hub['principles']['heading'] }}</h2>
                    <p>What you can expect when you work with GujjuTicks.</p>
                </div>
                <div class="cs-features">
                    @foreach ($hub['principles']['items'] as $item)
                        <article class="cs-features__item">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="mk-section">
        <div class="mk-wrap">
            <div class="mk-section__head">
                <h2>Not sure which service fits?</h2>
                <p>Send a short brief — we will recommend the right starting point.</p>
            </div>
            <div class="sv-hub__hints">
                <a href="{{ route('pages.services.show', ['slug' => 'custom-apps']) }}" class="sv-hub__hint">
                    <strong>Need users to log in and complete a job?</strong>
                    <span>Start with custom apps</span>
                </a>
                <a href="{{ route('pages.services.show', ['slug' => 'websites']) }}" class="sv-hub__hint">
                    <strong>Need a sharper public presence?</strong>
                    <span>Start with websites</span>
                </a>
                <a href="{{ route('pages.services.show', ['slug' => 'custom-software']) }}" class="sv-hub__hint">
                    <strong>Need ops tools or integrations?</strong>
                    <span>Start with custom software</span>
                </a>
            </div>
        </div>
    </section>

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <div>
                <p class="cs-cta__eyebrow">Let’s scope your v1</p>
                <p>Tell us what you want to launch. We typically reply within one business day.</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.brief') }}">Build a brief</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.estimate') }}">Rough estimate</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.how-we-work') }}">How we work</a>
            </div>
        </div>
    </section>

</x-layouts.site>
