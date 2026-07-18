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
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.engagements') }}">See engagements</a>
            </div>
        </div>
    </section>

    @if (!empty($page['process']))
        <section class="mk-section" aria-labelledby="hww-process-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-process-heading">From brief to support</h2>
                    <p>The same delivery rhythm across apps, websites, and software.</p>
                </div>
                <ol class="cs-timeline cs-timeline--5">
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

    @if (!empty($page['from_you']))
        <section class="mk-section mk-section--alt" aria-labelledby="hww-from-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="hww-from-heading">{{ $page['from_you']['heading'] }}</h2>
                    <p>Engagements move faster when these are in place.</p>
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
                    <p>Communication that keeps scope honest.</p>
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
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.faq') }}">Read FAQ</a>
            </div>
        </div>
    </section>

</x-layouts.site>
