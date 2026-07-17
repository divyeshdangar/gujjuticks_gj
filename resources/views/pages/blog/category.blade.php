<x-layouts.site :metaData="$metaData" page="blogs">

    @php
        $categoryImage = $dataDetail->image
            ? URL::asset('/images/blog-category/' . $dataDetail->image)
            : asset('files/images/blogs-listing-page.png');
        $items = $dataList->items();
    @endphp

    <section class="jn-hero">
        <div class="jn-hero__copy">
            <nav class="post-crumb" aria-label="Breadcrumb">
                <a href="{{ route('pages.blog.list') }}">Journal</a>
                <span class="post-crumb__sep" aria-hidden="true">/</span>
                <span>{{ $dataDetail->title }}</span>
            </nav>
            <p class="jn-hero__label">Topic</p>
            <h1 class="jn-hero__brand cat-hero__title">{{ $dataDetail->title }}</h1>
            @if ($dataDetail->meta_description)
                <p class="jn-hero__title">{{ $dataDetail->meta_description }}</p>
            @endif
            <div class="jn-hero__actions">
                <a class="jn-btn jn-btn--solid" href="#articles">Browse articles</a>
                <a class="jn-btn jn-btn--ghost" href="{{ route('pages.blog.list') }}">All topics</a>
            </div>
        </div>
        <div class="jn-hero__visual">
            <img src="{{ $categoryImage }}" alt="{{ $dataDetail->title }}" width="1600" height="900"
                loading="eager" decoding="async">
        </div>
    </section>

    <section class="jn-section" id="articles" aria-label="Articles in {{ $dataDetail->title }}">
        <div class="jn-wrap">
            <div class="jn-bar">
                <h2 class="jn-bar__title">
                    @if (request('search'))
                        Results
                    @else
                        Articles
                    @endif
                </h2>
                <div class="jn-bar__actions">
                    <form class="jn-search" method="get"
                        action="{{ route('pages.blog.category.detail', ['slug' => $dataDetail->slug]) }}"
                        role="search">
                        <label class="visually-hidden" for="category-search">Search in {{ $dataDetail->title }}</label>
                        <input id="category-search" type="search" name="search" value="{{ request('search') }}"
                            placeholder="Search this topic" autocomplete="off">
                        <button type="submit">Go</button>
                    </form>
                    @if (request('search'))
                        <a class="jn-clear"
                            href="{{ route('pages.blog.category.detail', ['slug' => $dataDetail->slug]) }}">Clear</a>
                    @endif
                </div>
            </div>

            @if (isset($subCategories) && count($subCategories) > 0)
                <div class="jn-topics cat-subtopics">
                    <p class="jn-topics__label">Subtopics</p>
                    <nav class="jn-topics__list" aria-label="Subtopics">
                        @foreach ($subCategories as $sub)
                            <a class="jn-topic"
                                href="{{ route('pages.blog.category.detail', ['slug' => $sub->slug]) }}">
                                <span>{{ $sub->title }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>
            @endif

            @if (count($items) > 0)
                <div class="jn-grid">
                    @foreach ($items as $data)
                        <x-site.blocks.blog-item :data="$data" :lang="$lang" />
                    @endforeach
                </div>
                {{ $dataList->links('vendor.pagination.site') }}
            @else
                <div class="jn-empty" role="status">
                    @if (request('search'))
                        No articles matched “{{ request('search') }}” in this topic.
                    @else
                        No articles in this topic yet.
                    @endif
                </div>
            @endif

            @if (!empty($dataDetail->description))
                <div class="cat-about">
                    <h2 class="cat-about__title">About {{ $dataDetail->title }}</h2>
                    <div class="post-prose cat-about__body">
                        {!! $dataDetail->description !!}
                    </div>
                </div>
            @endif

            @if (isset($categories) && count($categories) > 0)
                <div class="jn-topics">
                    <p class="jn-topics__label">Other topics</p>
                    <nav class="jn-topics__list" aria-label="Other topics">
                        @foreach ($categories as $category)
                            <a class="jn-topic"
                                href="{{ route('pages.blog.category.detail', ['slug' => $category->slug]) }}">
                                <span>{{ $category->title }}</span>
                                @if (isset($category->blogs_count))
                                    <span class="jn-topic__count">{{ $category->blogs_count }}</span>
                                @endif
                            </a>
                        @endforeach
                    </nav>
                </div>
            @endif
        </div>
    </section>

</x-layouts.site>
