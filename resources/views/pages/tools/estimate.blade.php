<x-layouts.site :metaData="$metaData" page="tools">

    @php
        $oldAddons = old('addons', []);
        if (! is_array($oldAddons)) {
            $oldAddons = [];
        }
        $startType = old('product_type', $prefillType);
        $startComplexity = old('complexity', 'standard');
    @endphp

    <div class="tl-page" data-tl-estimate
        data-tl-config='@json($estimateConfig)'>
        <section class="tl-hero">
            <div class="tl-wrap tl-hero__inner">
                <p class="tl-kicker">Project tools</p>
                <p class="tl-brand">GujjuTicks</p>
                <h1 class="tl-title">Project estimate calculator</h1>
                <p class="tl-lead">
                    Get an indicative timeline and budget band for planning conversations.
                    This is <strong>not a formal quote</strong> — final scope is confirmed after a brief.
                </p>
                <p class="tl-cross">
                    Ready to write it up?
                    <a href="{{ route('pages.tools.brief', array_filter(['type' => $startType])) }}">Open the brief builder</a>
                    ·
                    <a href="{{ route('pages.tools.stack') }}">Tech stack quiz</a>
                </p>
            </div>
        </section>

        <section class="tl-wrap tl-estimate" aria-label="Estimate calculator">
            <div class="tl-panel">
                <h2 class="tl-panel__title">Shape the project</h2>
                <p class="tl-panel__hint">Adjust inputs — the range updates live.</p>

                <fieldset class="tl-fieldset">
                    <legend>Product type</legend>
                    <div class="tl-choices tl-choices--compact" role="radiogroup">
                        @foreach ($productTypes as $type)
                            <label class="tl-choice">
                                <input type="radio" name="calc_product_type" value="{{ $type }}"
                                    data-tl-type @checked($startType === $type)>
                                <span>{{ $type }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <fieldset class="tl-fieldset">
                    <legend>Complexity</legend>
                    <div class="tl-choices tl-choices--compact" role="radiogroup">
                        @foreach ($estimateConfig['complexity'] as $key => $item)
                            <label class="tl-choice">
                                <input type="radio" name="calc_complexity" value="{{ $key }}"
                                    data-tl-complexity @checked($startComplexity === $key)>
                                <span>{{ $item['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <fieldset class="tl-fieldset">
                    <legend>Add-ons</legend>
                    <div class="tl-chips">
                        @foreach ($estimateConfig['addOns'] as $key => $addon)
                            <label class="tl-chip">
                                <input type="checkbox" value="{{ $key }}" data-tl-addon
                                    @checked(in_array($key, $oldAddons, true))>
                                <span>{{ $addon['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
            </div>

            <aside class="tl-result" aria-live="polite">
                <p class="tl-result__label">Indicative range</p>
                <p class="tl-result__weeks" data-tl-weeks>—</p>
                <p class="tl-result__budget" data-tl-budget>—</p>
                <p class="tl-result__note">Planning numbers only. Not a quote or commitment.</p>
                <ul class="tl-result__summary" data-tl-summary></ul>
                <button type="button" class="tl-btn tl-btn--solid tl-result__cta" data-tl-open-send>
                    Send this estimate
                </button>
            </aside>
        </section>

        <section class="tl-wrap tl-send" id="estimate-send" hidden data-tl-send>
            <form method="post" action="{{ route('pages.tools.estimate.post') }}" class="tl-panel" novalidate>
                @csrf
                <input type="hidden" name="product_type" data-tl-field-type value="{{ $startType }}">
                <input type="hidden" name="complexity" data-tl-field-complexity value="{{ $startComplexity }}">
                <div data-tl-addon-fields></div>
                <input type="hidden" name="weeks_low" data-tl-field-weeks-low value="{{ old('weeks_low', 6) }}">
                <input type="hidden" name="weeks_high" data-tl-field-weeks-high value="{{ old('weeks_high', 12) }}">
                <input type="hidden" name="lakhs_low" data-tl-field-lakhs-low value="{{ old('lakhs_low', 2) }}">
                <input type="hidden" name="lakhs_high" data-tl-field-lakhs-high value="{{ old('lakhs_high', 6) }}">

                <h2 class="tl-panel__title">Send this estimate</h2>
                <p class="tl-panel__hint">We’ll treat it as a conversation starter and follow up on next steps.</p>

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
                        <label for="est-name">Name</label>
                        <input type="text" name="name" id="est-name" value="{{ old('name') }}"
                            autocomplete="name" required>
                    </div>
                    <div class="tl-field @error('email') is-invalid @enderror">
                        <label for="est-email">Email</label>
                        <input type="email" name="email" id="est-email" value="{{ old('email') }}"
                            autocomplete="email" required>
                    </div>
                    <div class="tl-field @error('phone') is-invalid @enderror">
                        <label for="est-phone">Phone</label>
                        <input type="tel" name="phone" id="est-phone" value="{{ old('phone') }}"
                            autocomplete="tel" inputmode="numeric" maxlength="10" required>
                    </div>
                </div>

                <div class="tl-field">
                    <label for="est-notes">Notes <span class="tl-optional">(optional)</span></label>
                    <textarea name="notes" id="est-notes" rows="3">{{ old('notes') }}</textarea>
                </div>

                <div class="tl-nav">
                    <button type="submit" class="tl-btn tl-btn--solid">Submit estimate</button>
                </div>
            </form>
        </section>
    </div>

</x-layouts.site>
