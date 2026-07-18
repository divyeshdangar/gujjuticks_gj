<x-layouts.site :metaData="$metaData" page="news">

    @php
        $hasImage = !empty($dataDetail->image)
            && file_exists(public_path('images/news/' . $dataDetail->image));

        $storyCards = $dataListNews->take(6)->map(function ($story) {
            $excerpt = \Illuminate\Support\Str::limit(strip_tags($story->content ?? ''), 78);
            return [
                'title' => \Illuminate\Support\Str::limit(strip_tags($story->title ?? ''), 72),
                'place' => $story->location ?: null,
                'excerpt' => $excerpt ?: null,
            ];
        })->filter(fn ($card) => filled($card['title']))->values();

        if ($storyCards->isEmpty()) {
            $storyCards = collect([
                [
                    'title' => 'Desk brief updating…',
                    'place' => $dataDetail->name,
                    'excerpt' => 'Fresh notes are lining up for this category desk.',
                ],
                [
                    'title' => 'Topic notes lined up',
                    'place' => 'Gujarat desk',
                    'excerpt' => 'Editors are sorting local briefs into the queue.',
                ],
                [
                    'title' => 'Next headline queued',
                    'place' => 'Live wire',
                    'excerpt' => 'Placeholder copy holds the reel until stories arrive.',
                ],
                [
                    'title' => 'Category feed ready',
                    'place' => $dataDetail->name,
                    'excerpt' => 'Watch the prompter while new reports come in.',
                ],
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

                <div class="nw-detail-hero__visual" aria-hidden="true" data-nw-prompter>
                    <div class="nw-prompter">
                        <div class="nw-prompter__chrome">
                            <span class="nw-prompter__pill">
                                <span class="nw-prompter__pill-dot"></span>
                                On air
                            </span>
                            <span class="nw-prompter__desk">{{ $dataDetail->name }}</span>
                            <span class="nw-prompter__clock" data-nw-prompter-clock>—</span>
                        </div>

                        <div class="nw-prompter__viewport">
                            <div class="nw-prompter__fade nw-prompter__fade--top"></div>
                            <div class="nw-prompter__fade nw-prompter__fade--bottom"></div>
                            <div class="nw-prompter__focus"></div>
                            <div class="nw-prompter__beam"></div>
                            <div class="nw-prompter__track" data-nw-prompter-track>
                                @foreach ($storyCards as $i => $card)
                                    <article class="nw-prompter__item{{ $i === 0 ? ' is-active' : '' }}"
                                        style="--i: {{ $i }}" data-nw-prompter-item>
                                        <span class="nw-prompter__idx">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                        <div class="nw-prompter__body">
                                            <p class="nw-prompter__title">{{ $card['title'] }}</p>
                                            @if (!empty($card['excerpt']))
                                                <p class="nw-prompter__excerpt">{{ $card['excerpt'] }}</p>
                                            @else
                                                <div class="nw-prompter__ph">
                                                    <span></span><span></span>
                                                </div>
                                            @endif
                                            <p class="nw-prompter__place">
                                                {{ $card['place'] ?: ($dataDetail->name . ' desk') }}
                                            </p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>

                        <div class="nw-prompter__footer">
                            <div class="nw-prompter__bar" aria-hidden="true">
                                <span class="nw-prompter__bar-fill" data-nw-prompter-bar></span>
                            </div>
                            <p class="nw-prompter__status" data-nw-prompter-status>
                                Reading 01 / {{ str_pad((string) max(1, $storyCards->count()), 2, '0', STR_PAD_LEFT) }}
                            </p>
                        </div>
                    </div>
                    <p class="nw-hero__label">Desk prompter</p>
                </div>
            </div>
        </header>

        @if ($hasImage || $dataDetail->description)
            <section class="nw-section nw-section--tight" aria-labelledby="nw-overview-heading">
                <div class="nw-wrap nw-overview nw-reveal">
                    @if ($hasImage)
                        <figure class="nw-overview__media">
                            <img src="{{ URL::asset('/images/news/' . $dataDetail->image) }}"
                                alt="{{ $dataDetail->name }}" width="960" height="540" loading="eager" decoding="async">
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
                                    <img src="{{ $thumb }}" alt="{{ strip_tags($data->title) }}" width="320" height="200" loading="lazy"
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
