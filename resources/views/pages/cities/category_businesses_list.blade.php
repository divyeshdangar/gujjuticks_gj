<x-layouts.site :metaData="$metaData" page="cities">

    @php
        $catLabel = $businessCategory->label ?: str_replace('_', ' ', $businessCategory->name);
        $catPlural = \Illuminate\Support\Str::plural($catLabel);
        $catSlug = str_replace('_', '-', $businessCategory->name);
        $heroImage = route('pages.image.category', [
            'slug' => $catSlug . '-in-' . $dataDetail->slug . '.jpg',
        ]);
        $lead = $metaData['description']
            ?? ("Find trusted {$catPlural} in {$dataDetail->name} — ratings, addresses, and local listings.");
        $aboutParts = array_values(array_filter(
            array_map('trim', explode('___||___', $businessCategory->getDescription($dataDetail->name)))
        ));
    @endphp

    <section class="cy-hero cy-hero--figure" aria-label="{{ $catLabel }} in {{ $dataDetail->name }}">
        <div class="cy-wrap cy-hero__top">
            <nav class="cy-crumbs cy-crumbs--ink" aria-label="Breadcrumb">
                <a href="{{ route('pages.cities.list') }}">Cities</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('pages.cities.detail', ['slug' => $dataDetail->slug]) }}">{{ $dataDetail->name }}</a>
                <span aria-hidden="true">/</span>
                <span>{{ $catLabel }}</span>
            </nav>
        </div>
        <div class="cy-wrap">
            <figure class="cy-hero__figure">
                <img src="{{ $heroImage }}"
                    alt="{{ $catLabel }} in {{ $dataDetail->name }}"
                    width="960" height="540" loading="eager" decoding="async">
            </figure>
        </div>
        <div class="cy-wrap cy-hero__band">
            <h1 class="cy-hero__title cy-hero__title--ink">{{ $catLabel }} in {{ $dataDetail->name }}</h1>
            <p class="cy-hero__lead cy-hero__lead--ink">{{ $lead }}</p>
            <div class="cy-hero__actions">
                <a class="cy-btn cy-btn--solid" href="#businesses">Browse listings</a>
                <a class="cy-btn cy-btn--ghost cy-btn--ghost-ink" href="{{ route('pages.business.add') }}">List a business</a>
            </div>
        </div>
    </section>

    <section class="cy-stats" aria-label="Listing snapshot">
        <div class="cy-wrap cy-stats__grid">
            <div class="cy-stats__item">
                <p class="cy-stats__value">{{ number_format($dataList->total()) }}</p>
                <p class="cy-stats__label">{{ $catPlural }} listed</p>
            </div>
            <div class="cy-stats__item">
                <p class="cy-stats__value">{{ $dataDetail->name }}</p>
                <p class="cy-stats__label">{{ $dataDetail->state }}, {{ $dataDetail->country }}</p>
            </div>
            <div class="cy-stats__item">
                <p class="cy-stats__value">{{ $dataList->currentPage() }} / {{ max($dataList->lastPage(), 1) }}</p>
                <p class="cy-stats__label">Page</p>
            </div>
        </div>
    </section>

    <section class="cy-section" id="businesses" aria-labelledby="cy-biz-heading">
        <div class="cy-wrap">
            <div class="cy-bar cy-bar--list">
                <div class="cy-bar__copy">
                    <h2 class="cy-bar__title" id="cy-biz-heading">{{ $catPlural }} in {{ $dataDetail->name }}</h2>
                    <p class="cy-bar__lead">
                        {{ number_format($dataList->total()) }}
                        {{ \Illuminate\Support\Str::lower($catPlural) }} —
                        sorted by rating
                    </p>
                </div>
            </div>

            @if ($dataList->count() > 0)
                <ol class="cy-biz-list" start="{{ $dataList->firstItem() }}">
                    @foreach ($dataList as $data)
                        @php
                            $initialsImage = route('pages.image.cool', [
                                'slug' => 'characters-' . \App\Helpers\CommonHelper::getInitials($data->name) . '.jpg',
                            ]);
                            $mapUrl = ($data->latitude && $data->longitude)
                                ? 'https://www.google.com/maps/search/?api=1&query=' . $data->latitude . ',' . $data->longitude
                                : ($data->google_maps_url ?: null);
                            $hasActions = $mapUrl || !empty($data->phone) || !empty($data->website);
                            $index = $dataList->firstItem() + $loop->index;
                        @endphp
                        <li class="cy-biz">
                            <span class="cy-biz__index" aria-hidden="true">{{ str_pad((string) $index, 2, '0', STR_PAD_LEFT) }}</span>
                            <figure class="cy-biz__avatar">
                                <img src="{{ $initialsImage }}" alt="{{ $data->name }}" width="112" height="112" loading="lazy"
                                    decoding="async">
                            </figure>
                            <div class="cy-biz__body">
                                <div class="cy-biz__heading">
                                    <h3 class="cy-biz__name">{{ $data->name }}</h3>
                                    @if ($data->rating !== null && $data->rating !== '')
                                        <p class="cy-biz__score" title="Average rating">
                                            <span class="cy-biz__score-value">{{ $data->rating }}</span>
                                            @if ($data->user_ratings_total)
                                                <span class="cy-biz__score-meta">{{ number_format($data->user_ratings_total) }} reviews</span>
                                            @endif
                                        </p>
                                    @endif
                                </div>
                                <p class="cy-biz__place">{{ $dataDetail->name }}, {{ $dataDetail->state }}</p>
                                @if (!empty($data->address))
                                    <p class="cy-biz__address">{{ $data->address }}</p>
                                @endif
                                @if ($hasActions)
                                    <div class="cy-biz__actions">
                                        @if (!empty($data->phone))
                                            <a href="tel:{{ preg_replace('/\s+/', '', $data->phone) }}">Call</a>
                                        @endif
                                        @if (!empty($data->website))
                                            <a href="{{ $data->website }}" target="_blank" rel="noopener noreferrer nofollow">Website</a>
                                        @endif
                                        @if ($mapUrl)
                                            <a href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer nofollow">Map</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ol>

                {{ $dataList->links('vendor.pagination.site') }}
            @else
                <div class="cy-empty" role="status">
                    No {{ \Illuminate\Support\Str::lower($catPlural) }} listed for {{ $dataDetail->name }} yet.
                    <a href="{{ route('pages.business.add') }}">Add a business</a>
                </div>
            @endif
        </div>
    </section>

    @if (isset($siblingCategories) && count($siblingCategories) > 0)
        <section class="cy-section cy-section--alt" aria-labelledby="cy-sib-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="cy-sib-heading">More categories in {{ $dataDetail->name }}</h2>
                    <p>Browse other business types available in this city.</p>
                </div>
                <ul class="cy-cats">
                    @foreach ($siblingCategories as $category)
                        @php
                            $sibSlug = str_replace('_', '-', $category->name);
                            $sibLabel = $category->label ?: str_replace('_', ' ', $category->name);
                        @endphp
                        <li>
                            <a class="cy-cats__item cy-cats__item--link"
                                href="{{ route('pages.cities.businesses.list', ['slug' => $dataDetail->slug, 'category' => $sibSlug]) }}">
                                {{ $sibLabel }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <p class="cy-related-more">
                    <a href="{{ route('pages.cities.detail', ['slug' => $dataDetail->slug]) }}">All categories in {{ $dataDetail->name }}</a>
                </p>
            </div>
        </section>
    @endif

    @if (count($citiesList) > 0)
        <section class="cy-section" aria-labelledby="cy-related-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="cy-related-heading">{{ $catPlural }} in other cities</h2>
                    <p>Explore the same category across Gujarat.</p>
                </div>
                <div class="cy-grid">
                    @foreach ($citiesList as $city)
                        @php
                            $image = !empty($city->image)
                                ? URL::asset('/images/cities/' . $city->image)
                                : asset('images/creative/gujarat.png');
                        @endphp
                        <a href="{{ route('pages.cities.businesses.list', ['slug' => $city->slug, 'category' => $catSlug]) }}"
                            class="cy-city">
                            <figure class="cy-city__media">
                                <img src="{{ $image }}" alt="{{ $city->name }}" width="640" height="400" loading="lazy"
                                    decoding="async">
                            </figure>
                            <div class="cy-city__body">
                                <div class="cy-city__top">
                                    <h3 class="cy-city__name">{{ $city->name }}</h3>
                                </div>
                                <p class="cy-city__place">{{ $catLabel }}</p>
                                <p class="cy-city__summary">
                                    Browse {{ \Illuminate\Support\Str::lower($catPlural) }} listed in {{ $city->name }}, {{ $city->state }}.
                                </p>
                                <div class="cy-city__meta">
                                    <span>{{ number_format($city->businesses_count ?? 0) }} businesses in city</span>
                                    <span class="cy-city__more">View listings</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (count($aboutParts) > 0)
        <section class="cy-section cy-section--alt" aria-labelledby="cy-about-cat-heading">
            <div class="cy-wrap">
                <div class="cy-section__head">
                    <h2 id="cy-about-cat-heading">More on {{ $catPlural }} in {{ $dataDetail->name }}</h2>
                    <p>Context to help you choose local {{ \Illuminate\Support\Str::lower($catPlural) }} with confidence.</p>
                </div>
                <div class="cy-prose">
                    @foreach ($aboutParts as $part)
                        <p>{{ $part }}</p>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="cy-cta" aria-label="List a business">
        <div class="cy-wrap cy-cta__box">
            <div>
                <p class="cy-cta__eyebrow">Are you a {{ \Illuminate\Support\Str::lower($catLabel) }} in {{ $dataDetail->name }}?</p>
                <p>Add your business so people searching this category can find you.</p>
            </div>
            <div class="cy-cta__actions">
                <a class="cy-btn cy-btn--solid" href="{{ route('pages.business.add') }}">List a business</a>
                <a class="cy-btn cy-btn--ghost"
                    href="{{ route('pages.cities.detail', ['slug' => $dataDetail->slug]) }}">Back to {{ $dataDetail->name }}</a>
            </div>
        </div>
    </section>

</x-layouts.site>
