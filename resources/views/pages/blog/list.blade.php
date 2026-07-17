<x-layouts.site :metaData="$metaData" page="blogs">

    <section class="blogs-hero"
        style="--blogs-hero-image: url('{{ asset('files/images/blogs-listing-page.png') }}')">
        <div class="blogs-hero__inner">
            <p class="blogs-hero__brand">GujjuTicks</p>
            <h1 class="blogs-hero__title">Insights on software, tech &amp; AI</h1>
            <p class="blogs-hero__lead">{{ $metaData['description'] }}</p>
            <div class="blogs-hero__actions">
                <a class="blogs-btn blogs-btn--primary" href="#articles">Browse articles</a>
                <a class="blogs-btn blogs-btn--ghost" href="{{ route('form.contact') }}">Talk to us</a>
            </div>
        </div>
    </section>

    <section class="blogs-section" id="articles" aria-labelledby="articles-heading">
        <div class="site-wrap">
            <div class="blogs-section__head">
                <h2 id="articles-heading">Latest articles</h2>
                <p>Practical writing from the GujjuTicks team on building products, applying AI, and shipping software.</p>
            </div>

            <div class="blogs-toolbar">
                <form class="blogs-search" method="get" action="{{ route('pages.blog.list') }}" role="search">
                    <label class="visually-hidden" for="blog-search">Search blogs</label>
                    <input id="blog-search" type="search" name="search" value="{{ request('search') }}"
                        placeholder="Search articles" autocomplete="off">
                    <button type="submit">Search</button>
                </form>
                @if (request('search'))
                    <a href="{{ route('pages.blog.list') }}" class="blogs-btn blogs-btn--ghost"
                        style="color: var(--site-ink); border-color: var(--site-line);">Clear search</a>
                @endif
            </div>

            @if (isset($dataList) && count($dataList) > 0)
                <div class="blogs-feed">
                    @foreach ($dataList as $data)
                        <x-site.blocks.blog-item :data="$data" :lang="$lang" />
                    @endforeach
                </div>
                {{ $dataList->links('vendor.pagination.site') }}
            @else
                <div class="blogs-empty" role="status">
                    @if (request('search'))
                        No articles matched “{{ request('search') }}”. Try another search.
                    @else
                        No articles published yet. Check back soon.
                    @endif
                </div>
            @endif
        </div>
    </section>

    @if (isset($categories) && count($categories) > 0)
        <section class="blogs-categories" aria-labelledby="categories-heading">
            <div class="site-wrap">
                <div class="blogs-categories__head">
                    <h2 id="categories-heading">Browse by topic</h2>
                    <p>Explore software, AI, and product themes that matter to your next build.</p>
                </div>
                <div class="blogs-cat-list">
                    @foreach ($categories as $category)
                        <a class="blogs-cat"
                            href="{{ route('pages.blog.category.detail', ['slug' => $category->slug]) }}">
                            <img class="blogs-cat__thumb"
                                src="{{ URL::asset('/images/blog-category/' . $category->image) }}"
                                alt="" width="56" height="56" loading="lazy" decoding="async">
                            <div>
                                <h3 class="blogs-cat__title">{{ $category->title }}</h3>
                                @if ($category->meta_description)
                                    <p class="blogs-cat__desc">{{ $category->meta_description }}</p>
                                @endif
                            </div>
                            <span class="blogs-cat__count">{{ $category->blogs_count }}
                                {{ \Illuminate\Support\Str::plural('article', $category->blogs_count) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</x-layouts.site>
