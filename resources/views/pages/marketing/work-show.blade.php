<x-layouts.site :metaData="$metaData" page="marketing">

    @php
        $rich = !empty($page['challenge']) || !empty($page['highlights']);
        $related = collect(config('site_pages.work.pages', []))
            ->reject(fn ($_, $key) => $key === $slug)
            ->map(fn ($item, $key) => array_merge($item, ['slug' => $key]))
            ->take(2)
            ->values();
    @endphp

    <article class="cs">
        <header class="cs-hero">
            <div class="mk-wrap cs-hero__inner">
                <p class="mk-crumbs">
                    <a href="{{ route('pages.work') }}">Work</a>
                    <span aria-hidden="true">/</span>
                    <span>{{ $page['heading'] }}</span>
                </p>
                <p class="mk-label">{{ $page['label'] }}</p>
                <h1 class="mk-title">{{ $page['heading'] }}</h1>
                <p class="mk-lead">{{ $page['lead'] }}</p>

                <dl class="cs-facts">
                    <div>
                        <dt>Client</dt>
                        <dd>{{ $page['client'] }}</dd>
                    </div>
                    <div>
                        <dt>Industry</dt>
                        <dd>{{ $page['industry'] }}</dd>
                    </div>
                    @if (!empty($page['duration']))
                        <div>
                            <dt>Timeline</dt>
                            <dd>{{ $page['duration'] }}</dd>
                        </div>
                    @endif
                    @if (!empty($page['year']))
                        <div>
                            <dt>Year</dt>
                            <dd>{{ $page['year'] }}</dd>
                        </div>
                    @endif
                    @if (!empty($page['role']))
                        <div class="cs-facts__wide">
                            <dt>Role</dt>
                            <dd>{{ $page['role'] }}</dd>
                        </div>
                    @endif
                </dl>

                @if (!empty($page['stack']))
                    <ul class="cs-stack" aria-label="Technology">
                        @foreach ($page['stack'] as $tech)
                            <li>{{ $tech }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </header>

        @if (!empty($page['highlights']))
            <section class="cs-highlights" aria-label="Project highlights">
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

        @if ($rich)
            <section class="mk-section mk-section--alt">
                <div class="mk-wrap cs-story">
                    @foreach (['challenge', 'approach'] as $key)
                        @if (!empty($page[$key]))
                            <article class="cs-story__block">
                                <p class="cs-story__num" aria-hidden="true">{{ $key === 'challenge' ? '01' : '02' }}</p>
                                <div>
                                    <h2>{{ $page[$key]['heading'] }}</h2>
                                    <p>{{ $page[$key]['body'] }}</p>
                                    @if (!empty($page[$key]['points']))
                                        <ul>
                                            @foreach ($page[$key]['points'] as $point)
                                                <li>{{ $point }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>
            </section>

            @if (!empty($page['solution']))
                <section class="mk-section">
                    <div class="mk-wrap">
                        <div class="mk-section__head">
                            <h2>{{ $page['solution']['heading'] }}</h2>
                            <p>{{ $page['solution']['body'] }}</p>
                        </div>
                        @if (!empty($page['solution']['features']))
                            <div class="cs-features">
                                @foreach ($page['solution']['features'] as $feature)
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

            @if (!empty($page['timeline']))
                <section class="mk-section mk-section--alt" aria-labelledby="cs-timeline-heading">
                    <div class="mk-wrap">
                        <div class="mk-section__head">
                            <h2 id="cs-timeline-heading">Delivery timeline</h2>
                            <p>A clear path from discovery to launch.</p>
                        </div>
                        <ol class="cs-timeline">
                            @foreach ($page['timeline'] as $step)
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

            @if (!empty($page['quote']))
                <section class="cs-quote" aria-label="Client note">
                    <div class="mk-wrap cs-quote__inner">
                        <blockquote>
                            <p>“{{ $page['quote']['text'] }}”</p>
                            <footer>
                                <cite>{{ $page['quote']['by'] }}</cite>
                                @if (!empty($page['quote']['role']))
                                    <span>{{ $page['quote']['role'] }}</span>
                                @endif
                            </footer>
                        </blockquote>
                    </div>
                </section>
            @endif
        @elseif (!empty($page['sections']))
            <section class="mk-section">
                <div class="mk-wrap mk-prose">
                    @foreach ($page['sections'] as $section)
                        <article class="mk-block">
                            <h2>{{ $section['heading'] }}</h2>
                            <p>{{ $section['body'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($related->isNotEmpty())
            <section class="mk-section mk-section--alt" aria-labelledby="cs-related-heading">
                <div class="mk-wrap">
                    <div class="mk-section__head">
                        <h2 id="cs-related-heading">More work</h2>
                    </div>
                    <div class="cs-related">
                        @foreach ($related as $item)
                            <a href="{{ route('pages.work.show', ['slug' => $item['slug']]) }}" class="mk-card">
                                <p class="mk-card__tag">{{ $item['industry'] ?? 'Case study' }}</p>
                                <h3 class="mk-card__title">{{ $item['heading'] }}</h3>
                                <p class="mk-card__summary">{{ $item['lead'] }}</p>
                                <span class="mk-card__more">View case study</span>
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
                    <p>{{ $page['cta']['text'] ?? 'Want a similar outcome for your product?' }}</p>
                </div>
                <div class="mk-cta__actions">
                    <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a conversation</a>
                    @if (!empty($page['cta']['secondary_route']))
                        <a class="mk-btn mk-btn--ghost"
                            href="{{ route($page['cta']['secondary_route'], $page['cta']['secondary_params'] ?? []) }}">
                            {{ $page['cta']['secondary_label'] ?? 'Learn more' }}
                        </a>
                    @else
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.work') }}">More work</a>
                    @endif
                </div>
            </div>
        </section>
    </article>

</x-layouts.site>
