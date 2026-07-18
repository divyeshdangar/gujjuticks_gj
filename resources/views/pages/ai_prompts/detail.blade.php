<x-layouts.site :metaData="$metaData" page="ai-prompts">

    @php
        $summary = $dataDetail->meta_description ?: $dataDetail->description;
        $hasImage = !empty($dataDetail->image);
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

    <article class="ap-detail">
        <header class="ap-detail__hero">
            <div class="ap-wrap ap-detail__hero-grid">
                <div class="ap-detail__copy">
                    <nav class="ap-crumb" aria-label="Breadcrumb">
                        <a href="{{ route('pages.ai_prompts.list') }}">AI prompts</a>
                        @if ($dataDetail->category)
                            <span class="ap-crumb__sep" aria-hidden="true">/</span>
                            <a href="{{ route('pages.ai_prompts.category', ['slug' => $dataDetail->category->slug]) }}">
                                {{ $dataDetail->category->name }}
                            </a>
                        @endif
                    </nav>

                    @if ($dataDetail->category)
                        <a class="ap-chip"
                            href="{{ route('pages.ai_prompts.category', ['slug' => $dataDetail->category->slug]) }}">
                            {{ $dataDetail->category->name }}
                        </a>
                    @endif

                    <h1 class="ap-detail__title">{{ $dataDetail->title }}</h1>

                    @if ($summary)
                        <p class="ap-detail__deck">{{ $summary }}</p>
                    @endif

                    <div class="ap-detail__meta">
                        <span>{{ $dataDetail->unique_id }}</span>
                        <span class="ap-detail__sep" aria-hidden="true">·</span>
                        <span>v{{ $dataDetail->prompt_version }}</span>
                        <span class="ap-detail__sep" aria-hidden="true">·</span>
                        <span data-copy-count>{{ number_format($dataDetail->copy_count) }}</span> copies
                    </div>

                    <div class="ap-detail__actions">
                        <a class="ap-btn ap-btn--solid" href="#prompt-text">Use this prompt</a>
                        <a class="ap-btn ap-btn--ghost" href="{{ route('pages.ai_prompts.list') }}">All prompts</a>
                    </div>
                </div>

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
            </div>
        </header>

        @if ($hasImage)
            <figure class="ap-detail__cover ap-wrap">
                <img src="{{ asset('images/ai-prompts/' . $dataDetail->image) }}" alt="{{ $dataDetail->title }}" width="1200" height="675"
                    loading="eager" decoding="async">
            </figure>
        @endif

        <div class="ap-section">
            <div class="ap-wrap ap-layout">
                <div class="ap-main">
                    <section class="ap-panel ap-reveal" aria-labelledby="prompt-heading">
                        <div class="ap-panel__head">
                            <h2 id="prompt-heading">Ready-to-use prompt</h2>
                            <p>Copy this predefined prompt into ChatGPT, Claude, Gemini, or any AI tool — then adapt it to your task.</p>
                        </div>

                        @if ($dataDetail->description && $dataDetail->description !== $summary)
                            <p class="ap-panel__desc">{{ $dataDetail->description }}</p>
                        @endif

                        <div class="ap-prompt" id="prompt-text">
                            <div class="ap-prompt__bar">
                                <span>Prompt text</span>
                                <button type="button" class="ap-btn ap-btn--solid ap-btn--sm copy-prompt-btn"
                                    data-prompt="{{ e($dataDetail->prompt) }}"
                                    data-copy-url="{{ route('pages.ai_prompts.copy', ['uniqueId' => $dataDetail->unique_id]) }}">
                                    Copy prompt
                                </button>
                            </div>
                            <pre class="ap-prompt__body" tabindex="0">{{ $dataDetail->prompt }}</pre>
                        </div>
                    </section>

                    <section class="ap-panel ap-reveal" id="comments" aria-labelledby="comments-heading">
                        <div class="ap-panel__head">
                            <h2 id="comments-heading">Comments ({{ $dataDetail->comments->count() }})</h2>
                            <p>Share tips or results from using this prompt.</p>
                        </div>

                        @if (auth()->check())
                            <form class="ap-comment-form" method="post"
                                action="{{ route('pages.ai_prompts.comment.store', ['slug' => $dataDetail->slug]) }}">
                                @csrf
                                <label class="visually-hidden" for="comment">Add a comment</label>
                                <textarea name="comment" id="comment"
                                    class="@error('comment') is-invalid @enderror" rows="4"
                                    placeholder="What worked well with this prompt?"
                                    maxlength="2000">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <p class="ap-form-error">{{ $message }}</p>
                                @enderror
                                <button type="submit" class="ap-btn ap-btn--solid ap-btn--sm">Post comment</button>
                            </form>
                        @else
                            <p class="ap-login-hint">
                                <a class="ap-btn ap-btn--ghost ap-btn--sm" href="{{ route('login') }}">Log in</a>
                                to leave a comment. You can still read comments below.
                            </p>
                        @endif

                        <div class="ap-comments">
                            @forelse ($dataDetail->comments as $comment)
                                <article class="ap-comment">
                                    <div class="ap-comment__avatar" aria-hidden="true">
                                        @if ($comment->user)
                                            <img src="{{ $comment->user->profile() }}" alt="{{ $comment->user->name ?? 'User' }}" width="40" height="40"
                                                loading="lazy" decoding="async">
                                        @else
                                            <span>U</span>
                                        @endif
                                    </div>
                                    <div class="ap-comment__body">
                                        <div class="ap-comment__meta">
                                            <strong>{{ $comment->user ? $comment->user->name : 'User' }}</strong>
                                            <time datetime="{{ $comment->created_at->toAtomString() }}">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </time>
                                        </div>
                                        <p>{!! nl2br(e($comment->comment)) !!}</p>
                                    </div>
                                </article>
                            @empty
                                <p class="ap-comments__empty">No comments yet. Be the first to share how this prompt helped.</p>
                            @endforelse
                        </div>
                    </section>
                </div>

                <aside class="ap-side ap-reveal" aria-label="More prompts">
                    <h2 class="ap-side__title">Browse by category</h2>
                    <p class="ap-side__lead">Find more ready-made prompts for similar tasks.</p>
                    <nav class="ap-side__nav">
                        <a class="ap-side__link" href="{{ route('pages.ai_prompts.list') }}">All prompts</a>
                        @foreach ($categories as $cat)
                            <a class="ap-side__link {{ $dataDetail->category && $dataDetail->category->id === $cat->id ? 'is-active' : '' }}"
                                href="{{ route('pages.ai_prompts.category', ['slug' => $cat->slug]) }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </nav>

                    @if ($relatedList->isNotEmpty())
                        <div class="ap-related">
                            <h2 class="ap-side__title">Related prompts</h2>
                            <ul class="ap-related__list">
                                @foreach ($relatedList as $rel)
                                    <li>
                                        <a href="{{ route('pages.ai_prompts.detail', ['slug' => $rel->slug]) }}">
                                            <span class="ap-related__id">{{ $rel->unique_id }}</span>
                                            <span class="ap-related__title">{{ $rel->title }}</span>
                                            <span class="ap-related__copies">{{ number_format($rel->copy_count) }} copies</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </article>

    <div id="ai-prompts-csrf" data-csrf="{{ csrf_token() }}" hidden></div>

</x-layouts.site>
