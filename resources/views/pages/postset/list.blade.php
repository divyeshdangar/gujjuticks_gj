<x-layouts.site :metaData="$metaData" page="news-post">

    @php
        $searchTerm = request('search');
        $setCount = (int) ($setCount ?? $dataList->total());
        $wireLines = [
            'Morning brief ready for review',
            'Carousel pack · 9 slides queued',
            'Letter set · caption + hashtags',
            'Topic wire · knowledge share',
            'Headline stack refreshing',
            'Share-ready news update',
            'Visual story · audience note',
            'Desk clear · next topic lined up',
        ];
    @endphp

    <div class="np-ambient" aria-hidden="true">
        <div class="np-ambient__grid"></div>
        <div class="np-ambient__blob np-ambient__blob--a"></div>
        <div class="np-ambient__blob np-ambient__blob--b"></div>
        <div class="np-ambient__blob np-ambient__blob--c"></div>
        <div class="np-ambient__glow" data-ambient-glow></div>
        <canvas class="np-ambient__canvas" data-ambient-canvas width="1" height="1"></canvas>
    </div>
    <div class="np-progress" data-scroll-progress aria-hidden="true"></div>

    <section class="np-hero">
        <div class="np-wrap np-hero__grid">
            <div class="np-hero__copy">
                <p class="np-live">
                    <span class="np-live__dot" aria-hidden="true"></span>
                    Live wire · News &amp; letter sets
                </p>
                <p class="np-hero__signal">News</p>
                <h1 class="np-hero__title">
                    Topic post sets you can open, adapt, and share —
                    <span class="np-hero__typed" data-type-rotate>as a news brief</span><span class="np-hero__caret"
                        aria-hidden="true"></span>
                </h1>
                <p class="np-hero__lead">
                    A library of ready-made carousel sets for news updates and letter-style storytelling.
                    Pick a topic, preview the slides, personalize, then publish.
                </p>
                <div class="np-hero__actions">
                    <a class="np-btn np-btn--solid" href="#post-sets">Browse sets</a>
                    @if (auth()->user() && auth()->user()->is_admin())
                        <button type="button" class="np-btn np-btn--ghost" data-np-open-build>Start building</button>
                    @endif
                </div>
                <p class="np-hero__meta">
                    <span data-local-time>—</span>
                    <span class="np-hero__sep">·</span>
                    <strong data-count="{{ $setCount }}">{{ number_format($setCount) }}</strong> sets on the wire
                </p>
            </div>

            <div class="np-hero__visual" aria-hidden="true">
                <canvas class="np-hero__canvas" data-np-visual width="1" height="1"></canvas>
                <div class="np-hero__wire">
                    <div class="np-hero__wire-track">
                        @foreach ([1, 2] as $copy)
                            @foreach ($wireLines as $line)
                                <p><span>WIRE</span>{{ $line }}</p>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="np-hero__pulse"></div>
            </div>
        </div>
    </section>

    <div class="np-marquee" aria-hidden="true">
        <div class="np-marquee__track">
            @foreach ([1, 2] as $copy)
                <span>News briefs</span>
                <span>Letter sets</span>
                <span>Topic carousels</span>
                <span>Caption packs</span>
                <span>Shareable updates</span>
                <span>Knowledge posts</span>
            @endforeach
        </div>
    </div>

    <section class="np-section" id="post-sets" aria-label="Post sets">
        <div class="np-wrap">
            <div class="np-bar np-reveal">
                <div>
                    <h2 class="np-bar__title">
                        @if ($searchTerm)
                            Results for “{{ $searchTerm }}”
                        @else
                            On the wire
                        @endif
                    </h2>
                    <p class="np-bar__lead">Open a set to preview slides, then personalize for your audience.</p>
                </div>
                <form class="np-search" method="get" action="{{ route('pages.postset.list') }}" role="search">
                    <label class="visually-hidden" for="np-search">Search post sets</label>
                    <input id="np-search" type="search" name="search" value="{{ $searchTerm }}"
                        placeholder="Search topics…" autocomplete="off">
                    <button type="submit">Go</button>
                </form>
            </div>

            @if ($dataList->count() > 0)
                <div class="np-list">
                    @foreach ($dataList as $i => $data)
                        <a href="{{ route('pages.postset.post.generator', ['slug' => $data->slug]) }}"
                            class="np-row np-reveal" style="--i: {{ $i % 8 }}">
                            <span class="np-row__index">{{ str_pad((string) ($dataList->firstItem() + $i), 2, '0', STR_PAD_LEFT) }}</span>
                            <figure class="np-row__media">
                                <img loading="lazy" decoding="async"
                                    src="{{ route('pages.image.postmain', ['slug' => $data->slug . '.jpg']) }}"
                                    alt="" width="320" height="320">
                            </figure>
                            <div class="np-row__copy">
                                @if ($data->topic)
                                    <span class="np-row__topic">{{ $data->topic }}</span>
                                @endif
                                <h3 class="np-row__title">{{ $data->title }}</h3>
                                @if ($data->meta_description)
                                    <p class="np-row__summary">{{ \Illuminate\Support\Str::limit($data->meta_description, 120) }}</p>
                                @endif
                            </div>
                            <div class="np-row__meta">
                                @if (($data->posts_count ?? 0) > 0)
                                    <span>{{ $data->posts_count }} slides</span>
                                @endif
                                <span class="np-row__go">Open</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{ $dataList->links('vendor.pagination.site') }}
            @else
                <div class="np-empty" role="status">
                    @if ($searchTerm)
                        No post sets matched “{{ $searchTerm }}”.
                    @else
                        New sets will appear on the wire soon.
                    @endif
                </div>
            @endif
        </div>
    </section>

    @if (auth()->user() && auth()->user()->is_admin())
        <dialog class="np-dialog" data-np-dialog>
            <form method="post" action="{{ route('pages.postset.post') }}" class="np-dialog__panel">
                @csrf
                <div class="np-dialog__head">
                    <h2>Start adding a post set</h2>
                    <button type="button" class="np-dialog__close" data-np-close-build aria-label="Close">&times;</button>
                </div>
                <div class="np-dialog__body">
                    @if ($errors->any())
                        <div class="np-dialog__errors">
                            <strong>{{ __('dashboard.error') }}:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p>Paste the associative array output to create a new topic-based post set.</p>
                    <label for="prompt">Prompt</label>
                    <textarea name="prompt" id="prompt" rows="4">{{ old('prompt', $prompt) }}</textarea>
                    @error('prompt')
                        <p class="np-form-error">{{ $message }}</p>
                    @enderror
                    <label for="data">Data</label>
                    <textarea name="data" id="data" rows="10">{{ old('data') }}</textarea>
                    @error('data')
                        <p class="np-form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="np-dialog__foot">
                    <button type="button" class="np-btn np-btn--ghost" data-np-close-build>Close</button>
                    <button type="submit" class="np-btn np-btn--solid">Start process</button>
                </div>
            </form>
        </dialog>
        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var d = document.querySelector('[data-np-dialog]');
                    if (d && d.showModal) d.showModal();
                });
            </script>
        @endif
    @endif

</x-layouts.site>
