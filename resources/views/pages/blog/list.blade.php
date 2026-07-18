<x-layouts.site :metaData="$metaData" page="blogs">

    @php
        $items = $dataList->items();
        $lead = count($items) > 0 ? $items[0] : null;
        // Featured layout only on page 1 without search; hero art always follows the lead post when present
        $featured = $dataList->currentPage() === 1 && !request('search') && $lead ? $lead : null;
        $rest = $featured ? array_slice($items, 1) : $items;
        $heroImage = $lead && !empty($lead->image)
            ? URL::asset('/images/blog/' . $lead->image)
            : asset('files/images/blogs-listing-page.png');
        $searchTerm = request('search');
    @endphp

    <section class="jn-hero">
        <div class="jn-hero__copy">
            <p class="jn-hero__label">Journal</p>
            <p class="jn-hero__brand">GujjuTicks</p>
            <h1 class="jn-hero__title">
                @if ($searchTerm)
                    Results for “{!! \App\Helpers\CommonHelper::highlightKeywords($searchTerm, $searchTerm) !!}”
                @else
                    Notes on custom apps, websites, software delivery, and building digital products.
                @endif
            </h1>
            <div class="jn-hero__actions">
                <a class="jn-btn jn-btn--solid" href="#articles">Read the latest</a>
                <a class="jn-btn jn-btn--ghost" href="{{ route('form.contact') }}">Work with us</a>
            </div>
        </div>
        <div class="jn-hero__visual" aria-hidden="true">
            <img src="{{ $heroImage }}" alt="" width="1600" height="900" loading="eager" decoding="async">
        </div>
    </section>

    <section class="jn-section" id="articles" aria-label="Articles">
        <div class="jn-wrap">
            <div class="jn-bar">
                <h2 class="jn-bar__title">
                    @if ($searchTerm)
                        Results
                    @else
                        Latest
                    @endif
                </h2>
                <div class="jn-bar__actions">
                    <form class="jn-search" method="get" action="{{ route('pages.blog.list') }}" role="search">
                        <label class="visually-hidden" for="blog-search">Search journal</label>
                        <input id="blog-search" type="search" name="search" value="{{ $searchTerm }}"
                            placeholder="Search" autocomplete="off">
                        <button type="submit">Go</button>
                    </form>
                    @if ($searchTerm)
                        <a class="jn-clear" href="{{ route('pages.blog.list') }}">Clear</a>
                    @endif
                </div>
            </div>

            @if (count($items) > 0)
                @if ($featured)
                    @php
                        $featuredHref = route('pages.blog.detail', ['slug' => $featured->slug]);
                        $featuredImage = !empty($featured->image)
                            ? URL::asset('/images/blog/' . $featured->image)
                            : asset('files/images/blogs-listing-page.png');
                        $featuredExcerpt = \Illuminate\Support\Str::limit(
                            strip_tags($featured->meta_description ?? ''),
                            160,
                        );
                    @endphp
                    <a href="{{ $featuredHref }}" class="jn-featured">
                        <figure class="jn-featured__media">
                            <img src="{{ $featuredImage }}" alt="{{ $featured->title }}" width="1600" height="900" loading="eager"
                                decoding="async">
                        </figure>
                        <div class="jn-featured__body">
                            <span class="jn-chip">Featured</span>
                            <h3 class="jn-featured__title">{{ $featured->title }}</h3>
                            @if ($featuredExcerpt)
                                <p class="jn-featured__excerpt">{{ $featuredExcerpt }}</p>
                            @endif
                            <div class="jn-meta">
                                @if ($featured->category)
                                    <span>{{ $featured->category->title }}</span>
                                    <span class="jn-meta__dot" aria-hidden="true"></span>
                                @endif
                                <time datetime="{{ $featured->created_at->toAtomString() }}">
                                    {{ $featured->created_at->format('M j, Y') }}
                                </time>
                            </div>
                        </div>
                    </a>
                @endif

                @if (count($rest) > 0)
                    <div class="jn-grid">
                        @foreach ($rest as $data)
                            <x-site.blocks.blog-item :data="$data" :lang="$lang" :search="$searchTerm" />
                        @endforeach
                    </div>
                @endif

                {{ $dataList->links('vendor.pagination.site') }}
            @else
                <div class="jn-empty" role="status">
                    @if ($searchTerm)
                        No articles matched “{{ $searchTerm }}”.
                    @else
                        New writing will appear here soon.
                    @endif
                </div>
            @endif

            @if (isset($categories) && count($categories) > 0)
                <div class="jn-topics">
                    <p class="jn-topics__label">Topics</p>
                    <nav class="jn-topics__list" aria-label="Topics">
                        @foreach ($categories as $category)
                            <a class="jn-topic"
                                href="{{ route('pages.blog.category.detail', ['slug' => $category->slug]) }}">
                                <span>{{ $category->title }}</span>
                                <span class="jn-topic__count">{{ $category->blogs_count }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>
            @endif
        </div>
    </section>

</x-layouts.site>
