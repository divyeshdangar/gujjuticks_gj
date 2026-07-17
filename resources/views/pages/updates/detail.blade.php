<x-layouts.front :showHeader="true" :metaData="$metaData">
    @php
        $detailUrl = $dataDetail->detailUrl();
        $routeParams = [
            'citySlug' => $dataDetail->city?->slug,
            'postType' => $dataDetail->type,
            'publicId' => $dataDetail->public_id ?? $dataDetail->slug,
        ];
        $reactionCount = $dataDetail->reactions_count ?? $dataDetail->reactions->count();
        $totalPollVotes = $dataDetail->pollOptions->sum('votes_count');
    @endphp

    <section class="section">
        <div class="container">
            @php
                $breadcrumbItems = [
                    ['label' => 'Updates', 'url' => route('pages.updates.list')],
                ];
                if ($dataDetail->category) {
                    $breadcrumbItems[] = [
                        'label' => $dataDetail->category->name,
                        'url' => route('pages.updates.category', ['slug' => $dataDetail->category->slug]),
                    ];
                }
                $breadcrumbItems[] = ['label' => Str::limit($dataDetail->title, 48)];
            @endphp
            <x-updates.breadcrumb class="mb-4" :items="$breadcrumbItems" />

            @if(!$hasAccess)
                <div class="card border shadow-sm">
                    <div class="card-body p-4 p-md-5 text-center">
                        @if($isGuest)
                            <h1 class="h4 mb-2">Login to view this update</h1>
                            <p class="text-muted mb-4">This update is private. Sign in with the account that created it, or return to the public feed.</p>
                            <a href="{{ route('login') }}" class="btn btn-warning me-2" style="color: rgb(19, 19, 19) !important;">Login</a>
                            <a href="{{ route('pages.updates.list') }}" class="btn btn-outline-secondary">Back to feed</a>
                        @else
                            <h1 class="h4 mb-2">Private update</h1>
                            <p class="text-muted mb-4">You do not have permission to view this update.</p>
                            <a href="{{ route('pages.updates.list') }}" class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">Back to feed</a>
                        @endif
                    </div>
                </div>
            @else
                <div class="row g-4">
                    <div class="col-lg-8">
                        <article class="card border shadow-sm mb-4">
                            <div class="card-body p-4">
                                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                                    <div class="d-flex flex-wrap gap-1 align-items-center">
                                        <x-updates.type-badge :type="$dataDetail->type" />
                                        @if($dataDetail->privacy === 'private')
                                            <span class="badge bg-dark">Private</span>
                                        @endif
                                        @if($dataDetail->category?->is_important)
                                            <span class="badge bg-danger">Important</span>
                                        @endif
                                    </div>
                                    <time class="text-muted small" datetime="{{ $dataDetail->created_at?->toIso8601String() }}">{{ $dataDetail->created_at?->format('j M, Y · h:i A') }}</time>
                                </div>

                                <h1 class="h3 mb-2">{{ $dataDetail->title }}</h1>
                                <p class="small text-muted mb-4">
                                    @if($dataDetail->city)
                                        <a href="{{ route('pages.updates.list', $cityFilterQuery) }}" class="text-warning text-decoration-none">{{ $dataDetail->city->name }}</a>
                                    @endif
                                    @if($dataDetail->category)
                                        <span class="mx-1">·</span>
                                        <a href="{{ route('pages.updates.category', array_merge(['slug' => $dataDetail->category->slug], $cityFilterQuery)) }}" class="text-warning text-decoration-none">{{ $dataDetail->category->name }}</a>
                                    @endif
                                    @if($dataDetail->creator?->name)
                                        <span class="mx-1">·</span>
                                        <span>{{ $dataDetail->creator->name }}</span>
                                    @endif
                                </p>

                                @if($dataDetail->type === 'image' && $dataDetail->image)
                                    <img src="{{ asset('images/updates/' . $dataDetail->image) }}" class="img-fluid rounded mb-4 w-100" alt="{{ $dataDetail->title }}" style="max-height: 480px; object-fit: cover;">
                                @endif

                                @if($dataDetail->type === 'youtube' && $dataDetail->youtube_embed_url)
                                    <div class="ratio ratio-16x9 mb-4 rounded overflow-hidden">
                                        <iframe src="{{ $dataDetail->youtube_embed_url }}" title="{{ $dataDetail->title }}" allowfullscreen loading="lazy"></iframe>
                                    </div>
                                @endif

                                @if($dataDetail->description)
                                    <div class="mb-4 update-body">{!! nl2br(e($dataDetail->description)) !!}</div>
                                @endif

                                @if($dataDetail->external_link)
                                    <a href="{{ $dataDetail->external_link }}" target="_blank" rel="nofollow noopener" class="btn btn-outline-warning btn-sm mb-4">
                                        Open external link
                                    </a>
                                @endif

                                @if(Auth::check() && Auth::id() === (int) $dataDetail->created_by)
                                    <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                                        <a href="{{ route('pages.updates.edit', $routeParams) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                        <form method="post" action="{{ route('pages.updates.delete', $routeParams) }}" onsubmit="return confirm('Delete this update permanently?');">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </article>

                        @if($dataDetail->type === 'poll')
                            <div class="card border shadow-sm mb-4">
                                <div class="card-body p-4">
                                    <h2 class="h5 mb-1">Poll</h2>
                                    <p class="mb-4">{{ $dataDetail->poll_question }}</p>

                                    @auth
                                        <form method="post" action="{{ route('pages.updates.poll.vote', $routeParams) }}">
                                            @csrf
                                            @foreach($dataDetail->pollOptions as $option)
                                                @php
                                                    $percent = $totalPollVotes > 0 ? round(($option->votes_count / $totalPollVotes) * 100) : 0;
                                                    $isSelected = (int) $viewerPollOptionId === (int) $option->id;
                                                @endphp
                                                <label class="d-block border rounded p-3 mb-2 @if($isSelected) border-warning @endif" style="cursor: pointer;">
                                                    <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
                                                        <span>
                                                            <input type="radio" name="option_id" value="{{ $option->id }}" @checked($isSelected) required>
                                                            {{ $option->option_text }}
                                                        </span>
                                                        <span class="text-muted small">{{ $option->votes_count }} · {{ $percent }}%</span>
                                                    </div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </label>
                                            @endforeach
                                            <button type="submit" class="btn btn-warning btn-sm mt-2" style="color: rgb(19, 19, 19) !important;">
                                                {{ $viewerPollOptionId ? 'Change vote' : 'Submit vote' }}
                                            </button>
                                        </form>
                                    @else
                                        @foreach($dataDetail->pollOptions as $option)
                                            @php $percent = $totalPollVotes > 0 ? round(($option->votes_count / $totalPollVotes) * 100) : 0; @endphp
                                            <div class="border rounded p-3 mb-2">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>{{ $option->option_text }}</span>
                                                    <span class="text-muted small">{{ $option->votes_count }} · {{ $percent }}%</span>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-warning" style="width: {{ $percent }}%;"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <p class="text-muted small mb-0 mt-2"><a href="{{ route('login') }}">Login</a> to vote.</p>
                                    @endauth
                                </div>
                            </div>
                        @endif

                        @if($dataDetail->type === 'qa')
                            <div class="card border shadow-sm mb-4">
                                <div class="card-body p-4">
                                    <h2 class="h5 mb-3">{{ $dataDetail->qa_question }}</h2>

                                    @auth
                                        <form method="post" action="{{ route('pages.updates.answer', $routeParams) }}" class="mb-4">
                                            @csrf
                                            <label class="form-label small text-muted">Your answer</label>
                                            <textarea name="answer" rows="3" class="form-control mb-2" placeholder="Share what you know..." required>{{ old('answer') }}</textarea>
                                            <button type="submit" class="btn btn-warning btn-sm" style="color: rgb(19, 19, 19) !important;">Post answer</button>
                                        </form>
                                    @else
                                        <p class="text-muted small"><a href="{{ route('login') }}">Login</a> to answer this question.</p>
                                    @endauth

                                    @forelse($dataDetail->answers as $answer)
                                        <div class="border rounded p-3 mb-2">
                                            <div class="small text-muted mb-1">{{ $answer->user?->name }} · {{ $answer->created_at?->diffForHumans() }}</div>
                                            <div>{{ $answer->answer }}</div>
                                        </div>
                                    @empty
                                        <p class="text-muted mb-0">No answers yet. Be the first to help.</p>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        <div class="card border shadow-sm">
                            <div class="card-body p-4">
                                <h2 class="h5 mb-3">Comments ({{ $dataDetail->comments->where('status', 'active')->count() }})</h2>

                                @auth
                                    <form method="post" action="{{ route('pages.updates.comment.store', $routeParams) }}" class="mb-4">
                                        @csrf
                                        <textarea name="comment" rows="3" class="form-control mb-2" placeholder="Join the conversation..." required>{{ old('comment') }}</textarea>
                                        <button type="submit" class="btn btn-warning btn-sm" style="color: rgb(19, 19, 19) !important;">Post comment</button>
                                    </form>
                                @else
                                    <p class="text-muted mb-4"><a href="{{ route('login') }}">Login</a> to comment.</p>
                                @endauth

                                @forelse($dataDetail->comments as $comment)
                                    @if($comment->status === 'active' || (Auth::check() && Auth::user()->is_admin()))
                                        <div class="border rounded p-3 mb-3" id="comment-{{ $comment->id }}">
                                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                                <span class="fw-medium small">{{ $comment->user?->name }}</span>
                                                <span class="text-muted small">{{ $comment->created_at?->diffForHumans() }}</span>
                                            </div>
                                            <p class="mb-2 mb-md-3">{{ $comment->comment }}</p>
                                            @auth
                                                <div class="d-flex flex-wrap gap-2">
                                                    @if(Auth::id() === (int) $comment->user_id || Auth::user()->is_admin())
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#edit-comment-{{ $comment->id }}">Edit</button>
                                                        <form method="post" action="{{ route('pages.updates.comment.delete', ['id' => $comment->id]) }}" class="d-inline" onsubmit="return confirm('Delete this comment?');">
                                                            @csrf
                                                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                        </form>
                                                    @endif
                                                    @if(Auth::id() !== (int) $comment->user_id)
                                                        <form method="post" action="{{ route('pages.updates.comment.report', ['id' => $comment->id]) }}" class="d-inline">
                                                            @csrf
                                                            <button class="btn btn-outline-secondary btn-sm">Report</button>
                                                        </form>
                                                    @endif
                                                </div>
                                                @if(Auth::id() === (int) $comment->user_id || Auth::user()->is_admin())
                                                    <div class="collapse mt-2" id="edit-comment-{{ $comment->id }}">
                                                        <form method="post" action="{{ route('pages.updates.comment.edit', ['id' => $comment->id]) }}">
                                                            @csrf
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" name="comment" class="form-control" value="{{ $comment->comment }}" required>
                                                                <button class="btn btn-warning" style="color: rgb(19, 19, 19) !important;">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    @endif
                                @empty
                                    <p class="text-muted mb-0">No comments yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <x-updates.internal-links
                            :dataDetail="$dataDetail"
                            :cityFilterQuery="$cityFilterQuery"
                            :typeFilterQuery="$typeFilterQuery"
                            :categoryData="$categoryData"
                            :types="$types"
                        />

                        <div class="card border shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h3 class="h6 text-muted text-uppercase mb-3">Engagement</h3>

                                <form method="post" action="{{ route('pages.updates.react', $routeParams) }}" class="mb-3">
                                    @csrf
                                    <input type="hidden" name="reaction" value="like">
                                    <button type="submit" class="btn w-100 @if($isLikedByViewer) btn-warning @else btn-outline-warning @endif" style="@if($isLikedByViewer) color: rgb(19, 19, 19) !important; @endif">
                                        {{ $isLikedByViewer ? 'Unlike' : 'Like' }} · {{ $reactionCount }}
                                    </button>
                                </form>

                                <label class="form-label small text-muted mb-1">Share link</label>
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" class="form-control" readonly value="{{ $detailUrl }}" id="update-share-url">
                                    <button type="button" class="btn btn-outline-secondary" data-copy-update-url="{{ $detailUrl }}">Copy</button>
                                </div>

                                <a href="{{ route('pages.updates.list') }}" class="btn btn-outline-secondary btn-sm w-100">← Back to feed</a>
                            </div>
                        </div>
                    </div>

                        @if($similarList->isNotEmpty())
                            <div class="card border shadow-sm">
                                <div class="card-body p-4">
                                    <h3 class="h6 text-muted text-uppercase mb-3">Similar updates</h3>
                                    <div class="d-flex flex-column gap-2">
                                        @foreach($similarList->take(4) as $similar)
                                            <x-updates.similar-item :item="$similar" />
                                        @endforeach
                                    </div>
                                    @if($similarList->count() > 4)
                                        <a href="#more-updates" class="btn btn-outline-warning btn-sm w-100 mt-3">View all similar</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                </div>

                @if($similarList->isNotEmpty())
                    <div class="row mt-5 pt-4 border-top" id="more-updates">
                        <div class="col-12 mb-4">
                            <h2 class="h4 mb-1">More updates you may like</h2>
                            <p class="text-muted small mb-0">
                                Related posts from
                                @if($dataDetail->city)
                                    <a href="{{ route('pages.updates.list', $cityFilterQuery) }}" class="text-warning">{{ $dataDetail->city->name }}</a>
                                @endif
                                @if($dataDetail->category)
                                    and <a href="{{ route('pages.updates.category', ['slug' => $dataDetail->category->slug]) }}" class="text-warning">{{ $dataDetail->category->name }}</a>
                                @endif
                            </p>
                        </div>
                        @foreach($similarList as $similar)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <x-updates.card :item="$similar" />
                            </div>
                        @endforeach
                        <div class="col-12 text-center mt-2">
                            @if($dataDetail->category)
                                <a href="{{ route('pages.updates.category', array_merge(['slug' => $dataDetail->category->slug], $cityFilterQuery)) }}" class="btn btn-warning me-2" style="color: rgb(19, 19, 19) !important;">
                                    Browse {{ $dataDetail->category->name }}
                                </a>
                            @endif
                            @if($dataDetail->city)
                                <a href="{{ route('pages.updates.list', $cityFilterQuery) }}" class="btn btn-outline-secondary">All updates in {{ $dataDetail->city->name }}</a>
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>

    @include('components.updates.copy-link-script')
</x-layouts.front>
