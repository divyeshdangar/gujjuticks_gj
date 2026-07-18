<x-layouts.site :metaData="$metaData" page="cities">

    @php
        $cityCount = (int) ($stats['cities'] ?? $cities->count());
        $categoryCount = (int) ($stats['categories'] ?? $categories->count());
        $businessCount = (int) ($stats['businesses'] ?? 0);
        $featuredCities = $cities->take(12);
        $categoryList = $categories->take(16);
        $tickerCats = $categories->take(10);
    @endphp

    <div class="bd-hub" data-bd-hub>
        <div class="bd-ambient" aria-hidden="true">
            <div class="bd-ambient__grid"></div>
            <div class="bd-ambient__blob bd-ambient__blob--a"></div>
            <div class="bd-ambient__blob bd-ambient__blob--b"></div>
            <div class="bd-ambient__glow" data-bd-glow></div>
            <canvas class="bd-ambient__canvas" data-bd-particles width="1" height="1"></canvas>
        </div>
        <div class="bd-progress" data-bd-progress aria-hidden="true"></div>

        <section class="bd-hero" aria-label="Business directory">
            <div class="cy-wrap bd-hero__grid">
                <div class="bd-hero__copy">
                    <p class="bd-live">
                        <span class="bd-live__dot" aria-hidden="true"></span>
                        Live directory · Gujarat
                    </p>
                    <p class="bd-hero__brand">GujjuTicks</p>
                    <h1 class="bd-hero__title">
                        Find local businesses
                        <span class="bd-hero__typed" data-bd-type>by city</span><span class="bd-hero__caret"
                            aria-hidden="true"></span>
                    </h1>
                    <p class="bd-hero__lead">
                        Browse shops, services, and professionals across Gujarat — open a city,
                        filter by category, then connect.
                    </p>
                    <div class="bd-hero__actions">
                        <a class="cy-btn cy-btn--solid" href="#browse-cities">Browse cities</a>
                        <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink" href="{{ route('pages.business.add') }}">List a business</a>
                    </div>
                </div>

                <div class="bd-hero__visual">
                    <div class="bd-map" data-bd-map-stage>
                        <span class="bd-map__grid" aria-hidden="true"></span>
                        <canvas class="bd-map__canvas" data-bd-map width="1" height="1" aria-hidden="true"></canvas>
                        <div class="bd-map__radar" data-bd-radar aria-hidden="true"></div>
                        <div class="bd-map__pins" role="group" aria-label="Cities on the map">
                            @php
                                $mapPins = [
                                    ['name' => 'Ahmedabad', 'slug' => 'ahmedabad', 'x' => 48, 'y' => 38],
                                    ['name' => 'Surat', 'slug' => 'surat', 'x' => 52, 'y' => 72],
                                    ['name' => 'Vadodara', 'slug' => 'vadodara', 'x' => 56, 'y' => 52],
                                    ['name' => 'Rajkot', 'slug' => 'rajkot', 'x' => 30, 'y' => 48],
                                    ['name' => 'Jamnagar', 'slug' => 'jamnagar', 'x' => 18, 'y' => 40],
                                    ['name' => 'Bhavnagar', 'slug' => 'bhavnagar', 'x' => 44, 'y' => 62],
                                ];
                            @endphp
                            @foreach ($mapPins as $i => $pin)
                                <a class="bd-map__pin"
                                    href="{{ route('pages.cities.detail', ['slug' => $pin['slug']]) }}"
                                    style="--x: {{ $pin['x'] }}%; --y: {{ $pin['y'] }}%; --d: {{ $i * 0.35 }}s"
                                    data-bd-pin="{{ $pin['x'] }},{{ $pin['y'] }}"
                                    data-bd-pin-index="{{ $i }}"
                                    data-bd-pin-name="{{ $pin['name'] }}">
                                    <span class="bd-map__dot" aria-hidden="true"></span>
                                    <span class="bd-map__tip">{{ $pin['name'] }}</span>
                                    <span class="visually-hidden">{{ $pin['name'] }} city page</span>
                                </a>
                            @endforeach
                        </div>
                        <p class="bd-map__status" data-bd-map-status>Hover a city · click to open</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bd-strip" aria-label="Directory snapshot">
            <div class="cy-wrap bd-strip__grid">
                <div class="bd-strip__item bd-reveal">
                    <p class="bd-strip__value" data-bd-count="{{ $cityCount }}">{{ number_format($cityCount) }}</p>
                    <p class="bd-strip__label">Cities covered</p>
                </div>
                <div class="bd-strip__item bd-reveal" style="--i: 1">
                    <p class="bd-strip__value" data-bd-count="{{ $categoryCount }}">{{ number_format($categoryCount) }}</p>
                    <p class="bd-strip__label">Categories</p>
                </div>
                <div class="bd-strip__item bd-reveal" style="--i: 2">
                    <p class="bd-strip__value" data-bd-count="{{ $businessCount }}">{{ number_format($businessCount) }}</p>
                    <p class="bd-strip__label">Live listings</p>
                </div>
            </div>
        </section>

        @if ($tickerCats->count() > 0)
            <div class="bd-marquee" aria-hidden="true">
                <div class="bd-marquee__track">
                    @foreach ([1, 2] as $copy)
                        @foreach ($tickerCats as $category)
                            <span>{{ $category->label ?: str_replace('_', ' ', $category->name) }}</span>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endif

        <section class="bd-section" id="browse-cities" aria-labelledby="bd-cities-heading">
            <div class="cy-wrap">
                <div class="bd-bar bd-reveal">
                    <div>
                        <h2 class="bd-bar__title" id="bd-cities-heading">Cities on the map</h2>
                        <p class="bd-bar__lead">Open a city for categories and local business listings.</p>
                    </div>
                    <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink" href="{{ route('pages.cities.list') }}">All cities</a>
                </div>

                @if ($featuredCities->count() > 0)
                    <div class="bd-list">
                        @foreach ($featuredCities as $i => $city)
                            @php
                                $image = !empty($city->image)
                                    ? URL::asset('/images/cities/' . $city->image)
                                    : asset('images/creative/gujarat.png');
                            @endphp
                            <a href="{{ route('pages.cities.detail', ['slug' => $city->slug]) }}"
                                class="bd-row bd-reveal" style="--i: {{ $i % 8 }}">
                                <span class="bd-row__index">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <figure class="bd-row__media">
                                    <img src="{{ $image }}" alt="{{ $city->name }}" width="160" height="160" loading="lazy"
                                        decoding="async">
                                </figure>
                                <div class="bd-row__copy">
                                    <h3 class="bd-row__title">{{ $city->name }}</h3>
                                    <p class="bd-row__place">
                                        @if (!empty($city->name_gj))
                                            {{ $city->name_gj }}
                                            <span aria-hidden="true">·</span>
                                        @endif
                                        {{ $city->state ?? 'Gujarat' }}
                                    </p>
                                </div>
                                <div class="bd-row__meta">
                                    <span>{{ number_format($city->businesses_count ?? 0) }} businesses</span>
                                    <span class="bd-row__go">Open city</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="cy-empty" role="status">Cities will appear here once they are published.</div>
                @endif
            </div>
        </section>

        <section class="bd-section bd-section--alt" id="browse-categories" aria-labelledby="bd-cats-heading">
            <div class="cy-wrap">
                <div class="bd-bar bd-reveal">
                    <div>
                        <h2 class="bd-bar__title" id="bd-cats-heading">Browse by category</h2>
                        <p class="bd-bar__lead">Choose a city first, then filter by place type.</p>
                    </div>
                </div>
                <ul class="bd-cats" aria-label="Business categories">
                    @foreach ($categoryList as $i => $category)
                        <li class="bd-cats__item bd-reveal" style="--i: {{ $i % 8 }}">
                            <span class="bd-cats__name">{{ $category->label ?: str_replace('_', ' ', $category->name) }}</span>
                            @if (($category->businesses_count ?? 0) > 0)
                                <span class="bd-cats__count">{{ number_format($category->businesses_count) }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <p class="bd-cats__note bd-reveal">
                    Categories open inside each city page.
                    <a href="{{ route('pages.cities.list') }}">Pick a city</a> to start.
                </p>
            </div>
        </section>

        <section class="bd-section" aria-labelledby="bd-how-heading">
            <div class="cy-wrap">
                <div class="bd-bar bd-reveal">
                    <div>
                        <h2 class="bd-bar__title" id="bd-how-heading">How it works</h2>
                        <p class="bd-bar__lead">Three steps from map to contact details.</p>
                    </div>
                </div>
                <ol class="bd-steps">
                    <li class="bd-steps__item bd-reveal">
                        <span class="bd-steps__num">01</span>
                        <h3>Choose a city</h3>
                        <p>Open a city page from the list — or browse the full Gujarat directory.</p>
                    </li>
                    <li class="bd-steps__item bd-reveal" style="--i: 1">
                        <span class="bd-steps__num">02</span>
                        <h3>Filter by category</h3>
                        <p>Narrow to restaurants, clinics, stores, gyms, and other local place types.</p>
                    </li>
                    <li class="bd-steps__item bd-reveal" style="--i: 2">
                        <span class="bd-steps__num">03</span>
                        <h3>Connect locally</h3>
                        <p>Review listing details and reach out when you find the right fit.</p>
                    </li>
                </ol>
            </div>
        </section>

        <section class="bd-section bd-section--alt" aria-labelledby="bd-owners-heading">
            <div class="cy-wrap bd-owners">
                <div class="bd-owners__copy bd-reveal">
                    <h2 id="bd-owners-heading">Own a business?</h2>
                    <p>
                        Submit a free listing under the city and category customers already browse.
                        Keep details accurate and appear when locals search your area.
                    </p>
                    <ul class="bd-owners__list">
                        <li>Appear in city and category browse</li>
                        <li>Share phone, address, and website</li>
                        <li>Update your profile after login</li>
                    </ul>
                    <div class="bd-hero__actions">
                        <a class="cy-btn cy-btn--solid" href="{{ route('pages.business.add') }}">List a business</a>
                        @guest
                            <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink" href="{{ route('login') }}">Login to manage</a>
                        @else
                            <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink" href="{{ route('dashboard.user') }}">Open dashboard</a>
                        @endguest
                    </div>
                </div>
                <div class="bd-owners__stage bd-reveal" style="--i: 1" aria-hidden="true">
                    <div class="bd-owners__card bd-owners__card--a"></div>
                    <div class="bd-owners__card bd-owners__card--b"></div>
                    <div class="bd-owners__card bd-owners__card--main">
                        <p class="bd-owners__badge">Pending review</p>
                        <p class="bd-owners__name">Your business name</p>
                        <p class="bd-owners__path">City → Category → Listing</p>
                        <div class="bd-owners__scan"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bd-cta bd-reveal" aria-label="Explore cities">
            <div class="cy-wrap bd-cta__box">
                <div>
                    <p class="bd-cta__eyebrow">Ready to look around</p>
                    <p>Start with a city page — categories and listings are one click away.</p>
                </div>
                <div class="bd-cta__actions">
                    <a class="cy-btn cy-btn--solid" href="{{ route('pages.cities.list') }}">Explore cities</a>
                    <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink" href="{{ route('pages.business.add') }}">List a business</a>
                </div>
            </div>
        </section>
    </div>

</x-layouts.site>
