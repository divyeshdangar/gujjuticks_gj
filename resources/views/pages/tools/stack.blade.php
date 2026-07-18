<x-layouts.site :metaData="$metaData" page="tools">

    @php
        $oldCaps = old('capabilities', []);
        if (! is_array($oldCaps)) {
            $oldCaps = [];
        }
        $startType = old('product_type');
        $startSurface = old('surface');
        $startPriority = old('priority');
        $hasErrors = $errors->any();
        $catalogPreview = array_slice($stackConfig['catalog'] ?? [], 0, 6, true);
    @endphp

    <div class="tl-page" data-tl-stack
        data-tl-config='@json($stackConfig)'
        @if ($hasErrors) data-tl-show-send @endif>

        <section class="tl-hero">
            <div class="tl-wrap tl-hero__inner">
                <p class="tl-kicker">Project tools</p>
                <h1 class="tl-title">Tech stack recommender</h1>
                <p class="tl-lead">
                    Answer four short questions. Get a practical primary stack, supporting layers, fit notes,
                    and tools — each linked to the Technology pages behind the recommendation.
                </p>
                <p class="tl-cross">
                    Prefer planning numbers or a written brief?
                    <a href="{{ route('pages.tools.estimate') }}">Estimate</a>
                    ·
                    <a href="{{ route('pages.tools.brief') }}">Brief builder</a>
                </p>
            </div>
        </section>

        <section class="tl-wrap tl-stack-intro" aria-label="How recommendations work">
            <div class="tl-stack-intro__grid">
                @foreach ($principles as $principle)
                    <article class="tl-stack-intro__item">
                        <h2 class="tl-stack-intro__title">{{ $principle['title'] }}</h2>
                        <p class="tl-stack-intro__text">{{ $principle['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        @if ($catalogPreview !== [])
            <section class="tl-wrap tl-stack-catalog" aria-label="Technology layers in play">
                <div class="tl-stack-catalog__head">
                    <p class="tl-result__label">Layers we score against</p>
                    <h2 class="tl-stack-catalog__title">Built from the Technology catalog</h2>
                    <p class="tl-stack-catalog__lead">
                        Recommendations pull titles, tools, and fit notes from the same Technology pages used across the site.
                    </p>
                </div>
                <div class="tl-stack-catalog__grid">
                    @foreach ($catalogPreview as $slug => $item)
                        <a class="tl-stack-catalog__card" href="{{ $item['url'] }}">
                            <span class="tl-stack-catalog__tag">{{ $item['tag'] }}</span>
                            <span class="tl-stack-catalog__name">{{ $item['title'] }}</span>
                            @if (!empty($item['best_for']))
                                <span class="tl-stack-catalog__meta">Best for: {{ $item['best_for'] }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
                <p class="tl-stack-catalog__more">
                    <a href="{{ route('pages.technology') }}">Browse all technology pages</a>
                </p>
            </section>
        @endif

        <section class="tl-wrap tl-shell" aria-label="Stack quiz" data-tl-quiz>
            <div class="tl-panel" data-tl-stack-wizard>
                <div class="tl-steps" data-tl-steps aria-hidden="true">
                    <span class="tl-steps__item is-on" data-tl-step-dot="0">1</span>
                    <span class="tl-steps__item" data-tl-step-dot="1">2</span>
                    <span class="tl-steps__item" data-tl-step-dot="2">3</span>
                    <span class="tl-steps__item" data-tl-step-dot="3">4</span>
                </div>

                <div class="tl-step is-on" data-tl-step="0">
                    <h2 class="tl-panel__title">What are you building?</h2>
                    <p class="tl-panel__hint">Pick the closest fit — this shapes the spine of the stack.</p>
                    <div class="tl-choices tl-choices--rich" role="radiogroup" aria-label="Product type">
                        @foreach ($productTypes as $type => $hint)
                            <label class="tl-choice tl-choice--rich">
                                <input type="radio" name="quiz_product_type" value="{{ $type }}"
                                    data-tl-product required @checked($startType === $type)>
                                <span>
                                    <strong>{{ $type }}</strong>
                                    <em>{{ $hint }}</em>
                                </span>
                            </label>
                        @endforeach
                    </div>
                    <div class="tl-nav">
                        <button type="button" class="tl-btn tl-btn--solid" data-tl-next>Continue</button>
                    </div>
                </div>

                <div class="tl-step" data-tl-step="1" hidden>
                    <h2 class="tl-panel__title">Primary surface?</h2>
                    <p class="tl-panel__hint">Where people will spend most of their time.</p>
                    <div class="tl-choices tl-choices--rich" role="radiogroup" aria-label="Primary surface">
                        @foreach ($surfaces as $key => $surface)
                            <label class="tl-choice tl-choice--rich">
                                <input type="radio" name="quiz_surface" value="{{ $key }}"
                                    data-tl-surface required @checked($startSurface === $key)>
                                <span>
                                    <strong>{{ $surface['label'] }}</strong>
                                    <em>{{ $surface['hint'] }}</em>
                                </span>
                            </label>
                        @endforeach
                    </div>
                    <div class="tl-nav">
                        <button type="button" class="tl-btn tl-btn--ghost" data-tl-prev>Back</button>
                        <button type="button" class="tl-btn tl-btn--solid" data-tl-next>Continue</button>
                    </div>
                </div>

                <div class="tl-step" data-tl-step="2" hidden>
                    <h2 class="tl-panel__title">Must-have capabilities</h2>
                    <p class="tl-panel__hint">Select anything you already know you need. Optional — more selections add supporting layers.</p>
                    <div class="tl-chips">
                        @foreach ($capabilities as $key => $label)
                            <label class="tl-chip">
                                <input type="checkbox" value="{{ $key }}" data-tl-capability
                                    @checked(in_array($key, $oldCaps, true))>
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="tl-nav">
                        <button type="button" class="tl-btn tl-btn--ghost" data-tl-prev>Back</button>
                        <button type="button" class="tl-btn tl-btn--solid" data-tl-next>Continue</button>
                    </div>
                </div>

                <div class="tl-step" data-tl-step="3" hidden>
                    <h2 class="tl-panel__title">What matters most right now?</h2>
                    <p class="tl-panel__hint">We’ll bias the recommendation and next-step advice toward that priority.</p>
                    <div class="tl-choices tl-choices--rich" role="radiogroup" aria-label="Priority">
                        @foreach ($priorities as $key => $priority)
                            <label class="tl-choice tl-choice--rich">
                                <input type="radio" name="quiz_priority" value="{{ $key }}"
                                    data-tl-priority required @checked($startPriority === $key)>
                                <span>
                                    <strong>{{ $priority['label'] }}</strong>
                                    <em>{{ $priority['hint'] }}</em>
                                </span>
                            </label>
                        @endforeach
                    </div>
                    <div class="tl-nav">
                        <button type="button" class="tl-btn tl-btn--ghost" data-tl-prev>Back</button>
                        <button type="button" class="tl-btn tl-btn--solid" data-tl-finish>See recommendation</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="tl-wrap tl-stack-out" data-tl-results hidden aria-live="polite">
            <div class="tl-stack-out__head">
                <p class="tl-result__label">Suggested stack</p>
                <h2 class="tl-stack-out__title" data-tl-primary-title>—</h2>
                <p class="tl-stack-out__lead" data-tl-primary-why></p>
                <ul class="tl-result__summary" data-tl-answer-chips></ul>
            </div>

            <div class="tl-stack-facts" data-tl-primary-facts hidden>
                <div class="tl-stack-facts__item">
                    <p class="tl-stack-facts__label">Best for</p>
                    <p class="tl-stack-facts__value" data-tl-fact-best></p>
                </div>
                <div class="tl-stack-facts__item">
                    <p class="tl-stack-facts__label">Maturity</p>
                    <p class="tl-stack-facts__value" data-tl-fact-maturity></p>
                </div>
                <div class="tl-stack-facts__item">
                    <p class="tl-stack-facts__label">Delivery</p>
                    <p class="tl-stack-facts__value" data-tl-fact-delivery></p>
                </div>
            </div>

            <article class="tl-stack-card tl-stack-card--primary" data-tl-primary-card>
                <p class="tl-stack-card__tag" data-tl-primary-tag></p>
                <h3 class="tl-stack-card__title">
                    <a href="#" data-tl-primary-link></a>
                </h3>
                <p class="tl-stack-card__summary" data-tl-primary-summary></p>
                <ul class="tl-stack-card__tools" data-tl-primary-tools></ul>
                <ul class="tl-stack-card__fit" data-tl-primary-fit></ul>
                <p class="tl-stack-card__why" data-tl-primary-card-why></p>
            </article>

            <div class="tl-stack-layers">
                <h3 class="tl-stack-layers__title">Supporting layers</h3>
                <div class="tl-stack-layers__grid" data-tl-layers></div>
            </div>

            <div class="tl-stack-next" data-tl-next-steps>
                <h3 class="tl-stack-next__title">Suggested next steps</h3>
                <ol class="tl-stack-next__list" data-tl-next-list></ol>
            </div>

            <p class="tl-stack-out__note">
                Indicative starting point for planning — not a locked architecture.
                Browse the full set on
                <a href="{{ route('pages.technology') }}">Technology</a>.
            </p>

            <div class="tl-stack-out__actions">
                <button type="button" class="tl-btn tl-btn--solid" data-tl-open-send>Discuss this stack</button>
                <button type="button" class="tl-btn tl-btn--ghost" data-tl-restart>Retake quiz</button>
                <a class="tl-btn tl-btn--ghost" href="{{ route('pages.tools.brief') }}">Build a brief</a>
                <a class="tl-btn tl-btn--ghost" href="{{ route('pages.tools.estimate') }}">Get an estimate</a>
            </div>
        </section>

        <section class="tl-wrap tl-send" id="stack-send" hidden data-tl-send>
            <form method="post" action="{{ route('pages.tools.stack.post') }}" class="tl-panel" novalidate>
                @csrf
                <input type="hidden" name="product_type" data-tl-field-product value="{{ old('product_type') }}">
                <input type="hidden" name="surface" data-tl-field-surface value="{{ old('surface') }}">
                <input type="hidden" name="priority" data-tl-field-priority value="{{ old('priority') }}">
                <input type="hidden" name="primary_slug" data-tl-field-primary value="{{ old('primary_slug') }}">
                <div data-tl-capability-fields></div>
                <div data-tl-layer-fields></div>

                <h2 class="tl-panel__title">Discuss this stack</h2>
                <p class="tl-panel__hint">We’ll treat the recommendation as a conversation starter and follow up on next steps.</p>

                @if ($errors->any())
                    <div class="tl-alert" role="alert">
                        <strong>Please fix the highlighted fields</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="tl-grid">
                    <div class="tl-field @error('name') is-invalid @enderror">
                        <label for="stack-name">Name</label>
                        <input type="text" name="name" id="stack-name" value="{{ old('name') }}"
                            autocomplete="name" required>
                    </div>
                    <div class="tl-field @error('email') is-invalid @enderror">
                        <label for="stack-email">Email</label>
                        <input type="email" name="email" id="stack-email" value="{{ old('email') }}"
                            autocomplete="email" required>
                    </div>
                    <div class="tl-field @error('phone') is-invalid @enderror">
                        <label for="stack-phone">Phone</label>
                        <input type="tel" name="phone" id="stack-phone" value="{{ old('phone') }}"
                            autocomplete="tel" inputmode="numeric" maxlength="10" required
                            placeholder="10-digit mobile">
                    </div>
                </div>

                <div class="tl-field">
                    <label for="stack-notes">Notes <span class="tl-optional">(optional)</span></label>
                    <textarea name="notes" id="stack-notes" rows="4"
                        placeholder="Constraints, existing systems, or must-use vendors">{{ old('notes') }}</textarea>
                </div>

                <div class="tl-nav">
                    <button type="submit" class="tl-btn tl-btn--solid">Send recommendation</button>
                </div>
            </form>
        </section>
    </div>

</x-layouts.site>
