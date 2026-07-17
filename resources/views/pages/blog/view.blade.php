<x-layouts.site :metaData="$metaData" page="blogs">

    @php
        $image = URL::asset('/images/blog/' . $dataDetail->image);
        $author = $dataDetail->user->name ?? 'GujjuTicks';
    @endphp

    <article class="post" itemscope itemtype="https://schema.org/BlogPosting">
        <meta itemprop="headline" content="{{ $dataDetail->title }}">
        <meta itemprop="datePublished" content="{{ $dataDetail->created_at->toAtomString() }}">
        <link itemprop="image" href="{{ $image }}">

        <header class="post-header">
            <div class="post-header__inner">
                <nav class="post-crumb" aria-label="Breadcrumb">
                    <a href="{{ route('pages.blog.list') }}">Journal</a>
                    @if ($dataDetail->category)
                        <span class="post-crumb__sep" aria-hidden="true">/</span>
                        <a
                            href="{{ route('pages.blog.category.detail', ['slug' => $dataDetail->category->slug]) }}">{{ $dataDetail->category->title }}</a>
                    @endif
                </nav>

                @if ($dataDetail->category)
                    <p class="post-kicker">{{ $dataDetail->category->title }}</p>
                @endif

                <h1 class="post-title" itemprop="name">{{ $dataDetail->title }}</h1>

                @if ($dataDetail->meta_description)
                    <p class="post-deck" itemprop="description">{{ $dataDetail->meta_description }}</p>
                @endif

                <div class="post-meta">
                    <div class="post-meta__author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <span class="post-meta__label">Written by</span>
                        <span itemprop="name">{{ ucwords($author) }}</span>
                    </div>
                    <div class="post-meta__date">
                        <span class="post-meta__label">Published</span>
                        <time datetime="{{ $dataDetail->created_at->toAtomString() }}">
                            {{ $dataDetail->created_at->format('M j, Y') }}
                        </time>
                    </div>
                </div>
            </div>
        </header>

        <figure class="post-cover">
            <img src="{{ $image }}" alt="{{ $dataDetail->title }}" width="1600" height="900" loading="eager"
                decoding="async">
        </figure>

        <div class="post-content">
            <div class="post-prose" itemprop="articleBody">
                {!! $dataDetail->description !!}
            </div>
        </div>

        <aside class="post-cta">
            <div class="post-cta__inner">
                <div>
                    <p class="post-cta__label">GujjuTicks</p>
                    <p class="post-cta__text">Need software, AI, or a product partner? We’re ready to help.</p>
                </div>
                <a class="jn-btn jn-btn--solid" href="{{ route('form.contact') }}">Contact us</a>
            </div>
        </aside>
    </article>

    @if (isset($dataList) && count($dataList) > 0)
        <section class="post-related" aria-labelledby="related-heading">
            <div class="jn-wrap">
                <div class="jn-related__head">
                    <h2 id="related-heading">Continue reading</h2>
                    <a href="{{ route('pages.blog.list') }}">All articles</a>
                </div>
                <div class="jn-grid">
                    @foreach ($dataList as $data)
                        <x-site.blocks.blog-item :data="$data" :lang="$lang" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</x-layouts.site>
