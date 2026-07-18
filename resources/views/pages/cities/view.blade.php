<x-layouts.site :metaData="$metaData" page="cities">

    @php
        $cityImage = !empty($dataDetail->image)
            ? URL::asset('/images/cities/' . $dataDetail->image)
            : asset('images/creative/gujarat.png');
        $lead = $dataDetail->meta_description
            ?: \Illuminate\Support\Str::limit(strip_tags($dataDetail->description ?: ''), 180);
        $hasEn = filled(trim(strip_tags($dataDetail->description ?? '')));
        $hasGj = filled(trim(strip_tags($dataDetail->description_gj ?? '')));
    @endphp

    <section class="cy-hero cy-hero--detail" aria-label="{{ $dataDetail->name }}">
        <div class="cy-hero__media" aria-hidden="true">
            <img src="{{ $cityImage }}" alt="" width="1600" height="900" loading="eager" decoding="async">
        </div>
        <div class="cy-hero__veil" aria-hidden="true"></div>
        <div class="cy-wrap cy-hero__copy">
            <nav class="cy-crumbs" aria-label="Breadcrumb">
                <a href="{{ route('pages.cities.list') }}">Cities</a>
                <span aria-hidden="true">/</span>
                <span>{{ $dataDetail->name }}</span>
            </nav>
            <p class="cy-hero__brand">GujjuTicks</p>
            <h1 class="cy-hero__title">{{ $dataDetail->name }}</h1>
            @if (!empty($dataDetail->name_gj))
                <p class="cy-hero__gj">{{ $dataDetail->name_gj }}</p>
            @endif
            <p class="cy-hero__lead">
                {{ $lead ?: ($dataDetail->name . ' local directory — businesses, categories, and a quick city guide.') }}
            </p>
            <div class="cy-hero__actions">
                <a class="cy-btn cy-btn--solid" href="#categories">Browse categories</a>
                <a class="cy-btn cy-btn--ghost" href="{{ route('pages.business.add') }}">List a business</a>
            </div>
        </div>
    </section>

    <section class="cy-stats" aria-label="{{ $dataDetail->name }} snapshot">
            <div class="cy-wrap cy-stats__grid">
                <div class="cy-stats__item">
                    <p class="cy-stats__value">{{ number_format($stats['businesses']) }}+</p>
                    <p class="cy-stats__label">Listed businesses</p>
                </div>
                <div class="cy-stats__item">
                    <p class="cy-stats__value">{{ number_format($stats['categories']) }}</p>
                    <p class="cy-stats__label">Categories to browse</p>
                </div>
                <div class="cy-stats__item">
                    <p class="cy-stats__value">{{ $dataDetail->state }}</p>
                    <p class="cy-stats__label">{{ $dataDetail->country }}</p>
                </div>
            </div>
    </section>

    <section class="cy-section" id="categories" aria-labelledby="cy-cat-heading">
        <div class="cy-wrap">
            <div class="cy-section__head">
                <h2 id="cy-cat-heading">Businesses in {{ $dataDetail->name }}</h2>
                <p>
                    Explore local services and shops by category. Each link opens listings for
                    {{ $dataDetail->name }} in that category.
                </p>
            </div>

            @if (count($categories) > 0)
                <div class="cy-cat-grid">
                    @foreach ($categories as $category)
                        @php
                            $catSlug = str_replace('_', '-', $category->name);
                            $catLabel = $category->label ?: str_replace('_', ' ', $category->name);
                            $catImage = route('pages.image.category', [
                                'slug' => $catSlug . '-in-' . $dataDetail->slug . '.jpg',
                            ]);
                        @endphp
                        <a href="{{ route('pages.cities.businesses.list', ['slug' => $dataDetail->slug, 'category' => $catSlug]) }}"
                            class="cy-cat">
                            <figure class="cy-cat__media">
                                <img src="{{ $catImage }}" alt="" width="480" height="320" loading="lazy"
                                    decoding="async">
                            </figure>
                            <div class="cy-cat__body">
                                <h3 class="cy-cat__title">{{ $catLabel }}</h3>
                                <p class="cy-cat__meta">in {{ $dataDetail->name }}</p>
                                <span class="cy-cat__more">View listings</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="cy-empty" role="status">Categories for this city will appear here soon.</div>
            @endif
        </div>
    </section>

    @if ($hasEn)
        <section class="cy-section cy-section--alt" aria-labelledby="cy-guide-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="cy-guide-heading">Quick guide to {{ $dataDetail->name }}</h2>
                    <p>A short overview to help you get oriented before browsing listings.</p>
                </div>
                <div class="cy-prose">
                    {!! $dataDetail->description !!}
                </div>
            </div>
        </section>
    @endif

    @if ($hasGj)
        <section class="cy-section" aria-labelledby="cy-guide-gj-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="cy-guide-gj-heading">
                        {{ $dataDetail->name_gj ?: $dataDetail->name }} શહેર વિશે
                    </h2>
                    <p>સ્થાનિક વ્યવસાયો જોતા પહેલાં શહેર વિશે ટૂંકી માહિતી.</p>
                </div>
                <div class="cy-prose">
                    {!! $dataDetail->description_gj !!}
                </div>
            </div>
        </section>
    @endif

    @if (count($dataList) > 0)
        <section class="cy-section cy-section--alt" aria-labelledby="cy-related-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="cy-related-heading">More cities in Gujarat</h2>
                    <p>Continue exploring nearby and notable cities across the state.</p>
                </div>
                <div class="cy-grid">
                    @foreach ($dataList as $city)
                        @php
                            $excerpt = \Illuminate\Support\Str::limit(
                                strip_tags($city->meta_description ?: $city->description ?: ''),
                                120,
                            );
                            $image = !empty($city->image)
                                ? URL::asset('/images/cities/' . $city->image)
                                : asset('images/creative/gujarat.png');
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
                <p class="cy-related-more">
                    <a href="{{ route('pages.cities.list') }}">View all cities</a>
                </p>
            </div>
        </section>
    @endif

    <section class="cy-cta" aria-label="List a business">
        <div class="cy-wrap cy-cta__box">
            <div>
                <p class="cy-cta__eyebrow">Business in {{ $dataDetail->name }}?</p>
                <p>Add your listing so people searching this city can find you by category.</p>
            </div>
            <div class="cy-cta__actions">
                <a class="cy-btn cy-btn--solid" href="{{ route('pages.business.add') }}">List a business</a>
                <a class="cy-btn cy-btn--ghost" href="{{ route('pages.cities.list') }}">All cities</a>
            </div>
        </div>
    </section>

</x-layouts.site>
