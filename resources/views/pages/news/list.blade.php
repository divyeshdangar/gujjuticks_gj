<x-layouts.site :metaData="$metaData" page="news">

    @php
        $categoryCount = (int) ($stats['categories'] ?? $categories->count());
        $topicCount = (int) ($stats['topics'] ?? 0);
        $storyCount = (int) ($stats['stories'] ?? 0);
        $wireLines = $tickerLines ?? [
            'Morning brief · Gujarat desk',
            'India headlines refreshing',
            'Local notes · city updates',
            'Category wire · topic stack',
            'Breaking queue cleared',
            'Evening wrap preparing',
        ];
    @endphp

    <div class="nw-hub" data-nw-hub>
        <div class="nw-ambient" aria-hidden="true">
            <div class="nw-ambient__grid"></div>
            <div class="nw-ambient__blob nw-ambient__blob--a"></div>
            <div class="nw-ambient__blob nw-ambient__blob--b"></div>
            <div class="nw-ambient__glow" data-nw-glow></div>
            <canvas class="nw-ambient__canvas" data-nw-particles width="1" height="1"></canvas>
        </div>
        <div class="nw-progress" data-nw-progress aria-hidden="true"></div>

        <section class="nw-hero" aria-label="News">
            <div class="nw-wrap nw-hero__grid">
                <div class="nw-hero__copy">
                    <p class="nw-live">
                        <span class="nw-live__dot" aria-hidden="true"></span>
                        Live desk · Gujarat &amp; India
                    </p>
                    <p class="nw-hero__brand">GujjuTicks</p>
                    <h1 class="nw-hero__title">
                        News by category —
                        <span class="nw-hero__typed" data-nw-type>Gujarat updates</span><span class="nw-hero__caret"
                            aria-hidden="true"></span>
                    </h1>
                    <p class="nw-hero__lead">
                        Browse curated news topics from Gujarat and across India. Open a category for the latest
                        headlines, then dig into the stories that matter.
                    </p>
                    <div class="nw-hero__actions">
                        <a class="nw-btn nw-btn--solid" href="#news-categories">Browse categories</a>
                        <a class="nw-btn nw-btn--ghost" href="#how-news">How it works</a>
                    </div>
                    <p class="nw-hero__meta">
                        <span data-nw-time>—</span>
                        <span class="nw-hero__sep">·</span>
                        <strong data-nw-count="{{ $categoryCount }}">{{ number_format($categoryCount) }}</strong> categories
                    </p>
                </div>

                <div class="nw-hero__visual" aria-hidden="true">
                    <canvas class="nw-hero__canvas" data-nw-visual width="1" height="1"></canvas>
                    <div class="nw-hero__wire">
                        <div class="nw-hero__wire-track">
                            @foreach ([1, 2] as $copy)
                                @foreach ($wireLines as $line)
                                    <p><span>LIVE</span>{{ $line }}</p>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="nw-hero__pulse"></div>
                    <p class="nw-hero__label">Headline feed</p>
                </div>
            </div>
        </section>

        <section class="nw-strip" aria-label="News snapshot">
            <div class="nw-wrap nw-strip__grid">
                <div class="nw-strip__item nw-reveal">
                    <p class="nw-strip__value" data-nw-count="{{ $categoryCount }}">{{ number_format($categoryCount) }}</p>
                    <p class="nw-strip__label">Top categories</p>
                </div>
                <div class="nw-strip__item nw-reveal" style="--i: 1">
                    <p class="nw-strip__value" data-nw-count="{{ $topicCount }}">{{ number_format($topicCount) }}</p>
                    <p class="nw-strip__label">Topic desks</p>
                </div>
                <div class="nw-strip__item nw-reveal" style="--i: 2">
                    <p class="nw-strip__value" data-nw-count="{{ $storyCount }}">{{ number_format($storyCount) }}</p>
                    <p class="nw-strip__label">Stories filed</p>
                </div>
            </div>
        </section>

        <div class="nw-marquee" aria-hidden="true">
            <div class="nw-marquee__track">
                @foreach ([1, 2] as $copy)
                    <span>Gujarat news</span>
                    <span>India headlines</span>
                    <span>Local updates</span>
                    <span>Breaking notes</span>
                    <span>Category desks</span>
                    <span>Daily briefs</span>
                @endforeach
            </div>
        </div>

        <section class="nw-section" id="news-categories" aria-labelledby="nw-cats-heading">
            <div class="nw-wrap">
                <div class="nw-bar nw-reveal">
                    <div>
                        <h2 class="nw-bar__title" id="nw-cats-heading">News categories</h2>
                        <p class="nw-bar__lead">Pick a desk to open topic pages and recent stories.</p>
                    </div>
                </div>

                @if ($categories->count() > 0)
                    <div class="nw-list">
                        @foreach ($categories as $i => $category)
                            <a href="{{ route('pages.news.detail', ['slug' => $category->slug]) }}"
                                class="nw-row nw-reveal" style="--i: {{ $i % 8 }}">
                                <span class="nw-row__index">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="nw-row__copy">
                                    <h3 class="nw-row__title">News on {{ $category->name }}</h3>
                                    @if ($category->meta_description)
                                        <p class="nw-row__summary">{{ \Illuminate\Support\Str::limit($category->meta_description, 110) }}</p>
                                    @else
                                        <p class="nw-row__summary">Open this category for topic desks and latest stories.</p>
                                    @endif
                                </div>
                                <div class="nw-row__meta">
                                    @if (($category->children_count ?? 0) > 0)
                                        <span>{{ $category->children_count }} topics</span>
                                    @endif
                                    <span class="nw-row__go">Open</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="nw-empty" role="status">News categories will appear here soon.</div>
                @endif
            </div>
        </section>

        <section class="nw-section nw-section--alt" id="how-news" aria-labelledby="nw-how-heading">
            <div class="nw-wrap">
                <div class="nw-bar nw-reveal">
                    <div>
                        <h2 class="nw-bar__title" id="nw-how-heading">How to use this desk</h2>
                        <p class="nw-bar__lead">A short path from category to story.</p>
                    </div>
                </div>
                <ol class="nw-steps">
                    <li class="nw-steps__item nw-reveal">
                        <span class="nw-steps__num">01</span>
                        <h3>Choose a category</h3>
                        <p>Start with Gujarat, India, or another top-level desk from the list above.</p>
                    </li>
                    <li class="nw-steps__item nw-reveal" style="--i: 1">
                        <span class="nw-steps__num">02</span>
                        <h3>Open a topic</h3>
                        <p>Drill into sub-topics when available to narrow the feed to what you need.</p>
                    </li>
                    <li class="nw-steps__item nw-reveal" style="--i: 2">
                        <span class="nw-steps__num">03</span>
                        <h3>Read the latest</h3>
                        <p>Scan recent stories, open a headline, and stay current without the noise.</p>
                    </li>
                </ol>
            </div>
        </section>

        <section class="nw-section" aria-labelledby="nw-about-heading">
            <div class="nw-wrap nw-about nw-reveal">
                <div>
                    <h2 class="nw-bar__title" id="nw-about-heading">What you’ll find here</h2>
                    <p class="nw-about__lead">
                        GujjuTicks News organizes headlines into clear categories so you can move from a statewide
                        overview to a specific topic without hunting through a single long feed.
                    </p>
                </div>
                <ul class="nw-about__list">
                    <li>Category desks for Gujarat and India coverage</li>
                    <li>Topic pages with recent story lists</li>
                    <li>Short descriptions to help you pick the right desk</li>
                </ul>
            </div>
        </section>
    </div>

</x-layouts.site>
