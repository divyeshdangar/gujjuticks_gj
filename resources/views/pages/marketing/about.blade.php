<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="mk-hero">
        <div class="mk-wrap mk-hero__inner">
            <p class="mk-label">{{ $page['label'] }}</p>
            <h1 class="mk-title">{{ $page['heading'] }}</h1>
            <p class="mk-lead">{{ $page['lead'] }}</p>
            <div class="mk-actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.how-we-work') }}">How we work</a>
            </div>
        </div>
    </section>

    @if (!empty($page['story']))
        <section class="mk-section">
            <div class="mk-wrap mk-prose mk-prose--narrow">
                <article class="mk-block">
                    <h2>{{ $page['story']['heading'] }}</h2>
                    <p>{{ $page['story']['body'] }}</p>
                </article>
            </div>
        </section>
    @endif

    @if (!empty($page['location']))
        <section class="mk-section mk-section--alt">
            <div class="mk-wrap mk-prose mk-prose--narrow">
                <article class="mk-block">
                    <h2>{{ $page['location']['heading'] }}</h2>
                    <p>{{ $page['location']['body'] }}</p>
                </article>
            </div>
        </section>
    @endif

    @if (!empty($page['team']))
        <section class="mk-section" aria-labelledby="about-team-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="about-team-heading">{{ $page['team']['heading'] }}</h2>
                    @if (!empty($page['team']['lead']))
                        <p>{{ $page['team']['lead'] }}</p>
                    @endif
                </div>
                <div class="cs-features cs-features--{{ count($page['team']['people']) >= 3 ? '3' : '2' }}">
                    @foreach ($page['team']['people'] as $person)
                        <article class="cs-features__item mk-team-card">
                            <p class="mk-card__tag">{{ $person['role'] }}</p>
                            <h3>{{ $person['name'] }}</h3>
                            <p>{{ $person['bio'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="mk-section mk-section--alt">
        <div class="mk-wrap mk-prose">
            @foreach ($page['sections'] as $section)
                <article class="mk-block">
                    <h2>{{ $section['heading'] }}</h2>
                    <p>{{ $section['body'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mk-section">
        <div class="mk-wrap">
            <div class="mk-section__head">
                <h2>Explore</h2>
                <p>See how we build and what we deliver.</p>
            </div>
            <div class="mk-grid mk-grid--3">
                <a href="{{ route('pages.services') }}" class="mk-card">
                    <p class="mk-card__tag">Offer</p>
                    <h3 class="mk-card__title">Services</h3>
                    <p class="mk-card__summary">Custom apps, websites, and software.</p>
                </a>
                <a href="{{ route('pages.compare') }}" class="mk-card">
                    <p class="mk-card__tag">Decide</p>
                    <h3 class="mk-card__title">Compare</h3>
                    <p class="mk-card__summary">In-house, freelancers, website vs app.</p>
                </a>
                <a href="{{ route('pages.how-we-work') }}" class="mk-card">
                    <p class="mk-card__tag">Process</p>
                    <h3 class="mk-card__title">How we work</h3>
                    <p class="mk-card__summary">Discovery through launch.</p>
                </a>
                <a href="{{ route('pages.work') }}" class="mk-card">
                    <p class="mk-card__tag">Proof</p>
                    <h3 class="mk-card__title">Work</h3>
                    <p class="mk-card__summary">Selected project types and approaches.</p>
                </a>
                <a href="{{ route('form.contact') }}" class="mk-card">
                    <p class="mk-card__tag">Next</p>
                    <h3 class="mk-card__title">Contact</h3>
                    <p class="mk-card__summary">Share a brief and start a project conversation.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <p>Have a project in mind?</p>
            <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
        </div>
    </section>

</x-layouts.site>
