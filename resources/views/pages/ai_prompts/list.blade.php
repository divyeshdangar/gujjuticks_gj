<x-layouts.site :metaData="$metaData" page="ai-prompts">

    @php
        $searchTerm = $searchTerm ?? request('search');
        $promptCount = (int) ($stats['prompts'] ?? $dataList->total());
        $categoryCount = (int) ($stats['categories'] ?? $categories->count());
        $tickerCats = $categories->take(8)->pluck('name')->all();
        if (count($tickerCats) < 4) {
            $tickerCats = array_merge($tickerCats, ['Writing', 'Coding', 'Marketing', 'Image', 'Video', 'Automation']);
            $tickerCats = array_values(array_unique($tickerCats));
        }
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

    <section class="ap-hero" aria-label="AI prompts library">
        <div class="ap-hero__stage">
            <canvas class="ap-hero__neural" data-ap-neural width="1" height="1" aria-hidden="true"></canvas>
            <div class="ap-hero__rings" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="ap-hero__copy">
                <p class="ap-live">
                    <span class="ap-live__dot" aria-hidden="true"></span>
                    Ready-to-use prompts by category
                </p>
                <p class="ap-hero__signal" aria-hidden="true">AI</p>
                <h1 class="ap-hero__title">
                    Predefined prompts that help you
                    <span class="ap-hero__typed" data-type-rotate>finish tasks faster</span><span class="ap-hero__caret"
                        aria-hidden="true"></span>
                </h1>
                <p class="ap-hero__lead">
                    A library of AI prompts organised by category — writing, coding, marketing, and more.
                    Pick one, open it, and reuse a proven prompt instead of starting from scratch.
                </p>
                <div class="ap-hero__actions">
                    <a class="ap-btn ap-btn--solid" href="#prompts-list">Browse prompts</a>
                    <a class="ap-btn ap-btn--ghost" href="#ap-categories">Browse by category</a>
                </div>
                <ol class="ap-hero__steps" aria-label="How to use this library">
                    <li><span>01</span> Choose a category</li>
                    <li><span>02</span> Open a prompt</li>
                    <li><span>03</span> Copy &amp; get the task done</li>
                </ol>
            </div>
        </div>
    </section>

    <div class="ap-ticker" aria-hidden="true">
        <div class="ap-ticker__track">
            @foreach ([1, 2] as $loopCopy)
                @foreach ($tickerCats as $catName)
                    <span>{{ $catName }}</span>
                @endforeach
            @endforeach
        </div>
    </div>

    <section class="ap-section" id="prompts-list" aria-label="Prompts">
        <div class="ap-wrap">
            <div class="ap-bar ap-reveal">
                <div>
                    <h2 class="ap-bar__title">
                        @if ($searchTerm)
                            Results for “{{ $searchTerm }}”
                        @else
                            Prompt library
                        @endif
                    </h2>
                    <p class="ap-bar__lead">
                        <span data-count="{{ $promptCount }}">{{ number_format($promptCount) }}</span> ready-made prompts across
                        <span data-count="{{ $categoryCount }}">{{ number_format($categoryCount) }}</span> categories —
                        open one to copy and use in your AI tool.
                    </p>
                </div>
                <div class="ap-bar__actions">
                    <form class="ap-search" method="get" action="{{ route('pages.ai_prompts.list') }}" role="search">
                        <label class="visually-hidden" for="ap-search">Search prompts</label>
                        <input id="ap-search" type="search" name="search" value="{{ $searchTerm }}"
                            placeholder="Search prompts or tasks…" autocomplete="off">
                        <button type="submit">Go</button>
                    </form>
                    @if ($searchTerm)
                        <a class="ap-clear" href="{{ route('pages.ai_prompts.list') }}">Clear</a>
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
                                            @if ($item->category)
                                                <a class="ap-chip"
                                                    href="{{ route('pages.ai_prompts.category', ['slug' => $item->category->slug]) }}">
                                                    {{ $item->category->name }}
                                                </a>
                                            @endif
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
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        {{ $dataList->links('vendor.pagination.site') }}
                    @else
                        <div class="ap-empty" role="status">
                            @if ($searchTerm)
                                No prompts matched “{{ $searchTerm }}”.
                                <a href="{{ route('pages.ai_prompts.list') }}">Clear search</a>
                            @else
                                Prompts will appear here soon.
                            @endif
                        </div>
                    @endif
                </div>

                <aside class="ap-side ap-reveal" id="ap-categories" aria-label="Categories">
                    <h2 class="ap-side__title">Browse by category</h2>
                    <p class="ap-side__lead">Find prompts for the kind of work you need to get done.</p>
                    <nav class="ap-side__nav">
                        <a class="ap-side__link is-active" href="{{ route('pages.ai_prompts.list') }}">All prompts</a>
                        @foreach ($categories as $cat)
                            <a class="ap-side__link"
                                href="{{ route('pages.ai_prompts.category', ['slug' => $cat->slug]) }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </nav>
                </aside>
            </div>
        </div>
    </section>

    <section class="ap-section ap-section--alt" aria-labelledby="ap-about-heading">
        <div class="ap-wrap">
            <div class="ap-section__head ap-reveal">
                <h2 id="ap-about-heading">Why use predefined prompts?</h2>
                <p>Better results with less trial and error — organised so you can find the right one quickly.</p>
            </div>
            <div class="ap-about ap-reveal">
                <p>
                    Each prompt is written for a real task: drafts, ideas, code help, marketing copy, images, and more.
                    Instead of inventing the wording every time, open a category, pick a prompt, and adapt it to your brief.
                </p>
                <p>
                    Search the library or browse categories, then open a prompt to view the full text and copy it into
                    ChatGPT, Claude, Gemini, or any tool you already use.
                </p>
            </div>
        </div>
    </section>

</x-layouts.site>
