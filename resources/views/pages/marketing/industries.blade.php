<x-layouts.site :metaData="$metaData" page="marketing">

    <div class="ind-stage" data-ind-stage>
        <div class="ind-ambient" aria-hidden="true">
            <div class="ind-ambient__grid"></div>
            <div class="ind-ambient__blob ind-ambient__blob--a"></div>
            <div class="ind-ambient__blob ind-ambient__blob--b"></div>
            <div class="ind-ambient__glow" data-ind-glow></div>
            <canvas class="ind-ambient__canvas" data-ind-canvas width="1" height="1"></canvas>
        </div>

        <section class="ind-hero">
            <div class="mk-wrap ind-hero__grid">
                <div class="ind-hero__copy">
                    <p class="mk-label">{{ $page['label'] }}</p>
                    <p class="ind-hero__brand">GujjuTicks</p>
                    <h1 class="mk-title ind-hero__title">{{ $page['heading'] }}</h1>
                    <p class="mk-lead">{{ $page['lead'] }}</p>
                    <div class="mk-actions">
                        <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Start a project</a>
                        <a class="mk-btn mk-btn--ghost" href="{{ route('pages.services') }}">View services</a>
                    </div>
                </div>

                <div class="ind-orbit" data-ind-orbit aria-hidden="true">
                    <div class="ind-orbit__core" data-ind-orbit-core>
                        <x-site.industry-icon :slug="$page['industries'][0]['slug']" class="ind-icon--xl" />
                    </div>
                    <div class="ind-orbit__ring" data-ind-orbit-ring>
                        @foreach ($page['industries'] as $index => $industry)
                            <button type="button"
                                class="ind-orbit__node{{ $index === 0 ? ' is-active' : '' }}"
                                data-ind-orbit-node
                                data-ind-slug="{{ $industry['slug'] }}"
                                style="--i: {{ $index }}; --n: {{ count($page['industries']) }};"
                                title="{{ $industry['name'] }}"
                                tabindex="-1">
                                <x-site.industry-icon :slug="$industry['slug']" />
                            </button>
                        @endforeach
                    </div>
                    <div class="ind-orbit__pulse"></div>
                </div>
            </div>
        </section>

        <section class="mk-section ind-section" aria-labelledby="industries-explorer-heading">
            <div class="mk-wrap">
                <div class="mk-section__head">
                    <h2 id="industries-explorer-heading">Explore by sector</h2>
                    @if (!empty($page['intro']))
                        <p>{{ $page['intro'] }}</p>
                    @endif
                </div>

                <div class="ind-explorer" data-ind-explorer data-ind-groups='@json($page['groups'])' data-ind-show-base="{{ url('/industries') }}">
                    <div class="ind-explorer__filters" role="group" aria-label="Filter industries by group">
                        <button type="button" class="ind-filter is-active" data-ind-filter="all" aria-pressed="true">
                            All
                        </button>
                        @foreach ($page['groups'] as $groupKey => $groupLabel)
                            <button type="button" class="ind-filter" data-ind-filter="{{ $groupKey }}" aria-pressed="false">
                                {{ $groupLabel }}
                            </button>
                        @endforeach
                    </div>

                    <div class="ind-explorer__body">
                        <ul class="ind-list" role="listbox" aria-label="Industries" data-ind-list>
                            @foreach ($page['industries'] as $index => $industry)
                                <li role="option"
                                    class="ind-list__item{{ $index === 0 ? ' is-selected' : '' }}"
                                    id="ind-option-{{ $industry['slug'] }}"
                                    data-ind-slug="{{ $industry['slug'] }}"
                                    data-ind-group="{{ $industry['group'] }}"
                                    data-ind-name="{{ $industry['name'] }}"
                                    data-ind-detail="{{ $industry['detail'] }}"
                                    data-ind-builds='@json($industry['builds'])'
                                    style="--stagger: {{ $index }}"
                                    tabindex="{{ $index === 0 ? '0' : '-1' }}"
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-controls="ind-panel">
                                    <span class="ind-list__icon" aria-hidden="true">
                                        <x-site.industry-icon :slug="$industry['slug']" />
                                    </span>
                                    <span class="ind-list__text">
                                        <span class="ind-list__name">{{ $industry['name'] }}</span>
                                        <span class="ind-list__summary">{{ $industry['summary'] }}</span>
                                        <a class="ind-list__open" href="{{ route('pages.industries.show', ['slug' => $industry['slug']]) }}" data-ind-open>
                                            Full industry guide
                                        </a>
                                    </span>
                                    <div class="ind-list__mobile-detail" data-ind-mobile-detail hidden>
                                        <p class="ind-panel__detail" data-ind-mobile-text></p>
                                        <p class="ind-panel__builds-label">Typical builds</p>
                                        <ul class="mk-include-list" data-ind-mobile-builds></ul>
                                        <div class="ind-panel__actions">
                                            <a class="mk-btn mk-btn--solid ind-panel__cta" href="{{ route('form.contact') }}">
                                                Talk about this project
                                            </a>
                                            <a class="mk-btn mk-btn--ghost" href="{{ route('pages.industries.show', ['slug' => $industry['slug']]) }}" data-ind-mobile-guide>
                                                Full guide
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        @php $first = $page['industries'][0]; @endphp
                        <aside class="ind-panel" id="ind-panel" aria-live="polite" data-ind-panel>
                            <div class="ind-panel__visual" data-ind-panel-visual>
                                <span class="ind-panel__icon-ring"></span>
                                <span class="ind-panel__icon" data-ind-panel-icon>
                                    <x-site.industry-icon :slug="$first['slug']" class="ind-icon--lg" />
                                </span>
                            </div>
                            <p class="ind-panel__group" data-ind-panel-group>
                                {{ $page['groups'][$first['group']] ?? '' }}
                            </p>
                            <h3 class="ind-panel__title" data-ind-panel-title>{{ $first['name'] }}</h3>
                            <p class="ind-panel__detail" data-ind-panel-detail>{{ $first['detail'] }}</p>
                            <p class="ind-panel__builds-label">Typical builds</p>
                        <ul class="mk-include-list ind-panel__builds" data-ind-panel-builds>
                            @foreach ($first['builds'] as $build)
                                <li>{{ $build }}</li>
                            @endforeach
                        </ul>
                        <div class="ind-panel__actions">
                            <a class="mk-btn mk-btn--solid ind-panel__cta" href="{{ route('form.contact') }}">
                                Talk about this project
                            </a>
                            <a class="mk-btn mk-btn--ghost" href="{{ route('pages.industries.show', ['slug' => $first['slug']]) }}" data-ind-panel-guide>
                                Full industry guide
                            </a>
                        </div>
                    </aside>
                    </div>
                </div>
            </div>
        </section>

        <section class="mk-cta" aria-label="Contact">
            <div class="mk-wrap mk-cta__box">
                <p>Building in one of these industries?</p>
                <a class="mk-btn mk-btn--solid" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
            </div>
        </section>
    </div>

    {{-- Icon SVG templates for JS panel swaps --}}
    <div class="ind-icon-bank" hidden aria-hidden="true" data-ind-icon-bank>
        @foreach ($page['industries'] as $industry)
            <template data-ind-icon-tpl="{{ $industry['slug'] }}">
                <x-site.industry-icon :slug="$industry['slug']" class="ind-icon--lg" />
            </template>
            <template data-ind-icon-tpl-xl="{{ $industry['slug'] }}">
                <x-site.industry-icon :slug="$industry['slug']" class="ind-icon--xl" />
            </template>
        @endforeach
    </div>

    <script src="{{ asset('js/site/marketing-industries.js') }}" defer></script>

</x-layouts.site>
