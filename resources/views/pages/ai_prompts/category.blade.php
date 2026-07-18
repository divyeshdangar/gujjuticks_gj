<x-layouts.site :metaData="$metaData" page="ai-prompts">

    @php
        $searchTerm = request('search');
        $promptTotal = $dataList->total();
        $lead = $category->meta_description
            ?: $category->description
            ?: 'Ready-made ' . \Illuminate\Support\Str::lower($category->name) . ' prompts you can open, copy, and reuse to finish tasks faster.';
        $hasCategoryImage = !empty($category->image);
        $categoryImage = $hasCategoryImage
            ? asset('images/ai-prompt-categories/' . $category->image)
            : null;
    @endphp

    <div class="ap-ambient" aria-hidden="true">
        <div class="ap-ambient__grid"></div>
        <div class="ap-ambient__blob ap-ambient__blob--a"></div>
        <div class="ap-ambient__blob ap-ambient__blob--b"></div>
        <div class="ap-ambient__blob ap-ambient__blob--c"></div>
        <div class="ap-ambient__glow" data-ambient-glow></div>
        <canvas class="ap-ambient__canvas" data-ambient-canvas width="1" height="1"></canvas>
    </div>
    <div class="ap-progress" data-scroll-progress aria-hidden="true"></div>

    <header class="ap-detail__hero ap-cat-hero">
        <div class="ap-wrap ap-detail__hero-grid">
            <div class="ap-detail__copy">
                <nav class="ap-crumb" aria-label="Breadcrumb">
                    <a href="{{ route('pages.ai_prompts.list') }}">AI prompts</a>
                    <span class="ap-crumb__sep" aria-hidden="true">/</span>
                    <span aria-current="page">{{ $category->name }}</span>
                </nav>

                <p class="ap-live">
                    <span class="ap-live__dot" aria-hidden="true"></span>
                    Category library
                </p>

                <h1 class="ap-detail__title">{{ $category->name }} prompts</h1>

                <p class="ap-detail__deck">{{ $lead }}</p>

                <div class="ap-detail__meta">
                    <span data-count="{{ $promptTotal }}">{{ number_format($promptTotal) }}</span> ready-made prompts
                    <span class="ap-detail__sep" aria-hidden="true">·</span>
                    Pick one · Copy · Get the task done
                </div>

                <div class="ap-detail__actions">
                    <a class="ap-btn ap-btn--solid" href="#prompts-list">Browse prompts</a>
                    <a class="ap-btn ap-btn--ghost" href="{{ route('pages.ai_prompts.list') }}">All categories</a>
                </div>
            </div>

            @if ($hasCategoryImage)
                <div class="ap-cat-media">
                    <img src="{{ $categoryImage }}" alt="{{ $category->name }}" width="1200" height="900"
                        loading="eager" decoding="async">
                    <div class="ap-cat-media__scan" aria-hidden="true"></div>
                </div>
            @else
                <div class="ap-detail__visual" aria-hidden="true">
                    <canvas class="ap-detail__ai-canvas" data-ap-ai width="1" height="1"></canvas>
                    <div class="ap-detail__ai-orb ap-detail__ai-orb--a"></div>
                    <div class="ap-detail__ai-orb ap-detail__ai-orb--b"></div>
                    <div class="ap-detail__ai-core">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            @endif
        </div>
    </header>

    <section class="ap-section" id="prompts-list" aria-label="{{ $category->name }} prompts">
        <div class="ap-wrap">
            <div class="ap-bar ap-reveal">
                <div>
                    <h2 class="ap-bar__title">
                        @if ($searchTerm)
                            Results for “{{ $searchTerm }}”
                        @else
                            {{ $category->name }} library
                        @endif
                    </h2>
                    <p class="ap-bar__lead">
                        Predefined prompts in this category — open one to copy into your AI tool.
                    </p>
                </div>
                <div class="ap-bar__actions">
                    <form class="ap-search" method="get"
                        action="{{ route('pages.ai_prompts.category', ['slug' => $category->slug]) }}" role="search">
                        <label class="visually-hidden" for="ap-cat-search">Search in {{ $category->name }}</label>
                        <input id="ap-cat-search" type="search" name="search" value="{{ $searchTerm }}"
                            placeholder="Search this category…" autocomplete="off">
                        <button type="submit">Go</button>
                    </form>
                    @if ($searchTerm)
                        <a class="ap-clear"
                            href="{{ route('pages.ai_prompts.category', ['slug' => $category->slug]) }}">Clear</a>
                    @endif
                </div>
            </div>

            <div class="ap-layout">
                <div class="ap-main">
                    @if ($dataList->count() > 0)
                        <div class="ap-list">
                            @foreach ($dataList as $item)
                                @php
                                    $excerpt = \Illuminate\Support\Str::limit($item->meta_description ?: '', 140);
                                    $promptPeek = \Illuminate\Support\Str::limit($item->prompt, 140);
                                    $href = route('pages.ai_prompts.detail', ['slug' => $item->slug]);
                                @endphp
                                <article class="ap-card ap-reveal">
                                    @if ($item->image)
                                        <a href="{{ $href }}" class="ap-card__media">
                                            <img src="{{ asset('images/ai-prompts/' . $item->image) }}" alt="{{ $item->title }}"
                                                width="640" height="360" loading="lazy" decoding="async">
                                        </a>
                                    @endif
                                    <div class="ap-card__body">
                                        <div class="ap-card__meta">
                                            <span class="ap-chip">{{ $category->name }}</span>
                                            <span class="ap-card__copies">{{ number_format($item->copy_count) }} copies</span>
                                        </div>
                                        <h3 class="ap-card__title">
                                            <a href="{{ $href }}">{{ $item->title }}</a>
                                        </h3>
                                        @if ($excerpt)
                                            <p class="ap-card__summary">{{ $excerpt }}</p>
                                        @endif
                                        <p class="ap-card__prompt">{{ $promptPeek }}</p>
                                        <div class="ap-card__actions">
                                            <a class="ap-btn ap-btn--solid ap-btn--sm" href="{{ $href }}">Open prompt</a>
                                            <button type="button"
                                                class="ap-btn ap-btn--ghost ap-btn--sm copy-prompt-btn"
                                                data-prompt="{{ e($item->prompt) }}"
                                                data-copy-url="{{ route('pages.ai_prompts.copy', ['uniqueId' => $item->unique_id]) }}">
                                                Copy prompt
                                            </button>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        {{ $dataList->links('vendor.pagination.site') }}
                    @else
                        <div class="ap-empty" role="status">
                            @if ($searchTerm)
                                No prompts matched “{{ $searchTerm }}” in {{ $category->name }}.
                                <a href="{{ route('pages.ai_prompts.category', ['slug' => $category->slug]) }}">Clear search</a>
                            @else
                                Prompts for this category will appear here soon.
                            @endif
                        </div>
                    @endif
                </div>

                <aside class="ap-side ap-reveal" id="ap-categories" aria-label="Categories">
                    <h2 class="ap-side__title">Browse by category</h2>
                    <p class="ap-side__lead">Switch categories to find prompts for a different kind of task.</p>
                    <nav class="ap-side__nav">
                        <a class="ap-side__link" href="{{ route('pages.ai_prompts.list') }}">All prompts</a>
                        @foreach ($categories as $cat)
                            <a class="ap-side__link {{ $category->id === $cat->id ? 'is-active' : '' }}"
                                href="{{ route('pages.ai_prompts.category', ['slug' => $cat->slug]) }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </nav>
                </aside>
            </div>
        </div>
    </section>

    <div id="ai-prompts-csrf" data-csrf="{{ csrf_token() }}" hidden></div>

</x-layouts.site>
