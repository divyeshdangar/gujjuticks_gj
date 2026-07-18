<x-layouts.site :metaData="$metaData" page="marketing">

    @php
        $related = collect(config('site_pages.technology.hub.items', []))
            ->reject(fn ($item) => ($item['slug'] ?? '') === $slug)
            ->take(3)
            ->values();
    @endphp

    <article class="cs">
        <header class="cs-hero">
            <div class="mk-wrap cs-hero__inner">
                <p class="mk-crumbs">
                    <a href="{{ route('pages.technology') }}">Technology</a>
                    <span aria-hidden="true">/</span>
                    <span>{{ $page['label'] }}</span>
                </p>
                <p class="mk-label">{{ $page['category'] ?? $page['label'] }}</p>
                <h1 class="mk-title">{{ $page['heading'] }}</h1>
                <p class="mk-lead">{{ $page['lead'] }}</p>

                <dl class="cs-facts">
                    @if (!empty($page['best_for']))
                        <div>
                            <dt>Best for</dt>
                            <dd>{{ $page['best_for'] }}</dd>
                        </div>
                    @endif
                    @if (!empty($page['maturity']))
                        <div>
                            <dt>Focus</dt>
                            <dd>{{ $page['maturity'] }}</dd>
                        </div>
                    @endif
                    @if (!empty($page['delivery']))
                        <div>
                            <dt>Delivery</dt>
                            <dd>{{ $page['delivery'] }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt>Layer</dt>
                        <dd>{{ $page['category'] ?? $page['label'] }}</dd>
                    </div>
                </dl>

                @if (!empty($page['tools']))
                    <ul class="cs-stack" aria-label="Tools">
                        @foreach ($page['tools'] as $tool)
                            <li>{{ $tool }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="mk-actions">
                    <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                    <a class="mk-btn mk-btn--ghost" href="{{ route('pages.technology') }}">All technology</a>
                </div>
            </div>
        </header>

        @if (!empty($page['highlights']))
            <section class="cs-highlights" aria-label="Highlights">
                <div class="mk-wrap cs-highlights__grid">
                    @foreach ($page['highlights'] as $item)
                        <div class="cs-highlights__item">
                            <p class="cs-highlights__value">{{ $item['value'] }}</p>
                            <p class="cs-highlights__label">{{ $item['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if (!empty($page['overview']))
            <section class="mk-section">
                <div class="mk-wrap cs-overview">
                    <h2 class="cs-overview__label">Overview</h2>
                    <p class="cs-overview__text">{{ $page['overview'] }}</p>
                </div>
            </section>
        @endif

        <section class="mk-section mk-section--alt">
            <div class="mk-wrap cs-story">
                @if (!empty($page['when_fit']))
                    <article class="cs-story__block">
                        <p class="cs-story__num" aria-hidden="true">01</p>
                        <div>
                            <h2>{{ $page['when_fit']['heading'] }}</h2>
                            <p>{{ $page['when_fit']['body'] }}</p>
                            @if (!empty($page['when_fit']['points']))
                                <ul>
                                    @foreach ($page['when_fit']['points'] as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </article>
                @endif
                @if (!empty($page['approach']))
                    <article class="cs-story__block">
                        <p class="cs-story__num" aria-hidden="true">02</p>
                        <div>
                            <h2>{{ $page['approach']['heading'] }}</h2>
                            <p>{{ $page['approach']['body'] }}</p>
                            @if (!empty($page['approach']['points']))
                                <ul>
                                    @foreach ($page['approach']['points'] as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </article>
                @endif
            </div>
        </section>

        @if (!empty($page['deliverables']))
            <section class="mk-section">
                <div class="mk-wrap">
                    <div class="mk-section__head">
                        <h2>{{ $page['deliverables']['heading'] }}</h2>
                        <p>{{ $page['deliverables']['body'] }}</p>
                    </div>
                    @if (!empty($page['deliverables']['features']))
                        <div class="cs-features">
                            @foreach ($page['deliverables']['features'] as $feature)
                                <article class="cs-features__item">
                                    <h3>{{ $feature['title'] }}</h3>
                                    <p>{{ $feature['text'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

        @if (!empty($page['process']))
            <section class="mk-section mk-section--alt" aria-labelledby="tech-process-heading">
                <div class="mk-wrap">
                    <div class="mk-section__head">
                        <h2 id="tech-process-heading">How engagement usually runs</h2>
                        <p>A clear path from fit check to launch.</p>
                    </div>
                    <ol class="cs-timeline">
                        @foreach ($page['process'] as $step)
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

        @if (!empty($page['outcome']))
            <section class="mk-section">
                <div class="mk-wrap cs-outcome">
                    <div>
                        <h2>{{ $page['outcome']['heading'] }}</h2>
                        <p>{{ $page['outcome']['body'] }}</p>
                    </div>
                    @if (!empty($page['outcome']['results']))
                        <ul class="cs-outcome__list">
                            @foreach ($page['outcome']['results'] as $result)
                                <li>{{ $result }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </section>
        @endif

        @if ($related->isNotEmpty())
            <section class="mk-section mk-section--alt" aria-labelledby="tech-related-heading">
                <div class="mk-wrap">
                    <div class="mk-section__head">
                        <h2 id="tech-related-heading">Related technology</h2>
                    </div>
                    <div class="cs-related cs-related--3">
                        @foreach ($related as $item)
                            <a href="{{ route('pages.technology.show', ['slug' => $item['slug']]) }}" class="mk-card">
                                <p class="mk-card__tag">{{ $item['tag'] }}</p>
                                <h3 class="mk-card__title">{{ $item['title'] }}</h3>
                                <p class="mk-card__summary">{{ $item['summary'] }}</p>
                                <span class="mk-card__more">Explore</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="mk-cta" aria-label="Contact">
            <div class="mk-wrap mk-cta__box">
                <div>
                    <p class="cs-cta__eyebrow">{{ $page['cta']['eyebrow'] ?? 'Start a project' }}</p>
                    <p>{{ $page['cta']['text'] ?? 'Want to use this in your next build?' }}</p>
                </div>
                <div class="mk-cta__actions">
                    <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Discuss your project</a>
                    @if (!empty($page['cta']['secondary_route']))
                        <a class="mk-btn mk-btn--ghost"
                            href="{{ route($page['cta']['secondary_route'], $page['cta']['secondary_params'] ?? []) }}">
                            {{ $page['cta']['secondary_label'] ?? 'Learn more' }}
                        </a>
                    @else
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.technology') }}">All technology</a>
                    @endif
                </div>
            </div>
        </section>
    </article>

</x-layouts.site>
