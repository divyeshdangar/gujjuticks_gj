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
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">View services</a>
            </div>
        </div>
    </section>

    @if (!empty($page['highlights']))
        <section class="cs-highlights" aria-label="Delivery highlights">
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

    @if (!empty($page['principles']))
        <section class="mk-section" aria-labelledby="hww-principles-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-principles-heading">{{ $page['principles']['heading'] }}</h2>
                    @if (!empty($page['principles']['lead']))
                        <p>{{ $page['principles']['lead'] }}</p>
                    @endif
                </div>
                <div class="cs-features cs-features--{{ count($page['principles']['items']) >= 4 ? '2' : '3' }}">
                    @foreach ($page['principles']['items'] as $item)
                        <article class="cs-features__item">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['process']))
        <section class="mk-section mk-section--alt" aria-labelledby="hww-process-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-process-heading">From brief to support</h2>
                    <p>The same delivery rhythm across apps, websites, and software.</p>
                </div>
                <ol class="hww-process">
                    @foreach ($page['process'] as $step)
                        <li class="hww-process__item">
                            <div class="hww-process__top">
                                <span class="hww-process__phase">{{ $step['phase'] }}</span>
                                @if (!empty($step['duration']))
                                    <span class="hww-process__duration">{{ $step['duration'] }}</span>
                                @endif
                            </div>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                            @if (!empty($step['includes']))
                                <ul class="mk-include-list">
                                    @foreach ($step['includes'] as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>
    @endif

    @if (!empty($page['kickoff']))
        <section class="mk-section" aria-labelledby="hww-kickoff-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-kickoff-heading">{{ $page['kickoff']['heading'] }}</h2>
                    @if (!empty($page['kickoff']['lead']))
                        <p>{{ $page['kickoff']['lead'] }}</p>
                    @endif
                </div>
                <ol class="cs-timeline cs-timeline--{{ min(4, count($page['kickoff']['steps'])) }}">
                    @foreach ($page['kickoff']['steps'] as $index => $step)
                        <li class="cs-timeline__item">
                            <span class="cs-timeline__phase">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>
    @endif

    @if (!empty($page['from_you']))
        <section class="mk-section mk-section--alt" aria-labelledby="hww-from-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-from-heading">{{ $page['from_you']['heading'] }}</h2>
                    <p>{{ $page['from_you']['lead'] ?? 'Engagements move faster when these are in place.' }}</p>
                </div>
                <div class="cs-features cs-features--3">
                    @foreach ($page['from_you']['items'] as $item)
                        <article class="cs-features__item">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['cadence']))
        <section class="mk-section" aria-labelledby="hww-cadence-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-cadence-heading">{{ $page['cadence']['heading'] }}</h2>
                    <p>{{ $page['cadence']['lead'] ?? 'Communication that keeps scope honest.' }}</p>
                </div>
                <div class="cs-features cs-features--3">
                    @foreach ($page['cadence']['items'] as $item)
                        <article class="cs-features__item">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['timelines']))
        <section class="mk-section mk-section--alt" aria-labelledby="hww-timelines-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-timelines-heading">{{ $page['timelines']['heading'] }}</h2>
                    @if (!empty($page['timelines']['lead']))
                        <p>{{ $page['timelines']['lead'] }}</p>
                    @endif
                </div>
                <div class="cs-features cs-features--2">
                    @foreach ($page['timelines']['items'] as $item)
                        <article class="cs-features__item">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['boundaries']))
        <section class="mk-section" aria-labelledby="hww-boundaries-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-boundaries-heading">{{ $page['boundaries']['heading'] }}</h2>
                    <p>Clear boundaries keep delivery calm and honest.</p>
                </div>
                <div class="hww-boundaries">
                    <article class="hww-boundaries__col">
                        <h3>Typically included</h3>
                        <ul class="mk-include-list">
                            @foreach ($page['boundaries']['included'] as $line)
                                <li>{{ $line }}</li>
                            @endforeach
                        </ul>
                    </article>
                    <article class="hww-boundaries__col hww-boundaries__col--muted">
                        <h3>Typically not included</h3>
                        <ul class="mk-include-list">
                            @foreach ($page['boundaries']['not_included'] as $line)
                                <li>{{ $line }}</li>
                            @endforeach
                        </ul>
                    </article>
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['ownership']))
        <section class="mk-section mk-section--alt">
            <div class="mk-wrap cs-outcome">
                <div>
                    <h2>{{ $page['ownership']['heading'] }}</h2>
                    <p>{{ $page['ownership']['body'] }}</p>
                </div>
                <ul class="cs-outcome__list">
                    @foreach ($page['ownership']['points'] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (!empty($page['faqs']))
        <section class="mk-section" aria-labelledby="hww-faq-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-faq-heading">{{ $page['faqs']['heading'] }}</h2>
                    @if (!empty($page['faqs']['lead']))
                        <p>{{ $page['faqs']['lead'] }}</p>
                    @endif
                </div>
                <div class="sv-faq">
                    @foreach ($page['faqs']['items'] as $item)
                        <details class="sv-faq__item">
                            <summary>{{ $item['q'] }}</summary>
                            <p>{{ $item['a'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="mk-section mk-section--alt">
        <div class="mk-wrap">
            <div class="mk-section__head">
                <h2>Explore next</h2>
                <p>See what we build, proof of approach, or start a conversation.</p>
            </div>
            <div class="mk-grid mk-grid--3">
                <a href="{{ route('pages.services') }}" class="mk-card">
                    <p class="mk-card__tag">Offer</p>
                    <h3 class="mk-card__title">Services</h3>
                    <p class="mk-card__summary">Custom apps, websites, and software.</p>
                </a>
                <a href="{{ route('pages.work') }}" class="mk-card">
                    <p class="mk-card__tag">Proof</p>
                    <h3 class="mk-card__title">Work</h3>
                    <p class="mk-card__summary">Selected project types and approaches.</p>
                </a>
                <a href="{{ route('pages.faq') }}" class="mk-card">
                    <p class="mk-card__tag">Answers</p>
                    <h3 class="mk-card__title">FAQ</h3>
                    <p class="mk-card__summary">Timelines, ownership, pricing shape, and more.</p>
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
                <p>{{ $page['cta']['text'] ?? 'Tell us what you want to launch.' }}</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">View services</a>
            </div>
        </div>
    </section>

</x-layouts.site>
