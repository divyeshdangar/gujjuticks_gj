<x-layouts.site :metaData="$metaData" page="marketing">

    <section class="mk-hero">
        <div class="mk-wrap mk-hero__inner">
            <p class="mk-crumbs">
                <a href="{{ route('pages.compare') }}">Compare</a>
                <span aria-hidden="true">/</span>
                <span>{{ $page['label'] }}</span>
            </p>
            <p class="mk-label">{{ $page['label'] }}</p>
            <h1 class="mk-title">{{ $page['heading'] }}</h1>
            <p class="mk-lead">{{ $page['lead'] }}</p>
            <div class="mk-actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Discuss your project</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.compare') }}">All guides</a>
            </div>
        </div>
    </section>

    @if (!empty($page['answer']))
        <section class="mk-section">
            <div class="mk-wrap mk-prose mk-prose--narrow">
                <article class="mk-block">
                    <h2>Direct answer</h2>
                    <p>{{ $page['answer'] }}</p>
                    @if (!empty($page['verdict']))
                        <p><strong>{{ $page['verdict'] }}</strong></p>
                    @endif
                </article>
            </div>
        </section>
    @endif

    @if (!empty($page['compare']['rows']))
        <section class="mk-section mk-section--alt" aria-labelledby="compare-table-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="compare-table-heading">Side-by-side</h2>
                </div>
                <div class="mk-compare-table-wrap">
                    <table class="mk-compare-table">
                        <thead>
                            <tr>
                                @foreach ($page['compare']['headers'] as $header)
                                    <th scope="col">{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($page['compare']['rows'] as $row)
                                <tr>
                                    @foreach ($row as $i => $cell)
                                        @if ($i === 0)
                                            <th scope="row">{{ $cell }}</th>
                                        @else
                                            <td>{{ $cell }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['choose']))
        <section class="mk-section" aria-labelledby="compare-choose-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="compare-choose-heading">When to choose each</h2>
                </div>
                <div class="mk-grid mk-grid--{{ min(3, count($page['choose'])) }}">
                    @foreach ($page['choose'] as $choice)
                        <article class="mk-card" style="cursor: default;">
                            <h3 class="mk-card__title">{{ $choice['title'] }}</h3>
                            <ul class="mk-compare-list">
                                @foreach ($choice['points'] as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (!empty($page['sections']))
        <section class="mk-section mk-section--alt">
            <div class="mk-wrap mk-prose">
                @foreach ($page['sections'] as $section)
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
    @endif

    @if (!empty($siblings))
        <section class="mk-section" aria-label="Related guides">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2>Related guides</h2>
                </div>
                <div class="mk-grid mk-grid--3">
                    @foreach ($siblings as $item)
                        <a href="{{ route('pages.compare.show', ['slug' => $item['slug']]) }}" class="mk-card">
                            @if (!empty($item['tag']))
                                <p class="mk-card__tag">{{ $item['tag'] }}</p>
                            @endif
                            <h3 class="mk-card__title">{{ $item['title'] }}</h3>
                            <p class="mk-card__summary">{{ $item['summary'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="mk-cta" aria-label="Contact">
        <div class="mk-wrap mk-cta__box">
            <div>
                <p class="cs-cta__eyebrow">Ready to decide?</p>
                <p>Send a short brief — we will say plainly whether GujjuTicks is the right fit.</p>
            </div>
            <div class="mk-cta__actions">
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                <a class="mk-btn mk-btn--ghost" href="{{ route('pages.tools.brief') }}">Build a brief</a>
            </div>
        </div>
    </section>

</x-layouts.site>
