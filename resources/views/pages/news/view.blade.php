<x-layouts.site :metaData="$metaData" page="news">

    @php
        $hasImage = !empty($dataDetail->image)
            && file_exists(public_path('images/news/' . $dataDetail->image));
        $storyTitles = $dataListNews->pluck('title')->filter()->take(6)->values();
        if ($storyTitles->isEmpty()) {
            $storyTitles = collect([
                'Desk brief updating…',
                'Topic notes lined up',
                'Next headline queued',
                'Category feed ready',
            ]);
        }
    @endphp

    <div class="nw-hub" data-nw-hub data-nw-detail>
        <div class="nw-ambient" aria-hidden="true">
            <div class="nw-ambient__grid"></div>
            <div class="nw-ambient__blob nw-ambient__blob--a"></div>
            <div class="nw-ambient__blob nw-ambient__blob--b"></div>
            <div class="nw-ambient__glow" data-nw-glow></div>
            <canvas class="nw-ambient__canvas" data-nw-particles width="1" height="1"></canvas>
        </div>
        <div class="nw-progress" data-nw-progress aria-hidden="true"></div>

        <header class="nw-detail-hero">
            <div class="nw-wrap nw-detail-hero__grid">
                <div class="nw-detail-hero__copy">
                    <nav class="nw-crumb" aria-label="Breadcrumb">
                        <a href="{{ route('pages.news.list') }}">News</a>
                        <span class="nw-crumb__sep" aria-hidden="true">/</span>
                        <span aria-current="page">{{ $dataDetail->name }}</span>
                    </nav>

                    <p class="nw-live">
                        <span class="nw-live__dot" aria-hidden="true"></span>
                        Category desk · Live updates
                    </p>

                    <h1 class="nw-detail-hero__title">News on {{ $dataDetail->name }}</h1>

                    @if ($dataDetail->meta_description)
                        <p class="nw-detail-hero__lead">{{ $dataDetail->meta_description }}</p>
                    @endif

                    <div class="nw-detail-hero__meta">
                        <span>{{ $dataListNews->total() }} stories</span>
                        @if ($dataList->count() > 0)
                            <span class="nw-hero__sep" aria-hidden="true">·</span>
                            <span>{{ $dataList->count() }} topics</span>
                        @endif
                    </div>

                    <div class="nw-hero__actions">
                        <a class="nw-btn nw-btn--solid" href="#stories">Browse stories</a>
                        <a class="nw-btn nw-btn--ghost" href="{{ route('pages.news.list') }}">All categories</a>
                    </div>
                </div>

                <div class="nw-detail-hero__visual" aria-hidden="true" data-nw-stage>
                    <div class="nw-stage">
                        <div class="nw-stage__rings">
                            <span class="nw-stack__orbit nw-stack__orbit--a"></span>
                            <span class="nw-stack__orbit nw-stack__orbit--b"></span>
                            <span class="nw-stack__orbit nw-stack__orbit--c"></span>
                            <span class="nw-stage__arm nw-stage__arm--a"><span class="nw-stage__dot"></span></span>
                            <span class="nw-stage__arm nw-stage__arm--b"><span class="nw-stage__dot nw-stage__dot--dark"></span></span>
                            <span class="nw-stage__arm nw-stage__arm--c"><span class="nw-stage__dot nw-stage__dot--soft"></span></span>
                        </div>

                        <div class="nw-stack" data-nw-stack>
                            @foreach ($storyTitles as $i => $title)
                                <article class="nw-stack__card" style="--i: {{ $i }}" data-nw-card>
                                    <div class="nw-stack__card-top">
                                        <p class="nw-stack__label">Headline {{ $i + 1 }}</p>
                                        <span class="nw-stack__badge">Live</span>
                                    </div>
                                    <p class="nw-stack__title">{{ \Illuminate\Support\Str::limit(strip_tags($title), 72) }}</p>
                                    <div class="nw-stack__meter" data-nw-meter>
                                        <span class="nw-stack__meter-fill"></span>
                                    </div>
                                    <span class="nw-stack__scan"></span>
                                </article>
                            @endforeach
                        </div>

                        <div class="nw-stage__rail">
                            <div class="nw-stage__pips" data-nw-pips>
                                @foreach ($storyTitles as $i => $title)
                                    <span class="nw-stage__pip{{ $i === 0 ? ' is-on' : '' }}"></span>
                                @endforeach
                            </div>
                            <p class="nw-stage__status" data-nw-status>Queue 01 / {{ str_pad((string) max(1, $storyTitles->count()), 2, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                    <p class="nw-hero__label">Story reel</p>
                </div>
            </div>
        </header>

        @if ($hasImage || $dataDetail->description)
            <section class="nw-section nw-section--tight" aria-labelledby="nw-overview-heading">
                <div class="nw-wrap nw-overview nw-reveal">
                    @if ($hasImage)
                        <figure class="nw-overview__media">
                            <img src="{{ URL::asset('/images/news/' . $dataDetail->image) }}"
                                alt="" width="960" height="540" loading="eager" decoding="async">
                        </figure>
                    @endif
                    <div class="nw-overview__copy">
                        <h2 id="nw-overview-heading" class="nw-bar__title">About this desk</h2>
                        @if ($dataDetail->description)
                            <div class="nw-overview__body">{!! $dataDetail->description !!}</div>
                        @else
                            <p class="nw-overview__body">
                                Browse topics and recent stories filed under {{ $dataDetail->name }}.
                            </p>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @if ($dataList->count() > 0)
            <section class="nw-section nw-section--alt" aria-labelledby="nw-topics-heading">
                <div class="nw-wrap">
                    <div class="nw-bar nw-reveal">
                        <div>
                            <h2 class="nw-bar__title" id="nw-topics-heading">Topics in {{ $dataDetail->name }}</h2>
                            <p class="nw-bar__lead">Narrow the feed to a specific desk.</p>
                        </div>
                    </div>
                    <div class="nw-topics">
                        @foreach ($dataList as $i => $topic)
                            <a href="{{ route('pages.news.detail', ['slug' => $topic->slug]) }}"
                                class="nw-topic nw-reveal" style="--i: {{ $i % 8 }}">
                                {{ $topic->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="nw-section" id="stories" aria-labelledby="nw-stories-heading">
            <div class="nw-wrap">
                <div class="nw-bar nw-reveal">
                    <div>
                        <h2 class="nw-bar__title" id="nw-stories-heading">Latest stories</h2>
                        <p class="nw-bar__lead">
                            @if ($dataListNews->total() > 0)
                                {{ number_format($dataListNews->total()) }} stories in this desk.
                            @else
                                New stories will appear here as they are filed.
                            @endif
                        </p>
                    </div>
                </div>

                @if ($dataListNews->count() > 0)
                    <div class="nw-stories">
                        @foreach ($dataListNews as $i => $data)
                            @php
                                $initials = \App\Helpers\CommonHelper::getInitials($data->title);
                                $thumb = route('pages.image.cool', [
                                    'slug' => 'characters-' . $initials . '.jpg',
                                ]);
                                $excerpt = \Illuminate\Support\Str::limit(strip_tags($data->content ?? ''), 140);
                                $href = !empty($data->link) ? $data->link : null;
                            @endphp
                            <article class="nw-story nw-reveal" style="--i: {{ $i % 9 }}">
                                <figure class="nw-story__media">
                                    <img src="{{ $thumb }}" alt="" width="320" height="200" loading="lazy"
                                        decoding="async">
                                </figure>
                                <div class="nw-story__body">
                                    <h3 class="nw-story__title">
                                        @if ($href)
                                            <a href="{{ $href }}" rel="noopener noreferrer" target="_blank">
                                                {!! $data->title !!}
                                            </a>
                                        @else
                                            {!! $data->title !!}
                                        @endif
                                    </h3>
                                    @if ($excerpt)
                                        <p class="nw-story__excerpt">{{ $excerpt }}</p>
                                    @endif
                                    @if ($data->location)
                                        <p class="nw-story__place">{{ $data->location }}</p>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{ $dataListNews->links('vendor.pagination.site') }}
                @else
                    <div class="nw-empty" role="status">No stories in this category yet.</div>
                @endif
            </div>
        </section>
    </div>

</x-layouts.site>
