<x-layouts.site :metaData="$metaData" page="cities">

    @php
        $heroImage = asset('images/creative/gujarat.png');
        $cityCount = number_format($stats['cities']);
        $categoryCount = number_format($stats['categories']);
        $businessCount = number_format($stats['businesses']);
    @endphp

    <section class="cy-hero" aria-label="City directory">
        <div class="cy-hero__media" aria-hidden="true">
            <img src="{{ $heroImage }}" alt="" width="1600" height="900" loading="eager" decoding="async">
        </div>
        <div class="cy-hero__veil" aria-hidden="true"></div>
        <div class="cy-wrap cy-hero__copy">
            <p class="cy-hero__brand">GujjuTicks</p>
            <h1 class="cy-hero__title">
                @if ($searchTerm)
                    Cities matching “{{ $searchTerm }}”
                @else
                    Gujarat city directory
                @endif
            </h1>
            <p class="cy-hero__lead">
                @if ($searchTerm)
                    Browse matching cities and open a city page for local businesses and categories.
                @else
                    Explore {{ $cityCount }}+ cities across Gujarat — local businesses, categories, and city guides in one place.
                @endif
            </p>
            <div class="cy-hero__actions">
                <a class="cy-btn cy-btn--solid" href="#city-list">Browse cities</a>
                <a class="cy-btn cy-btn--ghost" href="{{ route('pages.business.add') }}">List a business</a>
            </div>
        </div>
    </section>

    <section class="cy-stats" aria-label="Directory snapshot">
        <div class="cy-wrap cy-stats__grid">
            <div class="cy-stats__item">
                <p class="cy-stats__value">{{ $cityCount }}+</p>
                <p class="cy-stats__label">Cities covered</p>
            </div>
            <div class="cy-stats__item">
                <p class="cy-stats__value">{{ $categoryCount }}</p>
                <p class="cy-stats__label">Business categories</p>
            </div>
            <div class="cy-stats__item">
                <p class="cy-stats__value">{{ $businessCount }}+</p>
                <p class="cy-stats__label">Listed businesses</p>
            </div>
        </div>
    </section>

    <section class="cy-section" id="city-list" aria-label="Cities">
        <div class="cy-wrap">
            <div class="cy-bar">
                <div class="cy-bar__copy">
                    <h2 class="cy-bar__title">
                        @if ($searchTerm)
                            Search results
                        @else
                            All cities
                        @endif
                    </h2>
                    <p class="cy-bar__lead">Pick a city to see categories, listings, and a local overview.</p>
                </div>
                <div class="cy-bar__actions">
                    <form class="cy-search" method="get" action="{{ route('pages.cities.list') }}" role="search">
                        <label class="visually-hidden" for="city-search">Search cities</label>
                        <input id="city-search" type="search" name="search" value="{{ $searchTerm }}"
                            placeholder="Search by city name" autocomplete="off">
                        <button type="submit">Search</button>
                    </form>
                    @if ($searchTerm)
                        <a class="cy-clear" href="{{ route('pages.cities.list') }}">Clear</a>
                    @endif
                </div>
            </div>

            @if ($dataList->count() > 0)
                <div class="cy-grid">
                    @foreach ($dataList as $city)
                        @php
                            $excerpt = \Illuminate\Support\Str::limit(
                                strip_tags($city->meta_description ?: $city->description ?: ''),
                                140,
                            );
                            $image = !empty($city->image)
                                ? URL::asset('/images/cities/' . $city->image)
                                : $heroImage;
                        @endphp
                        <a href="{{ route('pages.cities.detail', ['slug' => $city->slug]) }}" class="cy-city">
                            <figure class="cy-city__media">
                                <img src="{{ $image }}" alt="" width="640" height="400" loading="lazy"
                                    decoding="async">
                            </figure>
                            <div class="cy-city__body">
                                <div class="cy-city__top">
                                    <h3 class="cy-city__name">{{ $city->name }}</h3>
                                    @if (!empty($city->name_gj))
                                        <span class="cy-city__gj">{{ $city->name_gj }}</span>
                                    @endif
                                </div>
                                <p class="cy-city__place">{{ $city->state }}, {{ $city->country }}</p>
                                @if ($excerpt)
                                    <p class="cy-city__summary">{{ $excerpt }}</p>
                                @endif
                                <div class="cy-city__meta">
                                    <span>{{ number_format($city->businesses_count) }} businesses</span>
                                    <span class="cy-city__more">Open city</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{ $dataList->links('vendor.pagination.site') }}
            @else
                <div class="cy-empty" role="status">
                    @if ($searchTerm)
                        No cities matched “{{ $searchTerm }}”. Try another spelling or clear the search.
                    @else
                        Cities will appear here once they are published.
                    @endif
                </div>
            @endif
        </div>
    </section>

    @if (!$searchTerm)
        <section class="cy-section cy-section--alt" aria-labelledby="cy-find-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="cy-find-heading">What you can find in each city</h2>
                    <p>Open a city page to browse local listings by category — from cafes and clinics to stores and services.</p>
                </div>
                <ul class="cy-cats" aria-label="Popular categories">
                    @foreach ($categories as $category)
                        <li class="cy-cats__item">{{ $category->label ?: str_replace('_', ' ', $category->name) }}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="cy-section" aria-labelledby="cy-how-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="cy-how-heading">How to use this directory</h2>
                    <p>A simple path from city list to local businesses.</p>
                </div>
                <ol class="cy-steps">
                    <li class="cy-steps__item">
                        <span class="cy-steps__num">01</span>
                        <h3>Choose a city</h3>
                        <p>Search or scroll the list — every entry links to a dedicated city page with local context.</p>
                    </li>
                    <li class="cy-steps__item">
                        <span class="cy-steps__num">02</span>
                        <h3>Browse categories</h3>
                        <p>Filter by place type such as restaurants, doctors, gyms, stores, and more.</p>
                    </li>
                    <li class="cy-steps__item">
                        <span class="cy-steps__num">03</span>
                        <h3>Open a listing</h3>
                        <p>Review business details, ratings, and maps links when available — then visit or contact them.</p>
                    </li>
                </ol>
            </div>
        </section>

        <section class="cy-section cy-section--alt" aria-labelledby="cy-about-heading">
            <div class="cy-wrap cy-about">
                <div class="cy-section__head">
                    <h2 id="cy-about-heading">Gujarat, city by city</h2>
                    <p>From coastal ports to inland trade hubs — a practical directory for residents, travelers, and local businesses.</p>
                </div>
                <div class="cy-about__prose">
                    <p>
                        Gujarat’s cities each have a distinct mix of industry, culture, and daily life. Ahmedabad and Surat
                        anchor large commercial corridors; Vadodara and Rajkot blend heritage with growing services;
                        coastal and border towns support trade, tourism, and manufacturing. This directory brings those
                        places together so you can move from a statewide overview to a single city’s businesses quickly.
                    </p>
                    <p>
                        Each city page pairs a short local guide with category browse. Use it to find trusted services near
                        you, plan a visit, or discover what is already listed before you add your own business. Listings
                        grow over time — if you run a local shop or service, you can submit it for review and appear in
                        the cities you serve.
                    </p>
                </div>
            </div>
        </section>
    @endif

    <section class="cy-cta" aria-label="List a business">
        <div class="cy-wrap cy-cta__box">
            <div>
                <p class="cy-cta__eyebrow">Grow your local presence</p>
                <p>Run a business in Gujarat? Add it to the directory so people can find you by city and category.</p>
            </div>
            <div class="cy-cta__actions">
                <a class="cy-btn cy-btn--solid" href="{{ route('pages.business.add') }}">List a business</a>
                <a class="cy-btn cy-btn--ghost" href="{{ route('form.contact') }}">Contact GujjuTicks</a>
            </div>
        </div>
    </section>

</x-layouts.site>
