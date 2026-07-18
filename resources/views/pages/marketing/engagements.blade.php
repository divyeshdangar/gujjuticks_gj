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
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Send a brief</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.how-we-work') }}">How we work</a>
            </div>
        </div>
    </section>

    @if (!empty($page['models']))
        <section class="mk-section" aria-label="Engagement models">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2>Choose how to engage</h2>
                    <p>Pick the shape that matches how clear the work already is.</p>
                </div>
                <div class="cs-hub__list">
                    @foreach ($page['models'] as $model)
                        <a href="{{ route($model['route'], $model['params'] ?? []) }}" class="cs-hub__card">
                            <div class="cs-hub__card-top">
                                <p class="mk-card__tag">{{ $model['tag'] }}</p>
                                @if (!empty($model['timeline']))
                                    <span class="cs-hub__duration">{{ $model['timeline'] }}</span>
                                @endif
                            </div>
                            <h2 class="cs-hub__card-title">{{ $model['title'] }}</h2>
                            <p class="cs-hub__card-summary">{{ $model['summary'] }}</p>
                            @if (!empty($model['best_for']))
                                <p class="sv-hub__ideal"><span>Best for</span> {{ $model['best_for'] }}</p>
                            @endif
                            @if (!empty($model['includes']))
                                <ul class="mk-include-list">
                                    @foreach ($model['includes'] as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <span class="mk-card__more">Learn more</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['after']))
        <section class="mk-section mk-section--alt" aria-labelledby="eng-after-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="eng-after-heading">{{ $page['after']['heading'] }}</h2>
                    <p>No mystery between first message and kickoff.</p>
                </div>
                <div class="cs-features cs-features--3">
                    @foreach ($page['after']['items'] as $item)
                        <article class="cs-features__item">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['notes']))
        <section class="mk-section" aria-labelledby="eng-notes-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="eng-notes-heading">{{ $page['notes']['heading'] }}</h2>
                    <p>Clear expectations keep projects honest.</p>
                </div>
                <div class="mk-split">
                    <div class="mk-split__col">
                        <h3>Typically included</h3>
                        <ul class="cs-outcome__list">
                            @foreach ($page['notes']['included'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mk-split__col">
                        <h3>Typically not included</h3>
                        <ul class="cs-outcome__list">
                            @foreach ($page['notes']['not_included'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <div>
                @if (!empty($page['cta']['eyebrow']))
                    <p class="cs-cta__eyebrow">{{ $page['cta']['eyebrow'] }}</p>
                @endif
                <p>{{ $page['cta']['text'] ?? 'Tell us what you need.' }}</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">View services</a>
            </div>
        </div>
    </section>

</x-layouts.site>
