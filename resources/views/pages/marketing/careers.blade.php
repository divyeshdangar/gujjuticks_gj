<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="cs-hero">
        <div class="mk-wrap cs-hero__inner">
            <p class="mk-label">{{ $page['label'] }}</p>
            <h1 class="mk-title">{{ $page['heading'] }}</h1>
            <p class="mk-lead">{{ $page['lead'] }}</p>
            <div class="mk-actions">
                <a class="mk-btn mk-btn--solid" href="mailto:info@gujjuticks.com?subject=Careers%20application">Email careers</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.about') }}">About GujjuTicks</a>
            </div>
        </div>
    </section>

    @if (!empty($page['culture']))
        <section class="mk-section" aria-labelledby="careers-culture-heading">
            <div class="mk-wrap cs-outcome">
                <div>
                    <h2 id="careers-culture-heading">{{ $page['culture']['heading'] }}</h2>
                    <p>{{ $page['culture']['body'] }}</p>
                </div>
                <ul class="cs-outcome__list">
                    @foreach ($page['culture']['points'] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (!empty($page['roles']))
        <section class="mk-section mk-section--alt" aria-labelledby="careers-roles-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="careers-roles-heading">{{ $page['roles']['heading'] }}</h2>
                    @if (!empty($page['roles']['lead']))
                        <p>{{ $page['roles']['lead'] }}</p>
                    @endif
                </div>

                @if (!empty($page['roles']['items']))
                    <div class="cs-hub__list">
                        @foreach ($page['roles']['items'] as $role)
                            <article class="cs-hub__card cs-hub__card--static">
                                <p class="mk-card__tag">{{ $role['type'] ?? 'Role' }}</p>
                                <h2 class="cs-hub__card-title">{{ $role['title'] }}</h2>
                                <p class="cs-hub__card-summary">{{ $role['summary'] }}</p>
                            </article>
                        @endforeach
                    </div>
                @elseif (!empty($page['roles']['open_note']))
                    <div class="mk-prose mk-prose--narrow">
                        <article class="mk-block">
                            <p>{{ $page['roles']['open_note'] }}</p>
                        </article>
                    </div>
                @endif
            </div>
        </section>
    @endif

    @if (!empty($page['stack']))
        <section class="mk-section" aria-labelledby="careers-stack-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="careers-stack-heading">{{ $page['stack']['heading'] }}</h2>
                    <p>Practical tools for products clients run every day.</p>
                </div>
                <ul class="cs-stack" aria-label="Stack">
                    @foreach ($page['stack']['items'] as $tech)
                        <li>{{ $tech }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (!empty($page['apply']))
        <section class="mk-section mk-section--alt">
            <div class="mk-wrap mk-prose mk-prose--narrow">
                <article class="mk-block">
                    <h2>{{ $page['apply']['heading'] }}</h2>
                    <p>{{ $page['apply']['body'] }}</p>
                </article>
            </div>
        </section>
    @endif

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <div>
                @if (!empty($page['cta']['eyebrow']))
                    <p class="cs-cta__eyebrow">{{ $page['cta']['eyebrow'] }}</p>
                @endif
                <p>{{ $page['cta']['text'] ?? 'Start a project instead.' }}</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                <a class="mk-btn mk-btn--ghost" href="mailto:info@gujjuticks.com?subject=Careers%20application">Email careers</a>
            </div>
        </div>
    </section>

</x-layouts.site>
