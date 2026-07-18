<x-layouts.site :metaData="$metaData" page="marketing">

    @php
        $rich = !empty($page['overview']) || !empty($page['deliverables']);
    @endphp

    @if ($rich)
        <article class="cs">
            <header class="cs-hero">
                <div class="mk-wrap cs-hero__inner">
                    <p class="mk-crumbs">
                        <a href="{{ route('pages.services') }}">Services</a>
                        <span aria-hidden="true">/</span>
                        <span>{{ $page['label'] }}</span>
                    </p>
                    <p class="mk-label">{{ $page['category'] ?? 'Service' }}</p>
                    <h1 class="mk-title">{{ $page['heading'] }}</h1>
                    <p class="mk-lead">{{ $page['lead'] }}</p>

                    <dl class="cs-facts">
                        @if (!empty($page['ideal_for']))
                            <div>
                                <dt>Ideal for</dt>
                                <dd>{{ $page['ideal_for'] }}</dd>
                            </div>
                        @endif
                        @if (!empty($page['engagement']))
                            <div>
                                <dt>Engagement</dt>
                                <dd>{{ $page['engagement'] }}</dd>
                            </div>
                        @endif
                        @if (!empty($page['timeline']))
                            <div>
                                <dt>Typical v1</dt>
                                <dd>{{ $page['timeline'] }}</dd>
                            </div>
                        @endif
                        <div>
                            <dt>Partner role</dt>
                            <dd>Scope, build, launch</dd>
                        </div>
                    </dl>

                    @if (!empty($page['tools']))
                        <ul class="cs-stack" aria-label="Stack">
                            @foreach ($page['tools'] as $tool)
                                <li>{{ $tool }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mk-actions">
                        <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Discuss your app</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.brief') }}">Build a brief</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.estimate') }}">Rough estimate</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.stack') }}">Tech stack quiz</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">All services</a>
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
                        <h2 class="cs-overview__label">How we help</h2>
                        <p class="cs-overview__text">{{ $page['overview'] }}</p>
                    </div>
                </section>
            @endif

            <section class="mk-section mk-section--alt">
                <div class="mk-wrap cs-story">
                    @if (!empty($page['who_we_help']))
                        <article class="cs-story__block">
                            <p class="cs-story__num" aria-hidden="true">01</p>
                            <div>
                                <h2>{{ $page['who_we_help']['heading'] }}</h2>
                                <p>{{ $page['who_we_help']['body'] }}</p>
                                @if (!empty($page['who_we_help']['points']))
                                    <ul>
                                        @foreach ($page['who_we_help']['points'] as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </article>
                    @endif
                    @if (!empty($page['when_fit']))
                        <article class="cs-story__block">
                            <p class="cs-story__num" aria-hidden="true">02</p>
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
                            <p class="cs-story__num" aria-hidden="true">03</p>
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
                        <div class="cs-features">
                            @foreach ($page['deliverables']['features'] as $feature)
                                <article class="cs-features__item">
                                    <h3>{{ $feature['title'] }}</h3>
                                    <p>{{ $feature['text'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if (!empty($page['included']))
                <section class="mk-section mk-section--alt">
                    <div class="mk-wrap cs-outcome">
                        <div>
                            <h2>{{ $page['included']['heading'] }}</h2>
                            <p>A typical custom-app engagement covers the full path from brief to live product.</p>
                        </div>
                        <ul class="cs-outcome__list">
                            @foreach ($page['included']['items'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif

            @if (!empty($page['process']))
                <section class="mk-section" aria-labelledby="svc-process-heading">
                    <div class="mk-wrap">
                        <div class="mk-section__head">
                            <h2 id="svc-process-heading">How we work together</h2>
                            <p>You always know what happens next.</p>
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
                <section class="mk-section mk-section--alt">
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

            @if (!empty($page['proof']))
                <section class="mk-section">
                    <div class="mk-wrap">
                        <div class="mk-section__head">
                            <h2>{{ $page['proof']['heading'] }}</h2>
                            <p>See how similar builds play out in practice.</p>
                        </div>
                        <div class="cs-related cs-related--3">
                            @foreach ($page['proof']['items'] as $item)
                                <a href="{{ route($item['route'], $item['params'] ?? []) }}" class="mk-card">
                                    <p class="mk-card__tag">{{ $item['label'] }}</p>
                                    <h3 class="mk-card__title">{{ $item['title'] }}</h3>
                                    <p class="mk-card__summary">{{ $item['text'] }}</p>
                                    <span class="mk-card__more">View</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if (!empty($page['tech_links']))
                <section class="mk-section mk-section--alt">
                    <div class="mk-wrap">
                        <div class="mk-section__head">
                            <h2>{{ $page['tech_links']['heading'] }}</h2>
                            <p>Practical stack choices behind custom apps.</p>
                        </div>
                        <div class="cs-features">
                            @foreach ($page['tech_links']['items'] as $item)
                                <a href="{{ route('pages.technology.show', ['slug' => $item['slug']]) }}"
                                    class="cs-features__item cs-features__item--link">
                                    <h3>{{ $item['title'] }}</h3>
                                    <p>{{ $item['text'] }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @if (!empty($page['faqs']))
                <section class="mk-section" aria-labelledby="svc-faq-heading">
                    <div class="mk-wrap">
                        <div class="mk-section__head sv-faq-head">
                            <h2 id="svc-faq-heading">Common questions</h2>
                            <p>Straight answers before you reach out.</p>
                        </div>
                        <div class="sv-faq" data-faq>
                            @foreach ($page['faqs'] as $faq)
                                <details class="sv-faq__item">
                                    <summary>{{ $faq['q'] }}</summary>
                                    <p>{{ $faq['a'] }}</p>
                                </details>
                            @endforeach
                        </div>
                        <p class="sv-faq-more">
                            <a href="{{ route('pages.faq') }}">More buyer questions on our FAQ page</a>
                        </p>
                    </div>
                </section>
            @endif

            @if ($serviceSiblings->isNotEmpty())
                <section class="mk-section mk-section--alt" aria-label="Other services">
                    <div class="mk-wrap">
                        <div class="mk-section__head">
                            <h2>Other services</h2>
                        </div>
                        <div class="cs-related">
                            @foreach ($serviceSiblings as $item)
                                <a href="{{ route('pages.services.show', ['slug' => $item['slug']]) }}" class="mk-card">
                                    <p class="mk-card__tag">{{ $item['tag'] }}</p>
                                    <h3 class="mk-card__title">{{ $item['title'] }}</h3>
                                    <p class="mk-card__summary">{{ $item['summary'] }}</p>
                                    <span class="mk-card__more">Learn more</span>
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
                        <p>{{ $page['cta']['text'] ?? 'Ready to talk through your custom app?' }}</p>
                    </div>
                    <div class="mk-cta__actions">
                        <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.brief') }}">Build a brief</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.estimate') }}">Rough estimate</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.stack') }}">Tech stack quiz</a>
                        @if (!empty($page['cta']['secondary_route']))
                            <a class="mk-btn mk-btn--ghost"
                                href="{{ route($page['cta']['secondary_route'], $page['cta']['secondary_params'] ?? []) }}">
                                {{ $page['cta']['secondary_label'] ?? 'Learn more' }}
                            </a>
                        @else
                            <a class="mk-btn mk-btn--ghost"
                                href="https://wa.me/917600126800?text=Hello%20GujjuTicks%20%E2%80%94%20I%27d%20like%20to%20discuss%20a%20custom%20app.">WhatsApp</a>
                        @endif
                    </div>
                </div>
            </section>
        </article>
    @else
        {{-- Simple fallback for services not yet expanded --}}
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
                    <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.brief') }}">Build a brief</a>
                    <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.estimate') }}">Rough estimate</a>
                    <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.stack') }}">Tech stack quiz</a>
                    <a class="mk-btn mk-btn--ghost" href="{{ route($hubRoute) }}">All services</a>
                </div>
            </div>
        </section>

        <section class="mk-section">
            <div class="mk-wrap mk-prose">
                @foreach ($page['sections'] ?? [] as $section)
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

        <section class="mk-cta" aria-label="Contact">
            <div class="mk-wrap mk-cta__box">
                <p>Want something like this for your team?</p>
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Discuss your project</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.brief') }}">Build a brief</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.estimate') }}">Rough estimate</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.stack') }}">Tech stack quiz</a>
            </div>
        </section>
    @endif

</x-layouts.site>
