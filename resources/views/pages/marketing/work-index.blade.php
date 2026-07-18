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

    <section class="mk-section" aria-label="Case studies">
        <div class="mk-wrap">
            <div class="cs-hub__list">
                @foreach ($items as $item)
                    <a href="{{ route('pages.work.show', ['slug' => $item['slug']]) }}" class="cs-hub__card">
                        <div class="cs-hub__card-top">
                            <p class="mk-card__tag">{{ $item['industry'] }}</p>
                            @if (!empty($item['duration']))
                                <span class="cs-hub__duration">{{ $item['duration'] }}</span>
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

                        @if (!empty($item['stack']))
                            <ul class="cs-stack cs-stack--compact" aria-hidden="true">
                                @foreach (array_slice($item['stack'], 0, 4) as $tech)
                                    <li>{{ $tech }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <span class="mk-card__more">Read case study</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mk-section mk-section--alt">
        <div class="mk-wrap">
            <div class="mk-section__head">
                <h2>What these projects share</h2>
                <p>Different products — the same delivery habits.</p>
            </div>
            <div class="cs-features">
                <article class="cs-features__item">
                    <h3>Clear scope first</h3>
                    <p>We lock what “done” means before heavy build work — so launches stay honest.</p>
                </article>
                <article class="cs-features__item">
                    <h3>Ship usable versions</h3>
                    <p>Real users and real ops beat perfect prototypes that never leave the lab.</p>
                </article>
                <article class="cs-features__item">
                    <h3>Leave a next step</h3>
                    <p>Every engagement ends with a backlog or handoff the team can run with.</p>
                </article>
                <article class="cs-features__item">
                    <h3>Direct partnership</h3>
                    <p>Founders and operators talk to the build team — not a long chain of intermediaries.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <div>
                <p class="cs-cta__eyebrow">Start your project</p>
                <p>Have something similar in mind? Tell us what you want to launch.</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">View services</a>
            </div>
        </div>
    </section>

</x-layouts.site>
