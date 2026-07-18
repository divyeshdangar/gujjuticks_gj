<x-layouts.site :metaData="$metaData" page="tools">

    @php
        $oldFeatures = old('features', []);
        if (! is_array($oldFeatures)) {
            $oldFeatures = [];
        }
        $startType = old('product_type', $prefillType);
    @endphp

    <div class="tl-page" data-tl-brief>
        <section class="tl-hero">
            <div class="tl-wrap tl-hero__inner">
                <p class="tl-kicker">Project tools</p>
                <p class="tl-brand">GujjuTicks</p>
                <h1 class="tl-title">Project brief builder</h1>
                <p class="tl-lead">
                    Answer a few steps and send a clear brief. We’ll use it to reply with a sharper plan —
                    usually within one business day.
                </p>
                <p class="tl-cross">
                    Need a ballpark first?
                    <a href="{{ route('pages.tools.estimate', array_filter(['type' => $startType])) }}">Open the estimate calculator</a>
                </p>
            </div>
        </section>

        <section class="tl-wrap tl-shell" aria-label="Brief wizard">
            <form method="post" action="{{ route('pages.tools.brief.post') }}" class="tl-panel" data-tl-wizard novalidate>
                @csrf

                <div class="tl-steps" data-tl-steps aria-hidden="true">
                    <span class="tl-steps__item is-on" data-tl-step-dot="0">1</span>
                    <span class="tl-steps__item" data-tl-step-dot="1">2</span>
                    <span class="tl-steps__item" data-tl-step-dot="2">3</span>
                    <span class="tl-steps__item" data-tl-step-dot="3">4</span>
                </div>

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

                <div class="tl-step is-on" data-tl-step="0">
                    <h2 class="tl-panel__title">What are you building?</h2>
                    <p class="tl-panel__hint">Pick the closest fit — you can refine later.</p>
                    <div class="tl-choices" role="radiogroup" aria-label="Product type">
                        @foreach ($productTypes as $type)
                            <label class="tl-choice">
                                <input type="radio" name="product_type" value="{{ $type }}"
                                    @checked($startType === $type) required>
                                <span>{{ $type }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="tl-nav">
                        <button type="button" class="tl-btn tl-btn--solid" data-tl-next>Continue</button>
                    </div>
                </div>

                <div class="tl-step" data-tl-step="1" hidden>
                    <h2 class="tl-panel__title">Goal and must-haves</h2>
                    <p class="tl-panel__hint">One sentence on the outcome, plus features you know you need.</p>

                    <div class="tl-field @error('goal') is-invalid @enderror">
                        <label for="goal">Primary goal</label>
                        <input type="text" name="goal" id="goal" value="{{ old('goal') }}"
                            placeholder="e.g. Launch an MVP that lets users book and pay online" maxlength="255" required>
                    </div>

                    <fieldset class="tl-fieldset">
                        <legend>Must-have features</legend>
                        <div class="tl-chips">
                            @foreach ($features as $feature)
                                <label class="tl-chip">
                                    <input type="checkbox" name="features[]" value="{{ $feature }}"
                                        @checked(in_array($feature, $oldFeatures, true))>
                                    <span>{{ $feature }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>

                    <div class="tl-nav">
                        <button type="button" class="tl-btn tl-btn--ghost" data-tl-prev>Back</button>
                        <button type="button" class="tl-btn tl-btn--solid" data-tl-next>Continue</button>
                    </div>
                </div>

                <div class="tl-step" data-tl-step="2" hidden>
                    <h2 class="tl-panel__title">Timeline and budget</h2>
                    <p class="tl-panel__hint">Optional — helps us size the reply.</p>

                    <div class="tl-grid">
                        <div class="tl-field">
                            <label for="timeline">Preferred timeline</label>
                            <select name="timeline" id="timeline">
                                <option value="">Select one</option>
                                @foreach ($timelines as $timeline)
                                    <option value="{{ $timeline }}" @selected(old('timeline') === $timeline)>{{ $timeline }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="tl-field">
                            <label for="budget">Budget range</label>
                            <select name="budget" id="budget">
                                <option value="">Prefer not to say</option>
                                @foreach ($budgets as $budget)
                                    <option value="{{ $budget }}" @selected(old('budget') === $budget)>{{ $budget }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="tl-field">
                        <label for="links">Links <span class="tl-optional">(optional)</span></label>
                        <input type="text" name="links" id="links" value="{{ old('links') }}"
                            placeholder="Site, docs, Figma, competitors" maxlength="500">
                    </div>

                    <div class="tl-nav">
                        <button type="button" class="tl-btn tl-btn--ghost" data-tl-prev>Back</button>
                        <button type="button" class="tl-btn tl-btn--solid" data-tl-next>Continue</button>
                    </div>
                </div>

                <div class="tl-step" data-tl-step="3" hidden>
                    <h2 class="tl-panel__title">How we reach you</h2>
                    <p class="tl-panel__hint">We’ll reply to this brief — typically within one business day.</p>

                    <div class="tl-grid">
                        <div class="tl-field @error('name') is-invalid @enderror">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                autocomplete="name" required>
                        </div>
                        <div class="tl-field @error('email') is-invalid @enderror">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                autocomplete="email" required>
                        </div>
                        <div class="tl-field @error('phone') is-invalid @enderror">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                autocomplete="tel" inputmode="numeric" maxlength="10" required
                                placeholder="10-digit mobile">
                        </div>
                    </div>

                    <div class="tl-field">
                        <label for="notes">Notes <span class="tl-optional">(optional)</span></label>
                        <textarea name="notes" id="notes" rows="4"
                            placeholder="Constraints, users, or anything else that helps">{{ old('notes') }}</textarea>
                    </div>

                    <div class="tl-nav">
                        <button type="button" class="tl-btn tl-btn--ghost" data-tl-prev>Back</button>
                        <button type="submit" class="tl-btn tl-btn--solid">Send brief</button>
                    </div>
                </div>
            </form>
        </section>
    </div>

</x-layouts.site>
