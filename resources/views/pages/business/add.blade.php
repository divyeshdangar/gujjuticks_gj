<x-layouts.site :metaData="$metaData" page="cities">
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('assets/plugin/croppie/croppie.css') }}">
    </x-slot:styles>

    @php
        $cityCount = number_format($stats['cities'] ?? $cities->count());
        $categoryCount = number_format($stats['categories'] ?? $categories->count());
        $businessCount = number_format($stats['businesses'] ?? 0);
        $sampleCategories = $categories->take(10);
        $heroCities = $cities->take(6);
        $heroCategories = $categories->take(6);
        $previewCity = $heroCities->first();
        $previewCategory = $heroCategories->first();
    @endphp

    <section class="ba-cover" data-ba-cover aria-label="Add your business">
        <div class="ba-cover__ambient" aria-hidden="true">
            <div class="ba-cover__mesh"></div>
            <div class="ba-cover__orb ba-cover__orb--a"></div>
            <div class="ba-cover__orb ba-cover__orb--b"></div>
            <div class="ba-cover__glow" data-ba-glow></div>
        </div>

        <div class="cy-wrap ba-cover__grid">
            <div class="ba-cover__copy">
                <nav class="cy-crumbs cy-crumbs--ink" aria-label="Breadcrumb">
                    <a href="{{ route('pages.cities.list') }}">Cities</a>
                    <span aria-hidden="true">/</span>
                    <span>Add business</span>
                </nav>
                <h1 class="ba-cover__title">Get found in your city</h1>
                <p class="ba-cover__lead">
                    Free listing in Gujarat’s city directory — appear under the city and category people already browse.
                    Submit once; we publish after a quick review.
                </p>
                <div class="ba-cover__meta" aria-label="Directory snapshot">
                    <span><strong>{{ $cityCount }}+</strong> cities</span>
                    <span><strong>{{ $categoryCount }}</strong> categories</span>
                    <span><strong>{{ $businessCount }}+</strong> live listings</span>
                </div>
                <div class="cy-hero__actions ba-cover__actions">
                    <a class="cy-btn cy-btn--solid" href="#business-form">Fill the listing form</a>
                    <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink" href="{{ route('pages.cities.list') }}">Explore cities</a>
                </div>
            </div>

            <div class="ba-stage" data-ba-stage>
                <div class="ba-stage__frame" data-ba-frame>
                    <p class="ba-stage__label">Live preview</p>
                    <article class="ba-preview" data-ba-preview>
                        <div class="ba-preview__top">
                            <span class="ba-preview__badge" data-ba-status>Pending review</span>
                            <span class="ba-preview__pulse" aria-hidden="true"></span>
                        </div>
                        <h2 class="ba-preview__name" data-ba-name>Your business name</h2>
                        <p class="ba-preview__place">
                            <span data-ba-city>{{ $previewCity?->name ?? 'Your city' }}</span>
                            ·
                            <span data-ba-category>{{ $previewCategory?->label ?? ($previewCategory?->name ?? 'Category') }}</span>
                        </p>
                        <p class="ba-preview__blurb" data-ba-blurb>
                            A short about line helps locals understand what you offer before they call.
                        </p>
                        <div class="ba-preview__foot">
                            <span>Phone on file</span>
                            <span data-ba-path>{{ ($previewCity?->name ?? 'City') }} / {{ $previewCategory?->label ?? 'Category' }}</span>
                        </div>
                    </article>
                </div>

                <div class="ba-stage__rail" role="group" aria-label="Preview city">
                    <p class="ba-stage__rail-label">Tap a city</p>
                    <div class="ba-chips" data-ba-cities>
                        @foreach ($heroCities as $index => $city)
                            <button type="button"
                                class="ba-chip{{ $index === 0 ? ' is-active' : '' }}"
                                data-ba-city-chip
                                data-name="{{ $city->name }}"
                                aria-pressed="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $city->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="ba-stage__rail" role="group" aria-label="Preview category">
                    <p class="ba-stage__rail-label">Tap a category</p>
                    <div class="ba-chips" data-ba-categories>
                        @foreach ($heroCategories as $index => $category)
                            @php
                                $label = $category->label ?: str_replace('_', ' ', $category->name);
                            @endphp
                            <button type="button"
                                class="ba-chip{{ $index === 0 ? ' is-active' : '' }}"
                                data-ba-category-chip
                                data-name="{{ $label }}"
                                aria-pressed="{{ $index === 0 ? 'true' : 'false' }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cy-section" aria-labelledby="ba-benefits-heading">
        <div class="cy-wrap">
            <div class="cy-section__head">
                <h2 id="ba-benefits-heading">Why owners list here</h2>
                <p>Show up where locals already look — by city, then by category.</p>
            </div>
            <div class="ba-benefits">
                <article class="ba-benefits__item">
                    <span class="ba-benefits__num" aria-hidden="true">01</span>
                    <h3>City-first discovery</h3>
                    <p>Your listing sits on the city page people open when they need a service nearby.</p>
                </article>
                <article class="ba-benefits__item">
                    <span class="ba-benefits__num" aria-hidden="true">02</span>
                    <h3>Category clarity</h3>
                    <p>Shoppers filter by type — clinics, stores, agencies — so the right intent reaches you.</p>
                </article>
                <article class="ba-benefits__item">
                    <span class="ba-benefits__num" aria-hidden="true">03</span>
                    <h3>Contact that works</h3>
                    <p>Phone, address, and optional website/logo give callers what they need without friction.</p>
                </article>
                <article class="ba-benefits__item">
                    <span class="ba-benefits__num" aria-hidden="true">04</span>
                    <h3>Reviewed before live</h3>
                    <p>Submissions stay pending until approved — so the directory stays trustworthy.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="cy-section cy-section--alt" aria-labelledby="ba-how-heading">
        <div class="cy-wrap">
            <div class="cy-section__head">
                <h2 id="ba-how-heading">From form to live listing</h2>
                <p>Three clear steps — nothing publishes until review is done.</p>
            </div>
            <ol class="cy-steps">
                <li class="cy-steps__item">
                    <span class="cy-steps__num">01</span>
                    <h3>Submit details</h3>
                    <p>Name, city, category, about text, phone, and address — logo and website are optional.</p>
                </li>
                <li class="cy-steps__item">
                    <span class="cy-steps__num">02</span>
                    <h3>Admin review</h3>
                    <p>Your entry is saved as pending and stays off public city pages until someone approves it.</p>
                </li>
                <li class="cy-steps__item">
                    <span class="cy-steps__num">03</span>
                    <h3>Go live</h3>
                    <p>Approved listings appear under that city and category for people browsing the directory.</p>
                </li>
            </ol>
        </div>
    </section>

    <section class="cy-section cy-section--alt ba-form-section" id="business-form" aria-labelledby="ba-form-heading">
        <div class="cy-wrap">
            <div class="cy-section__head ba-form-section__head">
                <h2 id="ba-form-heading">Listing form</h2>
                <p>Required fields match what we store and show after approval. Optional fields help your listing stand out.</p>
            </div>

            <div class="ba-layout">
                <div class="ba-form-panel">
                    <div class="ba-progress" aria-hidden="true">
                        <span class="is-on">1 · Basics</span>
                        <span>2 · Contact</span>
                        <span>3 · Logo</span>
                    </div>

                    <form method="post" action="{{ route('pages.business.store') }}" id="basicDetailsForm"
                        enctype="multipart/form-data" class="ba-form" novalidate>
                        @csrf

                        @if ($errors->any())
                            <div class="ba-errors" role="alert">
                                <strong>{{ __('dashboard.error') }}</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <fieldset class="ba-fieldset">
                            <legend>
                                <span class="ba-fieldset__step">1</span>
                                Basic details
                            </legend>
                            <div class="ba-grid">
                                <div class="ba-field ba-field--full @error('name') is-invalid @enderror">
                                    <label for="name">Business name <span aria-hidden="true">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        maxlength="255" placeholder="Registered or trading name" required
                                        autocomplete="organization">
                                    @error('name')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="ba-field @error('city_id') is-invalid @enderror">
                                    <label for="city_id">City <span aria-hidden="true">*</span></label>
                                    <select name="city_id" id="city_id" required>
                                        <option value="">Select city</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                @selected((string) ($selectedCityId ?? '') === (string) $city->id)>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="ba-field @error('place_category_id') is-invalid @enderror">
                                    <label for="place_category_id">Category <span aria-hidden="true">*</span></label>
                                    <select name="place_category_id" id="place_category_id" required>
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @selected((string) ($selectedCategoryId ?? '') === (string) $category->id)>
                                                {{ $category->label ?: str_replace('_', ' ', $category->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('place_category_id')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="ba-fieldset">
                            <legend>
                                <span class="ba-fieldset__step">2</span>
                                About &amp; contact
                            </legend>
                            <div class="ba-grid">
                                <div class="ba-field ba-field--full @error('description') is-invalid @enderror">
                                    <label for="description">About your business <span aria-hidden="true">*</span></label>
                                    <textarea name="description" id="description" rows="5" maxlength="2048"
                                        placeholder="What you offer, who you serve, and what makes you local"
                                        required>{{ old('description') }}</textarea>
                                    <p class="ba-field__hint">Up to 2048 characters.</p>
                                    @error('description')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="ba-field @error('phone') is-invalid @enderror">
                                    <label for="phone">Phone <span aria-hidden="true">*</span></label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                        placeholder="10–12 digit number" required pattern="[0-9]{10,12}"
                                        minlength="10" maxlength="12" inputmode="numeric" autocomplete="tel">
                                    @error('phone')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="ba-field @error('website') is-invalid @enderror">
                                    <label for="website">Website <span class="ba-optional">(optional)</span></label>
                                    <input type="url" name="website" id="website" value="{{ old('website') }}"
                                        maxlength="255" placeholder="https://example.com" autocomplete="url">
                                    @error('website')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="ba-field ba-field--full @error('address') is-invalid @enderror">
                                    <label for="address">Address <span aria-hidden="true">*</span></label>
                                    <textarea name="address" id="address" rows="3" maxlength="1048"
                                        placeholder="Street, area, city, PIN" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="ba-fieldset">
                            <legend>
                                <span class="ba-fieldset__step">3</span>
                                Logo <span class="ba-optional">(optional)</span>
                            </legend>
                            <div class="ba-grid">
                                <div class="ba-field ba-field--full @error('image') is-invalid @enderror" id="imageFormGroup">
                                    <label for="image">Upload image</label>
                                    <div class="ba-upload">
                                        <input type="file" name="image" id="image" accept="image/*">
                                        <p class="ba-upload__hint">PNG or JPG · square crop · shown on your listing after approval</p>
                                    </div>
                                    <input type="hidden" id="croppedImage" name="croppedImage" value="">
                                    @error('image')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                    @error('croppedImage')
                                        <span class="ba-field__error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="ba-crop" id="upload-image-image" hidden></div>
                            </div>
                        </fieldset>

                        <div class="ba-actions">
                            <button type="submit" class="cy-btn cy-btn--solid" id="ba-submit">Submit for review</button>
                            <p class="ba-actions__note">Saved as <strong>pending</strong> — not public until an admin approves it.</p>
                        </div>
                    </form>
                </div>

                <aside class="ba-aside" aria-label="Listing tips">
                    <div class="ba-aside__card">
                        <p class="ba-aside__eyebrow">Review policy</p>
                        <h2>Nothing goes live automatically</h2>
                        <p class="ba-aside__lead">
                            Every form submission starts as pending. Only approved listings appear in city category pages.
                        </p>
                    </div>

                    <div class="ba-aside__block">
                        <h3>What we collect</h3>
                        <ul class="ba-checklist">
                            <li><strong>Name, city, category</strong> — where you show</li>
                            <li><strong>Description &amp; address</strong> — context and location</li>
                            <li><strong>Phone</strong> — required (10–12 digits)</li>
                            <li><strong>Website &amp; logo</strong> — optional</li>
                        </ul>
                    </div>

                    <div class="ba-aside__block">
                        <h3>Tips for faster approval</h3>
                        <ul class="ba-checklist">
                            <li>Use a real phone people can reach</li>
                            <li>Write a clear 2–4 sentence about section</li>
                            <li>Match the closest category — don’t overclaim</li>
                            <li>Include area / landmark in the address</li>
                        </ul>
                    </div>

                    <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink ba-aside__cta" href="{{ route('pages.cities.list') }}">
                        View city directory
                    </a>
                </aside>
            </div>
        </div>
    </section>

    @if ($sampleCategories->count() > 0)
        <section class="cy-section" aria-labelledby="ba-cats-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="ba-cats-heading">Categories you can choose</h2>
                    <p>These are available in the category dropdown above — pick the closest match for your business.</p>
                </div>
                <ul class="cy-cats" aria-label="Sample categories">
                    @foreach ($sampleCategories as $category)
                        <li class="cy-cats__item">{{ $category->label ?: str_replace('_', ' ', $category->name) }}</li>
                    @endforeach
                    @if ($categories->count() > $sampleCategories->count())
                        <li class="cy-cats__item cy-cats__item--more">+{{ $categories->count() - $sampleCategories->count() }} more in the form</li>
                    @endif
                </ul>
            </div>
        </section>
    @endif

    <section class="cy-cta" aria-label="Start listing">
        <div class="cy-wrap cy-cta__box">
            <div>
                <p class="cy-cta__eyebrow">Ready when you are</p>
                <p>Take a few minutes to submit — review happens before anything is published.</p>
            </div>
            <div class="cy-cta__actions">
                <a class="cy-btn cy-btn--solid" href="#business-form">Back to the form</a>
                <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink" href="{{ route('form.contact') }}">Contact us</a>
            </div>
        </div>
    </section>

    <x-slot:scripts>
        <script>
            (function () {
                var cover = document.querySelector("[data-ba-cover]");
                if (!cover) return;

                var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
                var glow = cover.querySelector("[data-ba-glow]");
                var frame = cover.querySelector("[data-ba-frame]");
                var preview = cover.querySelector("[data-ba-preview]");
                var cityEl = cover.querySelector("[data-ba-city]");
                var categoryEl = cover.querySelector("[data-ba-category]");
                var pathEl = cover.querySelector("[data-ba-path]");
                var cityChips = cover.querySelectorAll("[data-ba-city-chip]");
                var categoryChips = cover.querySelectorAll("[data-ba-category-chip]");

                function setActive(chips, active) {
                    chips.forEach(function (chip) {
                        var on = chip === active;
                        chip.classList.toggle("is-active", on);
                        chip.setAttribute("aria-pressed", on ? "true" : "false");
                    });
                }

                function refreshPath() {
                    if (!cityEl || !categoryEl || !pathEl) return;
                    pathEl.textContent = cityEl.textContent + " / " + categoryEl.textContent;
                }

                function bumpPreview() {
                    if (!preview || reduce) {
                        refreshPath();
                        return;
                    }
                    preview.classList.add("is-updating");
                    window.setTimeout(function () {
                        refreshPath();
                        preview.classList.remove("is-updating");
                    }, 160);
                }

                cityChips.forEach(function (chip) {
                    chip.addEventListener("click", function () {
                        setActive(cityChips, chip);
                        if (cityEl) cityEl.textContent = chip.getAttribute("data-name") || chip.textContent;
                        bumpPreview();
                    });
                });

                categoryChips.forEach(function (chip) {
                    chip.addEventListener("click", function () {
                        setActive(categoryChips, chip);
                        if (categoryEl) categoryEl.textContent = chip.getAttribute("data-name") || chip.textContent;
                        bumpPreview();
                    });
                });

                if (!reduce && glow) {
                    cover.addEventListener("pointermove", function (e) {
                        var rect = cover.getBoundingClientRect();
                        glow.style.left = e.clientX - rect.left + "px";
                        glow.style.top = e.clientY - rect.top + "px";
                        glow.classList.add("is-on");
                    });
                    cover.addEventListener("pointerleave", function () {
                        glow.classList.remove("is-on");
                    });
                }

                if (!reduce && frame && window.matchMedia("(min-width: 901px)").matches) {
                    frame.addEventListener("pointermove", function (e) {
                        var rect = frame.getBoundingClientRect();
                        var x = (e.clientX - rect.left) / rect.width - 0.5;
                        var y = (e.clientY - rect.top) / rect.height - 0.5;
                        frame.style.transform =
                            "perspective(900px) rotateX(" + (-y * 6).toFixed(2) + "deg) rotateY(" + (x * 8).toFixed(2) + "deg)";
                    });
                    frame.addEventListener("pointerleave", function () {
                        frame.style.transform = "perspective(900px) rotateX(0deg) rotateY(0deg)";
                    });
                }
            })();
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('assets/plugin/croppie/croppie.js') }}"></script>
        <script>
            (function() {
                var form = document.getElementById('basicDetailsForm');
                var cropRoot = document.getElementById('upload-image-image');
                var fileInput = document.getElementById('image');
                var croppedInput = document.getElementById('croppedImage');
                var imageGroup = document.getElementById('imageFormGroup');
                var $crop = null;
                var imageSelected = false;
                var submitting = false;

                function initCroppie() {
                    if (!window.jQuery || !cropRoot || $crop) return;
                    var width = imageGroup ? imageGroup.clientWidth : 320;
                    $crop = $('#upload-image-image').croppie({
                        enableResize: true,
                        viewport: { width: 200, height: 200, type: 'square' },
                        boundary: { width: Math.max(width, 260), height: 300 }
                    });
                }

                window.addEventListener('load', function() {
                    initCroppie();
                });

                if (fileInput) {
                    fileInput.addEventListener('change', function() {
                        if (!this.files || !this.files[0]) return;
                        if (!$crop) initCroppie();
                        cropRoot.hidden = false;
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#upload-image-image').croppie('bind', { url: e.target.result }).then(function() {
                                imageSelected = true;
                            });
                        };
                        reader.readAsDataURL(this.files[0]);
                    });
                }

                if (form) {
                    form.addEventListener('submit', function(event) {
                        if (submitting) return;
                        if (!imageSelected || !$crop) {
                            croppedInput.value = '';
                            return;
                        }
                        event.preventDefault();
                        $('#upload-image-image').croppie('result', {
                            type: 'base64',
                            format: 'png',
                            size: { width: 512, height: 512 }
                        }).then(function(resp) {
                            croppedInput.value = resp || '';
                            submitting = true;
                            form.submit();
                        }).catch(function() {
                            croppedInput.value = '';
                            submitting = true;
                            form.submit();
                        });
                    });
                }
            })();
        </script>
    </x-slot:scripts>
</x-layouts.site>
