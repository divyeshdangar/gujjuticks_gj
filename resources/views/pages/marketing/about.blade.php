<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="mk-hero">
        <div class="mk-wrap mk-hero__inner">
            <p class="mk-label">{{ $page['label'] }}</p>
            <h1 class="mk-title">{{ $page['heading'] }}</h1>
            <p class="mk-lead">{{ $page['lead'] }}</p>
            <div class="mk-actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">View services</a>
            </div>
        </div>
    </section>

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

    <section class="mk-section mk-section--alt">
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
                <a href="{{ route('pages.technology') }}" class="mk-card">
                    <p class="mk-card__tag">Stack</p>
                    <h3 class="mk-card__title">Technology</h3>
                    <p class="mk-card__summary">Laravel, web apps, APIs, hosting, and more.</p>
                </a>
                <a href="{{ route('pages.work') }}" class="mk-card">
                    <p class="mk-card__tag">Proof</p>
                    <h3 class="mk-card__title">Work</h3>
                    <p class="mk-card__summary">Selected project types and approaches.</p>
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
