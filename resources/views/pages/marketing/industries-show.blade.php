<x-layouts.site :metaData="$metaData" page="marketing">

    <article class="ix" data-ix-page data-industry="{{ $slug }}">
        <div class="ix-ambient" aria-hidden="true">
            <div class="ix-ambient__mesh"></div>
            <div class="ix-ambient__orb ix-ambient__orb--a"></div>
            <div class="ix-ambient__orb ix-ambient__orb--b"></div>
            <div class="ix-ambient__orb ix-ambient__orb--c"></div>
            <canvas class="ix-ambient__canvas" data-ix-canvas width="1" height="1"></canvas>
            <div class="ix-motifs" data-ix-motifs></div>
            <div class="ix-ambient__glow" data-ix-glow></div>
            <div class="ix-ambient__scan"></div>
        </div>

        <header class="ix-hero">
            <div class="mk-wrap ix-hero__grid">
                <div class="ix-hero__copy">
                    <p class="mk-crumbs ix-hero__crumbs">
                        <a href="{{ route('pages.industries') }}">Industries</a>
                        <span aria-hidden="true">/</span>
                        <span>{{ $page['label'] }}</span>
                    </p>
                    <p class="ix-hero__brand">GujjuTicks</p>
                    <p class="mk-label">{{ $groupLabel }} · {{ $page['label'] }}</p>
                    <h1 class="ix-hero__title">{{ $page['heading'] }}</h1>
                    <p class="ix-hero__lead">{{ $page['lead'] }}</p>

                    <div class="ix-hero__meta">
                        @if (!empty($page['ideal_for']))
                            <span class="ix-chip"><em>Ideal for</em>{{ $page['ideal_for'] }}</span>
                        @endif
                        @if (!empty($page['timeline']))
                            <span class="ix-chip"><em>Typical v1</em>{{ $page['timeline'] }}</span>
                        @endif
                        @if (!empty($page['engagement']))
                            <span class="ix-chip"><em>Path</em>{{ $page['engagement'] }}</span>
                        @endif
                    </div>

                    <div class="mk-actions">
                        <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Discuss your project</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.industries') }}">All industries</a>
                    </div>
                </div>

                <div class="ix-hero__stage" aria-hidden="true">
                    <div class="ix-hero__ring"></div>
                    <div class="ix-hero__ring ix-hero__ring--delay"></div>
                    <div class="ix-hero__core" data-ix-hero-core>
                        <x-site.industry-icon :slug="$slug" class="ind-icon--xl" />
                    </div>
                    @if (!empty($page['tools']))
                        <ul class="ix-hero__float">
                            @foreach (array_slice($page['tools'], 0, 6) as $i => $tool)
                                <li class="ix-hero__float-item" style="--i: {{ $i }}">{{ $tool }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </header>

        @if (!empty($page['highlights']))
            <section class="ix-rail" aria-label="Highlights">
                <div class="ix-rail__track" data-ix-rail>
                    @foreach ([1, 2] as $loopCopy)
                        @foreach ($page['highlights'] as $item)
                            <div class="ix-rail__item">
                                <span class="ix-rail__value">{{ $item['value'] }}</span>
                                <span class="ix-rail__label">{{ $item['label'] }}</span>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </section>
        @endif

        @if (!empty($page['overview']))
            <section class="ix-block ix-reveal" data-ix-reveal>
                <div class="mk-wrap ix-overview">
                    <p class="ix-kicker">Industry overview</p>
                    <p class="ix-overview__text">{{ $page['overview'] }}</p>
                </div>
            </section>
        @endif

        @if (!empty($page['challenges']))
            <section class="ix-block ix-block--tint ix-reveal" data-ix-reveal aria-labelledby="ix-challenges-heading">
                <div class="mk-wrap">
                    <div class="ix-head">
                        <p class="ix-kicker">Friction</p>
                        <h2 id="ix-challenges-heading">{{ $page['challenges']['heading'] }}</h2>
                        @if (!empty($page['challenges']['body']))
                            <p>{{ $page['challenges']['body'] }}</p>
                        @endif
                    </div>
                    <ol class="ix-challenge-list">
                        @foreach ($page['challenges']['points'] as $index => $point)
                            <li class="ix-challenge" style="--i: {{ $index }}">
                                <span class="ix-challenge__n">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <p>{{ $point }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>
        @endif

        @if (!empty($page['capabilities']))
            <section class="ix-block ix-reveal" data-ix-reveal aria-labelledby="ix-cap-heading">
                <div class="mk-wrap">
                    <div class="ix-head">
                        <p class="ix-kicker">Capabilities</p>
                        <h2 id="ix-cap-heading">{{ $page['capabilities']['heading'] }}</h2>
                        <p>{{ $page['capabilities']['body'] }}</p>
                    </div>
                    <div class="ix-caps">
                        @foreach ($page['capabilities']['features'] as $index => $feature)
                            <article class="ix-cap" style="--i: {{ $index }}" data-ix-cap>
                                @if (!empty($feature['tag']))
                                    <p class="ix-cap__tag">{{ $feature['tag'] }}</p>
                                @endif
                                <h3>{{ $feature['title'] }}</h3>
                                <p>{{ $feature['text'] }}</p>
                                <span class="ix-cap__glow" aria-hidden="true"></span>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if (!empty($page['scenarios']))
            <section class="ix-block ix-block--tint ix-reveal" data-ix-reveal aria-labelledby="ix-scenarios-heading">
                <div class="mk-wrap">
                    <div class="ix-head">
                        <p class="ix-kicker">Scenarios</p>
                        <h2 id="ix-scenarios-heading">{{ $page['scenarios']['heading'] }}</h2>
                        <p>{{ $page['scenarios']['body'] }}</p>
                    </div>
                    <div class="ix-scenarios" data-ix-scenarios>
                        @foreach ($page['scenarios']['items'] as $index => $scenario)
                            <article class="ix-scenario{{ $index === 0 ? ' is-active' : '' }}" data-ix-scenario style="--i: {{ $index }}">
                                <button type="button" class="ix-scenario__tab" data-ix-scenario-tab>
                                    <span class="ix-scenario__n">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="ix-scenario__title">{{ $scenario['title'] }}</span>
                                </button>
                                <div class="ix-scenario__panel">
                                    <p><span>Situation</span>{{ $scenario['context'] }}</p>
                                    <p><span>What we build</span>{{ $scenario['solution'] }}</p>
                                    <p class="ix-scenario__out"><span>Outcome</span>{{ $scenario['outcome'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if (!empty($page['case_studies']))
            <section class="ix-block ix-reveal" data-ix-reveal aria-labelledby="ix-cases-heading">
                <div class="mk-wrap">
                    <div class="ix-head">
                        <p class="ix-kicker">Example engagements</p>
                        <h2 id="ix-cases-heading">{{ $page['case_studies']['heading'] }}</h2>
                        <p>{{ $page['case_studies']['body'] }}</p>
                    </div>
                    <div class="ix-cases">
                        @foreach ($page['case_studies']['items'] as $index => $case)
                            <article class="ix-case" style="--i: {{ $index }}" data-ix-case>
                                <div class="ix-case__top">
                                    <p class="ix-cap__tag">{{ $case['client_type'] }}</p>
                                    <h3>{{ $case['title'] }}</h3>
                                </div>
                                <div class="ix-case__cols">
                                    <div>
                                        <h4>Challenge</h4>
                                        <p>{{ $case['challenge'] }}</p>
                                    </div>
                                    <div>
                                        <h4>Build</h4>
                                        <p>{{ $case['build'] }}</p>
                                    </div>
                                    <div>
                                        <h4>Result</h4>
                                        <p>{{ $case['result'] }}</p>
                                    </div>
                                </div>
                                @if (!empty($case['stack']))
                                    <ul class="ix-stack" aria-label="Stack used">
                                        @foreach ($case['stack'] as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if (!empty($page['process']))
            <section class="ix-block ix-block--tint ix-reveal" data-ix-reveal aria-labelledby="ix-process-heading">
                <div class="mk-wrap">
                    <div class="ix-head">
                        <p class="ix-kicker">Delivery</p>
                        <h2 id="ix-process-heading">How we deliver</h2>
                        <p>The same clear path from brief to launch, tailored to this industry.</p>
                    </div>
                    <ol class="ix-process">
                        @foreach ($page['process'] as $index => $step)
                            <li class="ix-process__item" style="--i: {{ $index }}">
                                <span class="ix-process__phase">{{ $step['phase'] }}</span>
                                <h3>{{ $step['title'] }}</h3>
                                <p>{{ $step['text'] }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </section>
        @endif

        @if (!empty($page['outcome']))
            <section class="ix-block ix-reveal" data-ix-reveal>
                <div class="mk-wrap ix-outcome">
                    <div>
                        <p class="ix-kicker">Success</p>
                        <h2>{{ $page['outcome']['heading'] }}</h2>
                        <p>{{ $page['outcome']['body'] }}</p>
                    </div>
                    @if (!empty($page['outcome']['results']))
                        <ul class="ix-outcome__list">
                            @foreach ($page['outcome']['results'] as $result)
                                <li>{{ $result }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </section>
        @endif

        @if (!empty($page['faqs']))
            <section class="ix-block ix-block--tint ix-reveal" data-ix-reveal aria-labelledby="ix-faq-heading">
                <div class="mk-wrap">
                    <div class="ix-head">
                        <p class="ix-kicker">FAQ</p>
                        <h2 id="ix-faq-heading">Questions we hear often</h2>
                    </div>
                    <div class="ix-faq">
                        @foreach ($page['faqs'] as $faq)
                            <details class="ix-faq__item">
                                <summary>{{ $faq['q'] }}</summary>
                                <p>{{ $faq['a'] }}</p>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($siblings->isNotEmpty())
            <section class="ix-block ix-reveal" data-ix-reveal aria-labelledby="ix-siblings-heading">
                <div class="mk-wrap">
                    <div class="ix-head">
                        <p class="ix-kicker">Explore more</p>
                        <h2 id="ix-siblings-heading">Related industries</h2>
                    </div>
                    <div class="ix-related">
                        @foreach ($siblings as $sib)
                            <a href="{{ route('pages.industries.show', ['slug' => $sib['slug']]) }}" class="ix-related__card">
                                <span class="ix-related__icon" aria-hidden="true">
                                    <x-site.industry-icon :slug="$sib['slug']" />
                                </span>
                                <span class="ix-related__body">
                                    <strong>{{ $sib['name'] }}</strong>
                                    <span>{{ $sib['summary'] }}</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="ix-cta" aria-label="Contact">
            <div class="mk-wrap ix-cta__box">
                <p class="ix-cta__brand">GujjuTicks</p>
                <p class="ix-cta__text">{{ $page['cta']['text'] ?? 'Ready to build for your industry?' }}</p>
                <div class="mk-actions ix-cta__actions">
                    <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
                    @if (!empty($page['cta']['secondary_route']))
                        <a class="mk-btn mk-btn--ghost" href="{{ route($page['cta']['secondary_route'], $page['cta']['secondary_params'] ?? []) }}">
                            {{ $page['cta']['secondary_label'] ?? 'Learn more' }}
                        </a>
                    @endif
                </div>
            </div>
        </section>
    </article>

    <script src="{{ asset('js/site/marketing-industry-detail.js') }}" defer></script>

</x-layouts.site>
